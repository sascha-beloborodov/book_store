<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class BooksMigration {
    public function run()
    {
        Capsule::schema()->dropIfExists('books');
        Capsule::schema()->create('books', function($table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->string('author', 100);
            $table->longText('description');
            $table->integer('public_year');
            $table->string('book_cover');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('books');
    }
}