<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'refr' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ],
            'status_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey( 'id', true );
        $this->forge->createTable( 'orders' );


    }

    public function down()
    {
        $this->forge->dropTable( 'orders' );
    }
}
