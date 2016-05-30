<?php

namespace App\Controllers;

use App\Models\Book;
use App\Resources\FileHelper;
use App\Validation\Validator;
use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Slim\Views\Twig;
use Respect\Validation\Validator as V;

class BooksController extends Controller {

    const DEFAULT_PAGE = 1;
    const LIMIT = 5;

    public function __construct($container)
    {
        parent::__construct($container);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return static
     * @throws \Exception
     */
    public function index(Request $request, Response $response, $args)
    {
        /**
         * @var $bookModel Book
         */
        $bookModel = $this->container->modelFactory->createModel('Book');
        /**
         * @var $builderState Builder
         */
        $builderState = $bookModel->setLimit(self::LIMIT);

        /**
         * String as field_1
         */
        if ($sort = $request->getParam('sort')) {
            $sortOptions = explode('_', $sort);
            $bookModel->checkForSort($sortOptions[1], $sortOptions[0]);
            $builderState->orderBy($sortOptions[0], $bookModel->getTypeOrder()[(int)$sortOptions[1]]);
        }

        if ($searchAuthor = $request->getParam('search_author')) {
            $builderState->where("author", "LIKE", "%{$searchAuthor}%");
        }

        if ($searchTitle = $request->getParam('search_title')) {
            $builderState->where("title", "LIKE", "%{$searchTitle}%");
        }

        // manual pagination
        $page = (int) $request->getParam('page') ? (int) $request->getParam('page') : self::DEFAULT_PAGE;
        $offset = ($page - self::DEFAULT_PAGE) * self::LIMIT;
        $countBooks = $builderState->count();
        if (1 < $page) {
            $builderState->offset($offset);
            $items = $builderState->get();
        }
        else {
            $items = $builderState->get();
        }

        return $response->withJson([
            'data' => $items, 
            'total' => $countBooks,
            'user_id' => $this->auth->getUserId()
        ]);
    }

    public function show(Request $request, Response $response, $args)
    {
        $id = (int) $args['id'];
        return $response->withJson(Book::where('id', $id)->first());
    }

    public function uploadFile(Request $request, Response $response, $args)
    {
        /**
         * @var $file UploadedFile
         */
        $file = $request->getUploadedFiles();
        $file = $file['file'];

        $fileHelper = new FileHelper($file);
        $fileHelper->setExtension()->setRulesTempDir();

        $extension = $fileHelper->getExtension();

        // create temp path and temp filename
        $fileName = $fileHelper->createFileName();
        $filePlace = UPLOAD_TEMP_DIR . DIRECTORY_SEPARATOR . $fileName . '.' . $extension;
        $fileTempLocated = PREFIX_FILENAME_DB . $fileName . '.' . $extension;

        // save file if it correct
        if ($fileHelper->isFileValid()) {
            $file->moveTo($filePlace);
        }
        else {
            return $response->withJson(
                array_merge(
                    $this->createTokens(),
                    ['message' => 'Cannot upload file... '  .
                        'May be an extension is wrong... Make sure that size of the file less 512 kb...']
                ),
                500
            );

        }

        return $response->withJson(
            array_merge($this->createTokens(), ['book_cover' => $fileTempLocated])
        );
    }

    public function add(Request $request, Response $response, $args)
    {
        /**
         * @var $validation Validator
         */
        $validation = $this->getValidation($request);

        if ($validation->failed()) {
            return $response->withJson(
                array_merge($this->createTokens(), ['error' => '1', 'messages' => $validation->getErrors()]),
                500
            );
        }

        // Book cover do not necessary
        $bookCover = $request->getParam('book_cover') ? trim(htmlspecialchars(str_replace('temp', 'images', $request->getParam('book_cover')))) : '';
        $fileHelper = new FileHelper();
        if ($bookCover) {
            $fileHelper->moveFileFromTempDir($request->getParam('book_cover'));
            if (!$fileHelper->getIsMoved()) {
                return $response->withJson(
                    array_merge($this->createTokens(), ['message' => 'Cannot move the file. Error.']),
                    500
                );
            }
        }

        /**
         * @var $bookModel Book
         */
        $bookModel = $this->container->modelFactory->createModel('Book');

        $bookModel->create([
            'title' => trim(htmlspecialchars($request->getParam('title'))),
            'author' => trim(htmlspecialchars($request->getParam('author'))),
            'public_year' => (int) $request->getParam('public_year'),
            'description' => trim(htmlspecialchars($request->getParam('description'))),
            'book_cover' => $bookCover,
            'user_id' => $this->auth->user()->id,
        ]);

        return $response->withJson(
            array_merge($this->createTokens(), ['success' => '1'])
        );
    }

    public function store(Request $request, Response $response, $args)
    {
        /**
         * @var $validation Validator
         */
        $validation = $this->getValidation($request);

        if ($validation->failed()) {
            return $response->withJson(
                array_merge($this->createTokens(), ['messages' => $validation->getErrors()], ['error' => '1'])
            );
        }

        $id = (int) $args['id'];

        /**
         * @var $bookModel Book
         */
        $bookModel = $this->container->modelFactory->createModel('Book')->where('id', $id)->first();
        $bookModel->title = trim(htmlspecialchars($request->getParam('title')));
        $bookModel->author = trim(htmlspecialchars($request->getParam('author')));
        $bookModel->public_year = (int) $request->getParam('public_year');
        $bookModel->description = trim(htmlspecialchars($request->getParam('description')));

        $fileHelper = new FileHelper();

        if ($fileHelper->isNewImage($bookModel->book_cover, $request->getParam('book_cover'))) {
            $fileHelper->moveFileFromTempDir($request->getParam('book_cover'));
            if (!$fileHelper->getIsMoved()) {
                return $response->withJson(
                    array_merge($this->createTokens(), ['message' => 'Cannot move the file. Error.']),
                    500
                );
            }
            $bookModel->book_cover = str_replace('temp', 'images', $request->getParam('book_cover'));
        }

        $bookModel->save();

        return $response->withJson(
            array_merge($this->createTokens(), ['success' => '1'])
        );
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $id = (int) $args['id'];

            $bookModel = $this->container->modelFactory->createModel('Book')->where('id', $id)->first();

            $delete = $bookModel->delete();

            return $response->withJson(
                array_merge($this->createTokens(), ['success' => '1'])
            );
        }
        catch (\Exception $e) {
            return $response->withJson(
                array_merge($this->createTokens(), ['messages' => 'Cannot delete data']),
                500
            );
        }


        //TODO: delete file from derictory
    }

    /**
     * Validation with rules
     * @param $request
     * @return mixed
     */
    private function getValidation($request)
    {
        return $this->validator->validate($request, [
            'title' => V::notEmpty()->stringType()->length(2, 150),
            'author' => V::notEmpty()->stringType()->length(2, 100),
            'public_year' => V::notEmpty()->intVal()->yearAvailable(),
            'description' => V::notEmpty()->stringType()->length(2, 2000),
        ]);
    }

    /**
     * generate tokens for response. Create always, except GET
     * @return array
     */
    private function createTokens()
    {
        return [
            'csrf_name' => $this->container->csrf->getTokenName(),
            'csrf_value' => $this->container->csrf->getTokenValue()
        ];
    }
}
