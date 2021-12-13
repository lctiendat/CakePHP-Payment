<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateApiConnect extends AbstractMigration
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
        $table = $this->table('api_connect');
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('public_key', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('security_key', 'string', [
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
