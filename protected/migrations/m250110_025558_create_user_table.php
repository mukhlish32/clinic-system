<?php

class m250110_025558_create_user_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('user', array(
            'id' => 'pk',
			'username' => 'string NOT NULL UNIQUE',
            'password' => 'string NOT NULL',
            'email' => 'string',
            'role_id' => 'integer NOT NULL',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
        ));

        // Add foreign key for role
        $this->addForeignKey('fk_user_role', 'user', 'role_id', 'role', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('user');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}