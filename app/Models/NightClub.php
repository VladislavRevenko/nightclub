<?php

namespace App\Models;

use Illuminate\Support\Facades\Redis;
use App\Models\Visitors;

class NightClub
{
    public static $record;
    public $maxVisitors;

    public function __construct()
    {
         static::$record = Records::getRecord();
         $this->maxVisitors = 100;
    }

    /**
     * Запускаем работу клуба
     * @return void
     */
    public function startWorking()
    {
         Redis::set('startWorking', time());
         Redis::set('stoptWorking', time() + 100);
         Redis::set('visitorsCount', rand(5,20));
    }

    /**
     * Получаем информацию обо всех посетителях и текущей музыке
     * @return array
     */
    public function getVisitors()
    {
         $visitorsCount = Redis::get('visitorsCount');
         $visitors = new Visitors;
         $allVisitors = $visitors->getVisitors($visitorsCount);
         $this->increaseVisitorsCount($visitorsCount);

         return [$allVisitors, static::$record];
    }

    /**
     * Получаем текущую музыку, которая играет в клубе
     * @return stirng
     */
    public function getRecords()
    {
         return static::$record;
    }

    /**
     * Проверяем работает ли клуб
     * @return bool
     */
    public function checkClubWorks()
    {
        if (Redis::get('stoptWorking') < time()) {
            Redis::set('visitorsCount', 0);
            return false;
        }
        return true;  
    }

    /**
     * Увеличиваем число посетителей клуба со временем
     * @param int $visitorsCount
     * @return void 
     */
    public function increaseVisitorsCount($visitorsCount)
    {
         if ($visitorsCount < $this->maxVisitors) {
               $visitorsCount += rand(1,10);
               Redis::set('visitorsCount', $visitorsCount);  
         }
    }
}
