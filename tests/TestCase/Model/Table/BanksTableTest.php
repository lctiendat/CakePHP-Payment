<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BanksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BanksTable Test Case
 */
class BanksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BanksTable
     */
    protected $Banks;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Banks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Banks') ? [] : ['className' => BanksTable::class];
        $this->Banks = $this->getTableLocator()->get('Banks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Banks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BanksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
