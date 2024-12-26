<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "username" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "picture" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ],
            "bio" => [
                "type" => "TEXT",
                "null" => true
            ],
            "created_at timestamp default current_timestamp",
            "updated_at timestamp default current_timestamp on update current_timestamp",

        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}