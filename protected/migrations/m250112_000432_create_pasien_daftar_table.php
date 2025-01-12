<?php

class m250112_000432_create_pasien_daftar_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('pasien_daftar', array(
			'id' => 'pk',
            'pasien_id' => 'integer NOT NULL',
            'tgl_daftar' => 'datetime NOT NULL',
			'keterangan' => 'text', 
			'status' => 'smallint DEFAULT 1',
			'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
		));

		$this->execute('COMMENT ON COLUMN pasien_daftar.status IS \'1 = proses, 0 = batal, 2 = selesai\'');
		$this->createIndex('idx_pasien_id', 'pasien_daftar', 'pasien_id');
		$this->addForeignKey(
			'fk_pasien_daftar_pasien', 'pasien_daftar', 'pasien_id', 'pasien', 'id', 'CASCADE', 'CASCADE'
		);
	}

	public function down()
	{
		$this->dropForeignKey('fk_pasien_daftar_pasien', 'pasien_daftar');
        $this->dropIndex('idx_pasien_id', 'pasien_daftar');
		$this->dropTable('pasien_daftar');
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
