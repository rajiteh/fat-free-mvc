<?php
/*
API 

*/

$f3 = require('lib/base.php');

$f3->set('DEBUG',3);
$f3->set('UI','ui/');
$f3->set('AUTOLOAD','app/controller/ ; app/model/ ; app/lib/');
$f3->set('DB',new DB\SQL('mysql:host=localhost;port=3306;dbname=','user','pass'));
$f3->set('API_VERSION', '1');


//root
$f3->route('GET /v1', 'Main->about' );

//developer actions
$f3->route('GET /v1/dev/create', 'Developer->create_db');


$f3->run();




