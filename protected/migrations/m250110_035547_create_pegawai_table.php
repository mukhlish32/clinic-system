<?php

class m250110_035547_create_pegawai_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('pegawai', array(
            'id' => 'pk',
            'nama' => 'string NOT NULL',
            'alamat' => 'text',
            'telepon' => 'string',
            'email' => 'string',
            'jenis_kelamin' => 'string',
            'tanggal_lahir' => 'date',
            'jabatan' => 'string',
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

            'user_id' => 'integer NULL',
        ));

        $this->addForeignKey('fk_pegawai_user', 'pegawai', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
        $this->dropForeignKey('fk_pegawai_user', 'pegawai');
		$this->dropTable('pegawai');
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