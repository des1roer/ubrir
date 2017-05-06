<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/database.php';

//db properties
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','ubrir');

// make a connection to mysql here
$db = Database::get();

$data = array(
    'stat' => (int)$_POST['val'],
);
$id = $db->insert('log', $data);

$val = ['all'=>'right', 'id' => $id];
echo json_encode($val);
