<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateVoucherOfUsers extends AbstractMigration
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
        $table = $this->table('voucher_of_users');
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('code', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('ip', 'string', [
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
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
