<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BankOfUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BankOfUsersTable Test Case
 */
class BankOfUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BankOfUsersTable
     */
    protected $BankOfUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BankOfUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BankOfUsers') ? [] : ['className' => BankOfUsersTable::class];
        $this->BankOfUsers = $this->getTableLocator()->get('BankOfUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BankOfUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BankOfUsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
