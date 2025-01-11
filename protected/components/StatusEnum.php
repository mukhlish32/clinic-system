<?php

class StatusEnum
{
    const AKTIF = 1;
    const NONAKTIF = 0;

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case self::AKTIF:
                return 'Aktif';
            case self::NONAKTIF:
                return 'Tidak Aktif';
            default:
                return '-';
        }
    }
}
