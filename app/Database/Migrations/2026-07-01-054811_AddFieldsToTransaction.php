<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExtraFieldsToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'ppn' => [
                'type'    => 'DOUBLE',
                'null'    => TRUE,
                'default' => 0,
                'after'   => 'diskon',
            ],
            'biaya_admin' => [
                'type'    => 'DOUBLE',
                'null'    => TRUE,
                'default' => 0,
                'after'   => 'ppn',
            ],
            'kupon_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => TRUE,
                'default'    => NULL,
                'after'      => 'biaya_admin',
            ],
            'diskon_kupon' => [
                'type'    => 'DOUBLE',
                'null'    => TRUE,
                'default' => 0,
                'after'   => 'kupon_code',
            ],
        ];

        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', ['diskon', 'ppn', 'biaya_admin', 'kupon_code', 'diskon_kupon']);
    }
}