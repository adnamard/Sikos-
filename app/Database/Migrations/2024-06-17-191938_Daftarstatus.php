<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Daftarstatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('daftar_status');
    }

    public function down()
    {
        //
    }
}
