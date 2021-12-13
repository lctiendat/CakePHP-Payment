<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBankOfUsers extends AbstractMigration
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
        $table = $this->table('bank_of_users');
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('bank', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('holder', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('card_number', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('date_card', 'string', [
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
        $table->create();
    }
}
