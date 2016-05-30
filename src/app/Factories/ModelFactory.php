<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 5/29/2016
 * Time: 5:07 PM
 */

namespace App\Factories;


class ModelFactory {
    
    public function createModel($model) 
    {
        try {
            $modelName = "\\App\\Models\\{$model}";
            $model = new $modelName;
            return $model;    
        }
        catch (\RuntimeException $e) {
            die($e->getMessage());
        }
        
    }
}