<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BankTransactionHistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BankTransactionHistoriesTable Test Case
 */
class BankTransactionHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BankTransactionHistoriesTable
     */
    protected $BankTransactionHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BankTransactionHistories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BankTransactionHistories') ? [] : ['className' => BankTransactionHistoriesTable::class];
        $this->BankTransactionHistories = $this->getTableLocator()->get('BankTransactionHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BankTransactionHistories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BankTransactionHistoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
