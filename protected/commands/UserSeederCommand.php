<?php

class UserSeederCommand extends CConsoleCommand
{
    public function run($args)
    {
        $this->createRoles();
        $this->createAdminUser();
        $this->createPegawaiForAdmin();
        echo "UserSeeder process completed.\n";
    }

    protected function createRoles()
    {
        $roles = array(
            array('nama' => 'admin', 'keterangan' => 'Administrator', 'created_at' => new CDbExpression('NOW()'), 'updated_at' => new CDbExpression('NOW()')),
            array('nama' => 'dokter', 'keterangan' => 'Dokter', 'created_at' => new CDbExpression('NOW()'), 'updated_at' => new CDbExpression('NOW()')),
            array('nama' => 'perawat', 'keterangan' => 'Perawat', 'created_at' => new CDbExpression('NOW()'), 'updated_at' => new CDbExpression('NOW()')),
            array('nama' => 'pasien', 'keterangan' => 'Pasien', 'created_at' => new CDbExpression('NOW()'), 'updated_at' => new CDbExpression('NOW()')),
        );

        foreach ($roles as $role) {
            Yii::app()->db->createCommand()->insert('role', $role);
        }
    }

    protected function createAdminUser()
    {
        $role = Yii::app()->db->createCommand()->select('id')->from('role')->where('nama=:nama', array(':nama' => 'admin'))->queryRow();

        $data = array(
            'username' => 'admin',
            'password' => md5('admin123@'),
            'email' => 'admin2@klinik.com',
            'role_id' => $role['id'],
            'created_at' => new CDbExpression('NOW()'),
            'updated_at' => new CDbExpression('NOW()'),
        );

        Yii::app()->db->createCommand()->insert('user', $data);
    }

    protected function createPegawaiForAdmin()
    {
        $user = Yii::app()->db->createCommand()->select('id')->from('user')->where('username=:username', array(':username' => 'admin'))->queryRow();

        $data = array(
            'nama' => 'Admin Klinik',
            'alamat' => 'Jl. Klinik No. 1',
            'telepon' => '08123456789',
            'email' => 'admin@klinik.com',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1995-01-01',
            'jabatan' => 'Admin',
            'created_at' => new CDbExpression('NOW()'),
            'updated_at' => new CDbExpression('NOW()'),
            'user_id' => $user['id'],
        );

        Yii::app()->db->createCommand()->insert('pegawai', $data);
    }
}