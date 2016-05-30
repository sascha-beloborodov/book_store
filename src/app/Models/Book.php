<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    const ORDER_ASC = 1;
    const ORDER_DESC = 0;

    public $typeOrder = [
        self::ORDER_DESC => 'desc',
        self::ORDER_ASC => 'asc'
    ];

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'description',
        'public_year',
        'book_cover',
        'user_id'
    ];

    /**
     * @return array
     */
    public function getTypeOrder()
    {
        return $this->typeOrder;
    }



    public function checkForSort($type, $field)
    {
        if (!in_array($type, [self::ORDER_ASC, self::ORDER_DESC])) {
            throw new \Exception;
        }

        if (!in_array(strtolower($field), $this->fillable)) {
            throw new \Exception;
        }
        
        return $this;
    }

    public function scopeSetLimit($query, $limit)
    {
        return $query->limit($limit);
    }

    public function scopeAsAuthor($query, $author)
    {
        return $query->where("author", "LIKE", "%{$author}%");
    }

    public function scopeAsTitle($query, $title)
    {
        return $query->where("author", "LIKE", "%{$title}%");
    }

}