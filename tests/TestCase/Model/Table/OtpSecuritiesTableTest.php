<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OtpSecuritiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OtpSecuritiesTable Test Case
 */
class OtpSecuritiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OtpSecuritiesTable
     */
    protected $OtpSecurities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OtpSecurities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OtpSecurities') ? [] : ['className' => OtpSecuritiesTable::class];
        $this->OtpSecurities = $this->getTableLocator()->get('OtpSecurities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OtpSecurities);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OtpSecuritiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
