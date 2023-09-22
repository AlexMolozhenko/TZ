<?php


namespace Migrations;


class CreateTaskTableMigration
{
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function up() {
        $sql = "CREATE TABLE tasks (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title TEXT NOT NULL,
            description TEXT NOT NULL,
            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if ($this->connection->query($sql) === TRUE) {
            echo "Table tasks created successfully";
        } else {
            echo "Error creating table: " . $this->connection->error;
        }
    }

    public function down() {
        $sql = "DROP TABLE tasks";

        if ($this->connection->query($sql) === TRUE) {
            echo "Table tasks dropped successfully";
        } else {
            echo "Error dropping table: " . $this->connection->error;
        }
    }
}
