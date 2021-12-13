<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTransactionHistories extends AbstractMigration
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
        $table = $this->table('transaction_histories');
        $table->addColumn('tranding_code', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('transmitter', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('receiver', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('amount_of_money', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('content', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('ip', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
