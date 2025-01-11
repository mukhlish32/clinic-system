<?php

class m250110_035607_create_pasien_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('pasien', array(
            'id' => 'pk',
            'nama' => 'string NOT NULL',
			'nik' => 'string',
            'alamat' => 'text',
            'telp' => 'string',
            'email' => 'string',
            'tgl_lahir' => 'date',
            'jns_kelamin' => 'string',
            'gol_darah' => 'string',
            'agama' => 'string',
            'alamat' => 'string',
            'kelurahan' => 'string',
            'kecamatan' => 'string',
            'kota' => 'string',
            'provinsi' => 'string',
            'kode_pos' => 'varchar(5)',
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
		$this->dropTable('pasien');
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