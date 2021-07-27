<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoryCosts extends AbstractMigration
{
    /** Create something in base */
    public function up()
    {
        $this->table('category_costs')
            ->addColumn('name', 'string') /** Varchar(255) */
            ->addColumn('created_at', 'datetime') /** datetime */
            ->addColumn('updated_at', 'datetime') /** datetime */
            ->save();
    }

    /** Revert migration */
    public function down()
    {
        /** Drop with table name */
        $this->dropTable('category_cost');
    }
}
