<?php

class UserIdentity extends CUserIdentity
{
    public function authenticate()
    {
        $user = User::model()->findByAttributes(['username' => $this->username]);
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($user->password !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->setState('role', $user->role_id);
            $this->setState('id', $user->id);
            $this->setState('username', $user->username);

            $pegawai = $user ? $user->pegawai : null;
            Yii::app()->user->setState('pegawai', $pegawai);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
}
