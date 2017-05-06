<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/database.php';

//db properties
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ubrir');

// make a connection to mysql here
$db = Database::get();

date_default_timezone_set('Asia/Yekaterinburg');

$act = $_REQUEST['act'];
switch ($act) {
    case 'create':
        if (!$db->selectRow("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = 'log' AND TABLE_SCHEMA='ubrir'")) {
           $db->raw("CREATE TABLE `log` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `ts` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `stat` VARCHAR(255) NOT NULL,
                    `success` TINYINT(4) NOT NULL DEFAULT '0',
                    `uuid` VARCHAR(127) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE INDEX `uuid` (`uuid`)
                    )
                    COLLATE='utf8_general_ci'
                    ENGINE=InnoDB"
            );
          echo json_encode(array('create'));
        }
        else echo json_encode(array('exist'));
        break;
    case 'insert':
        $data = array(
            'stat' => (int) $_POST['val'],
            'uuid' => $_POST['uuid']
        );
        $id = $db->insert('log', $data);

        $val = ['id' => $id];
        echo json_encode($val);
        break;
    case 'back':
        sleep(15);
        $data = array(
            'success' => '1',
        );
        $where = array('uuid' => $_POST['uuid']);
        $id = $db->update('log', $data, $where);

        $val = ['back' => $id, 'ts' => date("Y-m-d H:i:s")];
        echo json_encode($val);
        break;
    default :
        break;
}
