<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class UsersMigration {
    public function run()
    {
        Capsule::schema()->dropIfExists('users');
        Capsule::schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Capsule::schema()->dropIfExists('users');
    }
}