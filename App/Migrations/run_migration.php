<?php


include_once ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR  . "Config" . DIRECTORY_SEPARATOR . "configDB.php";
include_once 'CreateTaskTableMigration.php';


use Migrations\CreateTaskTableMigration;
$conn = new \mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);;


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$migration = new CreateTaskTableMigration($conn);
$migration->up();// start migration
// $migration->down(); // To rollback migration