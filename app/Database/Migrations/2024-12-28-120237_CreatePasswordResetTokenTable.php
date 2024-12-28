<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasswordResetTokenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "email" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "token" => [
                "type" => "VARCHAR",
                "constraint" => "255"
            ],
            "created_at timestamp default current_timestamp",
            "updated_at timestamp default current_timestamp on update current_timestamp",
        ]);
        $this->forge->createTable("password_reset_tokens");
    }

    public function down()
    {
        $this->forge->dropTable("password_reset_tokens");
    }
}
