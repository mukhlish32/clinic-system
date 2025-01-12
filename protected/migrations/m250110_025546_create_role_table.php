<?php

class m250110_025546_create_role_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('role', array(
            'id' => 'pk',
            'nama' => 'string NOT NULL',
            'keterangan' => 'text',
			'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
        ));
	}

	public function down()
	{
		$this->dropTable('role');
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