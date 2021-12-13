<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('fullname', 'string', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('avatar', 'string', [
            'default' => 'avatar-default.png',
            'null' => false,
        ]);
        $table->addColumn('cash', 'string', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('coin', 'string', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('token_renew', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('token_login', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('role', 'string', [
            'default' => 'user',
            'null' => false,
        ]);
        $table->addColumn('delete_flag', 'integer', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
