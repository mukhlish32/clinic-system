<?php

class m250112_050000_create_permissions_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('permission', array(
            'role_id' => 'integer NOT NULL',
            'menu' => 'string NOT NULL',
            'actions' => 'text NOT NULL',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ));

        // Foreign key linking to the role table
        $this->addForeignKey('fk_permissions_role', 'permission', 'role_id', 'role', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_permissions_role', 'permission');
        $this->dropTable('permission');
    }
}
