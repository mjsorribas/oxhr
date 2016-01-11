<?php
use Migrations\AbstractMigration;

class AddTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        // Create Users table
        //id, username, password, first_name, last_name, birthday, ssh_key,  created, updated
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit'=>'32'])
            ->addColumn('password', 'string', ['limit'=>'255'])
            ->addColumn('first_name', 'string', ['limit' => '32'])
            ->addColumn('last_name', 'string', ['limit' => '32'])
            ->addColumn('email', 'string', ['limit' => '150'])
            ->addColumn('gmail', 'string', ['limit' => '150'])
            ->addColumn('skype', 'string', ['limit' => '50'])
            ->addColumn('birthday', 'date')
            ->addColumn('ssh_key', 'text')
            ->addColumn('table_num', 'integer', ['limit'=>4])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        // Create "Skills" table
        // id, skills_goups_id, name, created, updated
        $table = $this->table('skills');
        $table->addColumn('skills_groups_id', 'integer', ['limit'=>'11'])
            ->addColumn('name', 'string', ['limit'=>'32'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        // Create table "skills_groups"
        $table = $this->table('skills_groups');
        $table->addColumn('name', 'string', ['limit'=>'32'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();


        // Create table "specializations"
        $table = $this->table('specializations');
        $table->addColumn('name', 'string', ['limit'=>'32'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        // Create table "positions" - должность сотрудника
        $table = $this->table('positions');
        $table->addColumn('name', 'string', ['limit'=>'32'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        // Create table "projects" - проекты
        $table = $this->table('projects');
        $table->addColumn('name', 'string', ['limit'=>'32'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();


        // Таблицы связей

        // Create table "users_skills"
        $table = $this->table('users_skills', [
            'id' => false
        ]);
        $table->addColumn('user_id', 'integer', ['limit'=>'11'])
            ->addColumn('skill_id', 'integer', ['limit'=>'11'])
            ->addColumn('level', 'integer', ['limit'=>'1'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        // Table to save a connections users and positions
        $table = $this->table('users_positions');
        $table->addColumn('user_id', 'integer', ['limit'=>'11'])
            ->addColumn('position_id', 'integer', ['limit'=>'11'])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        // Table to save a connections users with specializations
        $table = $this->table('users_specializations');
        $table->addColumn('user_id', 'integer', ['limit' => '11'])
            ->addColumn('specialization_id', 'integer', ['limit' => '11'])
            ->addColumn('descriptions', 'text')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }

}
