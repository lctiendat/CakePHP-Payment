<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransactionHistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransactionHistoriesTable Test Case
 */
class TransactionHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TransactionHistoriesTable
     */
    protected $TransactionHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TransactionHistories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TransactionHistories') ? [] : ['className' => TransactionHistoriesTable::class];
        $this->TransactionHistories = $this->getTableLocator()->get('TransactionHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TransactionHistories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TransactionHistoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
