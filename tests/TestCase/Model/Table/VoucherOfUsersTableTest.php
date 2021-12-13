<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoucherOfUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoucherOfUsersTable Test Case
 */
class VoucherOfUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VoucherOfUsersTable
     */
    protected $VoucherOfUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.VoucherOfUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VoucherOfUsers') ? [] : ['className' => VoucherOfUsersTable::class];
        $this->VoucherOfUsers = $this->getTableLocator()->get('VoucherOfUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->VoucherOfUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VoucherOfUsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
