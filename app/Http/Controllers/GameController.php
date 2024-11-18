<?php

namespace App\Http\Controllers;

use App\Models\NuxUser;

class GameController extends Controller
{
    public function play()
    {
        $number = rand(1, 1000);
        $win = $number % 2 == 0;
        $winAmount = 0;
        if ($win) {
            if ($number > 900) {
                $winAmount = round($number * 0.7);
            } elseif ($number > 600) {
                $winAmount = round($number * 0.5);
            } elseif ($number > 300) {
                $winAmount = round($number * 0.3);
            } else {
                $winAmount = round($number * 0.1);
            }
        }
        /** @var NuxUser $nuxUser */
        $nuxUser = session('nuxUser');
        $nuxUser->historyGames()->create([
            'number' => $number,
            'win' => $win,
            'winAmount' => $winAmount]
        );

        return response()->json(compact('number', 'win', 'winAmount'));
    }

    public function history()
    {
        /** @var NuxUser $nuxUser */
        $nuxUser = session('nuxUser');
        $historyGames = $nuxUser->historyGames()
            ->latest()
            ->take(3)
            ->get()
            ->toArray();

        return response()->json($historyGames);
    }
}
