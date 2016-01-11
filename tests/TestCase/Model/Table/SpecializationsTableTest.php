<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecializationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecializationsTable Test Case
 */
class SpecializationsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.specializations',
        'app.users',
        'app.positions',
        'app.users_positions',
        'app.skills',
        'app.users_skills',
        'app.users_specializations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Specializations') ? [] : ['className' => 'App\Model\Table\SpecializationsTable'];
        $this->Specializations = TableRegistry::get('Specializations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Specializations);

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
}
