<?php

require "/../vendor/autoload.php";
$config = require "/../src/settings.php";

use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;
$capsule->addConnection($config['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
// set timezone for timestamps etc
date_default_timezone_set('UTC');