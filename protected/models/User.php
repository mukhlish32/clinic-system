<?php

class User extends CrudModel
{
    public $confirm_password, $pegawai_id;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            ['username, password, role_id', 'required'],
            ['email', 'email'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Konfirmasi password tidak cocok.'],
        ];
    }

    public function relations()
    {
        return [
            'role' => [self::BELONGS_TO, 'Role', 'role_id'],
            'pegawai' => [self::HAS_ONE, 'Pegawai', 'user_id'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'confirm_password' => 'Konfirmasi Password',
            'email' => 'Email',
            'role_id' => 'Role',
            'pegawai_id' => 'Pegawai',
            'status' => 'Status',
            'created_by' => 'Dibuat Oleh',
            'updated_by' => 'Diperbarui Oleh',
        ];
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord || $this->password !== $this->getOldAttribute('password')) {
            $this->password = CPasswordHelper::hashPassword($this->password);
        }

        return parent::beforeSave();
    }

    public function getRole()
    {
        return $this->hasOne('Role', 'id', 'role_id');
    }

    public function hasPermission($menu)
    {
        $role = $this->role;
        $permissions = Permission::model()->findAllByAttributes(['role_id' => $role->id]);

        foreach ($permissions as $permission) {
            if ($permission->menu == $menu) {
                return true;
            }
        }

        return false;
    }
}
