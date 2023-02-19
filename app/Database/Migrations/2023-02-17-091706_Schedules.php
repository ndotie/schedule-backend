<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Schedules extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'order_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
            'technician_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
            'day' => [
                'type' => 'DATE'
            ],
            'start_at' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'end_at' => [
                'type' => 'TIME',
                'null' => true,
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
            $this->forge->createTable( 'schedules' );
    }

    public function down()
    {
        //
        $this->forge->dropTable( 'schedules' );
    }
}
