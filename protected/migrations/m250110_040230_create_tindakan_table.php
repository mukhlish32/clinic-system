<?php

class m250110_040230_create_tindakan_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tindakan', array(
			'id' => 'pk',
			'kode' => 'string NOT NULL',
			'nama' => 'string NOT NULL',
			'harga' => 'decimal(10,2) NOT NULL',
			'status' => 'smallint DEFAULT 1',
			'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
		));
	}

	public function down()
	{
		$this->dropTable('tindakan');
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
