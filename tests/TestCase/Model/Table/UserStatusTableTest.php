<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserStatusTable Test Case
 */
class UserStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserStatusTable
     */
    protected $UserStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserStatus') ? [] : ['className' => UserStatusTable::class];
        $this->UserStatus = $this->getTableLocator()->get('UserStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserStatus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UserStatusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
