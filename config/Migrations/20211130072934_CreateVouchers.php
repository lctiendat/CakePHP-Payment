<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateVouchers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('vouchers');
        $table->addColumn('title', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('description', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('code', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('money', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('amount', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('coin', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('type', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('delete_flag', 'integer', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('expired_time', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
