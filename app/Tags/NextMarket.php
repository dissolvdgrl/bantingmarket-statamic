<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class NextMarket extends Tags
{
    protected static $handle = 'next_market';

    public function index()
    {
        $first = date('j', strtotime('first saturday of this month'));
        $next_market_date = "";

        if (date('j') <= $first)
        {
            $next_market_date = date('j F Y', strtotime('first saturday of this month'));
        }
        else
        {
            $next_market_date = date('j F Y', strtotime('first saturday of next month'));
        }
        return $next_market_date;
    }
}
