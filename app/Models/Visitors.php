<?php

namespace App\Models;

use App\Models\Dances;
use App\Models\Records;

class Visitors extends NightClub
{
    /**
     * Получаем текущую активность посетителя
     * @return string
     */
    public function getVisitorActivity($visitorsCount)
    {
        $records = $this->getRecords();
        $availableDances = [
            Records::RNB => [Dances::HIPHOP, Dances::RNB],
            Records::ELECTROHOUSE => [Dances::ELECTROHOUSE, Dances::HOUSE],
            Records::POP =>[Dances::POP]
        ];
        
        $visitorDance = $this->getVisitorDance();
        
        if (in_array($visitorDance, $availableDances[$records])) {
            $activity = 'танцует ' . $visitorDance;
        } else {
            $activity = 'пьет водку в баре';
        }

        return $activity;
    }

    /**
     * Получаем танец посетителя
     * @return string
     */
    public function getVisitorDance() 
    {
        $dances = [
            Dances::HIPHOP, Dances::RNB, Dances::ELECTROHOUSE, Dances::HOUSE, Dances::POP
        ];

        $visitorDance = array_rand($dances);

        return $dances[$visitorDance];
    }

    /**
     * Получаем данные со всеми посетителями
     * @param int $visitorsCount текущее количество посетителей
     * @return array
     */
    public function getVisitors($visitorsCount = 1)
    {
        $visitors = [];
        for ($i = 1; $i < $visitorsCount; $i++) {
            $visitors[] = [
                'number' => $i,
                'activity' => $this->getVisitorActivity($visitorsCount)
            ];
        }
        return $visitors;
    }
}