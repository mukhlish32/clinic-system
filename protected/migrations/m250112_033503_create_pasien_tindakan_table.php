<?php

class m250112_033503_create_pasien_tindakan_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('pasien_tindakan', [
            'id' => 'pk',
            'pasien_daftar_id' => 'int NOT NULL',
            'tindakan_id' => 'int NOT NULL',
            'tgl_transaksi' => 'datetime NOT NULL',
            'pegawai_id' => 'int NOT NULL',
            'harga' => 'decimal(10,2) NOT NULL',
            'jumlah' => 'int NOT NULL',
            'total' => 'decimal(10,2) NOT NULL',
            'status_bayar' => 'smallint DEFAULT 0',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_by' => 'string',
            'updated_by' => 'string',
        ]);

        $this->addForeignKey('fk_pasien_tindakan_pasien_daftar', 'pasien_tindakan', 'pasien_daftar_id', 'pasien_daftar', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_pasien_tindakan_tindakan', 'pasien_tindakan', 'tindakan_id', 'tindakan', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_pasien_tindakan_pegawai', 'pasien_tindakan', 'pegawai_id', 'pegawai', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_pasien_tindakan_pasien_daftar', 'pasien_tindakan');
        $this->dropForeignKey('fk_pasien_tindakan_tindakan', 'pasien_tindakan');
        $this->dropForeignKey('fk_pasien_tindakan_pegawai', 'pasien_tindakan');
        $this->dropTable('pasien_tindakan');
    }
}
