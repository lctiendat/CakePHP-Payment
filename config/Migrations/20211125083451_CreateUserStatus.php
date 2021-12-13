<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUserStatus extends AbstractMigration
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
        $table = $this->table('user_status');
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('lock_time', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('reason', 'string', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('delete_flag', 'integer', [
            'default' => 1,
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
