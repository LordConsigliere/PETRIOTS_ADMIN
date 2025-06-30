<?php

require __DIR__."../../../vendor/autoload.php";

use Kreait\Firebase\Factory;

$factory = (new Factory)

    ->withServiceAccount('petriots-9ae02-firebase-adminsdk-wodnq-574ca55a81.json')
    ->withDatabaseUri('https://petriots-9ae02-default-rtdb.firebaseio.com/');
    
$database = $factory->createDatabase();
?>