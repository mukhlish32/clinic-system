<?php

class m250110_035058_create_wilayah_table extends CDbMigration
{
	public function up()
    {
        $this->createTable('wilayah', array(
            'id' => 'pk',
            'kelurahan' => 'varchar(255) NOT NULL',
            'kecamatan' => 'varchar(255) NOT NULL',
            'kota' => 'varchar(255) NOT NULL', //kota atau kabupaten
            'provinsi' => 'varchar(255) NOT NULL',
            'kode_pos' => 'varchar(5) NOT NULL',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
        ));

        $this->createIndex('idx_kode_pos', 'wilayah', 'kode_pos');
    }

    public function down()
    {
        $this->dropIndex('idx_kode_pos', 'wilayah');
        $this->dropTable('wilayah');
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