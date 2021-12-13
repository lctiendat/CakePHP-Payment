<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBankTransactionHistories extends AbstractMigration
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
        $table = $this->table('bank_transaction_histories');
        $table->addColumn('tranding_code', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('bank', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('transaction_type', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('transaction_amount', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('recharge_code', 'string', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('status', 'string', [
            'default' => 'pending',
            'null' => false,
        ]);
        $table->addColumn('reason', 'string', [
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
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
