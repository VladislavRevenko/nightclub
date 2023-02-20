<?php

namespace App\Http\Controllers;

use App\Models\NightClub;
use Illuminate\Support\Facades\Redis;

class NightClubController
{
    public static function clubWorks()
    {
        $nightClub = new NightClub;
        $clubStatus = $nightClub->checkClubWorks();
        if ($clubStatus) {
            list($visitors, $records) = $nightClub->getVisitors();
            $timeLeft = Redis::get('stoptWorking') - time();

            return view('club', [
                'records' => $records,
                'visitors' => $visitors,
                'timeLeft' => $timeLeft]);
        } else {
            return view('welcome');
        }
    }

    public static function clubStartWorking()
    {
        $nightClub = new NightClub;
        $nightClub->startWorking();
        list($visitors, $records) = $nightClub->getVisitors();
        $timeLeft = Redis::get('stoptWorking') - time();

        return view('club', [
            'records' => $records,
            'visitors' => $visitors,
            'timeLeft' => $timeLeft]);
    }
}
