<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApiConnectTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApiConnectTable Test Case
 */
class ApiConnectTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApiConnectTable
     */
    protected $ApiConnect;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ApiConnect',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ApiConnect') ? [] : ['className' => ApiConnectTable::class];
        $this->ApiConnect = $this->getTableLocator()->get('ApiConnect', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ApiConnect);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ApiConnectTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
