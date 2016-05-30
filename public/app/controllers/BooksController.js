app.controller('BooksController', function (dataFactory, crumble, $scope, $http, $routeParams, $location) {

    // variables of current scope
    $scope.data = [];
    $scope.book = {};
    $scope.totalItems = 0;

    // variables of global scope
    $scope.currentPage = dataFactory.currentPage;
    $scope.countPerPage = dataFactory.countPerPage;
    $scope.userId = dataFactory.userId;

    $scope.successMessages = dataFactory.successMessages;
    $scope.errorMessages = dataFactory.errorMessages;

    $scope.sortType = dataFactory.sortType;
    $scope.withSort = dataFactory.withSort;
    $scope.sortReverse  = dataFactory.sortReverse;

    $scope.searchTitle = dataFactory.searchTitle;
    $scope.searchAuthor = dataFactory.searchAuthor;

    // functions

    /**
     * page was changed by user
     * @param newPage
     */
    $scope.pageChanged = function (newPage) {
        dataFactory.currentPage = $scope.currentPage = newPage;
        getResultsPage(newPage);
    };

    /**
     * user sort author or title
     * @param sortType
     * @param sortReverse
     * @param withSort
     */
    $scope.handleSort = function (sortType, sortReverse, withSort) {
        dataFactory.sortType = $scope.sortType = sortType;
        dataFactory.sortReverse = $scope.sortReverse = sortReverse;
        dataFactory.withSort = $scope.withSort = withSort;
        getResultsPage($scope.currentPage);
    };

    /**
     * function get books
     * @param pageNumber
     * @param withSearch
     */
    function getResultsPage(pageNumber, withSearch) {

        if (withSearch == undefined) {
            withSearch = true;
        }

        dataFactory.successMessages = [];
        $scope.errorMessages = [];

        var requestString = '/books?page=' + pageNumber;

        if ($scope.searchTitle && withSearch) {
            requestString += '&search_title=' + $scope.searchTitle;
        }

        if ($scope.searchAuthor && withSearch) {
            requestString += '&search_author=' + $scope.searchAuthor;
        }
        
        if ($scope.withSort) {
            requestString += '&sort=' + $scope.sortType + '_' + ($scope.sortReverse ? '1' : '0');
        }

        dataFactory.httpRequest(requestString).then(function (data) {
            $scope.data =  data.data || [];
            dataFactory.userId = $scope.userId = data.user_id;
            $scope.totalItems = data.total;
            dataFactory.currentPage = $scope.currentPage = pageNumber;
            crumble.update({
                name: 'crumble'
            });
            $scope.breadcrumbs = crumble.trail;
        });
    }

    /**
     * function for detect states - show/edit
     */
    function initRouter() {
        if ($routeParams.id != undefined) {
            switch (window.location.hash.split('/')[2]) {
                case 'show':
                    $scope.show($routeParams.id);
                    return;
                case 'edit':
                    $scope.edit($routeParams.id);
                    return;
                default:
                    window.location.hash = '/#/books';
                    return;
            }
        }
        getResultsPage($scope.currentPage);
    }

    function fatalErrorMessage(message) {
        dataFactory.errorMessages.push(
            { text: 'Application error! Please, <a class="js-reload">reload page</a> and try again later.' }
        );
        dataFactory.errorMessages.push({ text:message });
        $scope.errorMessages = dataFactory.errorMessages;
    }


    function hightLightErrorFields(id) {
        $(document).off('change', '#' + id);
        $(document).on('change', '#' + id, function (e) {
            $(this).parent().removeClass('has-error');
        });
        $('#' + id).parent().addClass('has-error');
    }

    function edit(data) {
        if (data.message) {
            fatalErrorMessage(data.message);
            return;
        }
        if (data.error) {
            if (data.messages) {
                for (var i in data.messages) {
                    hightLightErrorFields(i);

                    if ($scope.addBook) {
                        $scope.addBook.$invalid = true;
                        $scope.addBook[i].$invalid = true;
                    }

                    if ($scope.editBook) {
                        $scope.editBook.$invalid = true;
                        $scope.editBook[i].$invalid = true;
                    }

                    for (var j = 0; j < data.messages[i].length; j++) {
                        $scope.errorMessages.push({text:i + ': ' + data.messages[i][j]});
                    }
                }
            }
        }
        else {
            dataFactory.successMessages.push({ text:'Book was added/edited succesful' });
            $scope.successMessages = dataFactory.successMessages;
            window.location.hash = '#/books';
        }
    }

    $scope.reload = function () {
        $location.reload();
    };

    $scope.searchBy = function () {
        if ($scope.searchTitle.length >= 2 ||
            $scope.searchAuthor.length >= 2) {
            getResultsPage($scope.currentPage);
        }
        else if ($scope.searchTitle.length < 2 ||
            $scope.searchAuthor.length < 2) {
            getResultsPage($scope.currentPage, false);
        }
    };

    /**
     * add new book
     */
    $scope.saveAdd = function () {
        dataFactory.httpRequest('books/add', 'POST', {}, $scope.book).then(function (data) {
            $scope.errorMessages = [];
            edit(data);
        });
    };

    /**
     * show edited book
     * @param idx
     */
    $scope.edit = function (idx) {
        if ($scope.data.length === 0) {
            dataFactory.httpRequest('books/show/' + idx).then(function (data) {
                if (!data) {
                    throw new Error("Not data");
                }
                dataFactory.book = $scope.book = data;
                crumble.update({book: $scope.book});
                $scope.breadcrumbs = crumble.trail;
            });
        }
        else {
            dataFactory.book = $scope.book = $scope.data[idx];
            crumble.update({book: $scope.book});
            $scope.breadcrumbs = crumble.trail;
        }
    };

    /**
     * TODO: dry!
     * show viewed book
     * @param idx
     */
    $scope.show = function (idx) {
        if ($scope.data.length === 0) {
            dataFactory.httpRequest('books/show/' + idx).then(function (data) {
                if (!data) {
                    throw new Error("Not data");
                }
                dataFactory.book = $scope.book = data;
                crumble.update({book: $scope.book});
                $scope.breadcrumbs = crumble.trail;
            });
        }
        else {
            dataFactory.book = $scope.book = $scope.data[idx];
            crumble.update({book: $scope.book});
            $scope.breadcrumbs = crumble.trail;
        }

    };


    $scope.saveEdit = function () {
        dataFactory.httpRequest('books/edit/' + $scope.book.id, 'PUT', {}, $scope.book).then(function (data) {
            $scope.errorMessages = [];
            edit(data);
        });
    };

    $scope.remove = function (item, index) {
        var result = confirm("Are you sure delete this item?");
        if (result) {
            dataFactory.httpRequest('books/delete/' + item.id, 'DELETE', {}, {}).then(function (data) {
                $scope.data.splice(index, 1);
                dataFactory.successMessages.push({ text:'Book was added/edited/deleted succesful' });
                $scope.successMessages = dataFactory.successMessages;
                window.location.hash = '#/books';
            });
        }
    };

    $scope.uploadFile = function (files) {
        var fd = new FormData();
        fd.append("file", files[0]);
        fd.append("csrf_name", $('#csrf_name').val());
        fd.append("csrf_value", $('#csrf_value').val());

        $http.post('books/upload', fd, {
            withCredentials: true,
            headers: {'Content-Type': undefined},
            transformRequest: angular.identity
        }).success(function (data) {
            updateTokens(data);
            dataFactory.book.book_cover = $scope.book.book_cover = data.book_cover;
            $('#book-cover').attr('src', data.book_cover);
        }).error(function (data) {
            edit(data);
        });

    };

    initRouter();
});
