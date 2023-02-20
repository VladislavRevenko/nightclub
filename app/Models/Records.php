<?php

namespace App\Models;

class Records
{
    const RNB = 'RNB';
    const POP = 'Pop';
    const ELECTROHOUSE = 'Electrohouse';

    /**
     * Получаем мелодию для воспроизведения
     * @return string
     */
    public static function getRecord()
    {
        $records = [self::RNB, self::POP, self::ELECTROHOUSE];
        $record_number = array_rand($records);

        return $records[$record_number];
    }
}