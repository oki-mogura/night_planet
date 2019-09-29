<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiarysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiarysTable Test Case
 */
class DiarysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DiarysTable
     */
    public $Diarys;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Diarys',
        'app.Casts',
        'app.DiaryLikes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Diarys') ? [] : ['className' => DiarysTable::class];
        $this->Diarys = TableRegistry::getTableLocator()->get('Diarys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Diarys);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
