<?php

class m250112_033514_create_pasien_obat_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('pasien_obat', [
            'id' => 'pk',
            'pasien_daftar_id' => 'int NOT NULL',
            'obat_id' => 'int NOT NULL',
			'tgl_transaksi' => 'datetime NOT NULL',
			'pegawai_id' => 'int NOT NULL',
			'harga' => 'decimal(10,2) NOT NULL',
			'jumlah' => 'int NOT NULL',
            'total' => 'decimal(10,2) NOT NULL',
            'status_bayar' => 'smallint DEFAULT 1',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
			
        ]);

        $this->addForeignKey('fk_pasien_obat_pasien_daftar', 'pasien_obat', 'pasien_daftar_id', 'pasien_daftar', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_pasien_obat_obat', 'pasien_obat', 'obat_id', 'obat', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_pasien_obat_pegawai', 'pasien_obat', 'pegawai_id', 'pegawai', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_pasien_obat_pegawai', 'pasien_obat');
        $this->dropForeignKey('fk_pasien_obat_obat', 'pasien_obat');
        $this->dropForeignKey('fk_pasien_obat_pasien_daftar', 'pasien_obat');
		$this->dropTable('pasien_obat');
    }
}
