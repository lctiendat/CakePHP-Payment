<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserLatestIpTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserLatestIpTable Test Case
 */
class UserLatestIpTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserLatestIpTable
     */
    protected $UserLatestIp;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserLatestIp',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserLatestIp') ? [] : ['className' => UserLatestIpTable::class];
        $this->UserLatestIp = $this->getTableLocator()->get('UserLatestIp', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserLatestIp);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UserLatestIpTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
