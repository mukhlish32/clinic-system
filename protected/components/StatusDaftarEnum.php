<?php

class StatusDaftarEnum
{
    const BATAL = 0;
    const PROSES = 1;
    const SELESAI = 2;

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case self::BATAL:
                return 'Batal';
            case self::PROSES:
                return 'Proses';
            case self::SELESAI:
                return 'Selesai';
            default:
                return '-';
        }
    }
}
