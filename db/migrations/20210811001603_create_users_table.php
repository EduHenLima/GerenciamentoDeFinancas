<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $this->table('users')
            ->addColumn('firstname', 'string')
            ->addColumn('lastname','string')
            ->addColumn('email','string')
            ->addColumn('password','string')
            ->addColumn('created_at','datetime')
            ->addColumn('updated_at','datetime')
            ->addIndex(['email'],['unique' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
