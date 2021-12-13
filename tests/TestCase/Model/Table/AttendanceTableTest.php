<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendanceTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendanceTable Test Case
 */
class AttendanceTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendanceTable
     */
    protected $Attendance;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Attendance',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Attendance') ? [] : ['className' => AttendanceTable::class];
        $this->Attendance = $this->getTableLocator()->get('Attendance', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Attendance);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AttendanceTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
