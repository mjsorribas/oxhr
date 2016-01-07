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
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit'=>'32'])
            ->addColumn('password', 'string', ['limit'=>'255'])
            ->addColumn('first_name', 'string', ['limit' => '32'])
            ->addColumn('last_name', 'string', ['limit' => '32'])
            ->addColumn('birthday', 'date')
            ->addColumn('ssh_key', 'text')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
    //id, username, password, first_name, last_name, birthday, ssh_key,  created, updated
}
