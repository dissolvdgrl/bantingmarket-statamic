<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class NextMarket extends Tags
{
    protected static $handle = 'next_market';

    public function index()
    {
        $first = date('j', strtotime('first saturday of this month'));
        $last = date('j', strtotime('last saturday of this month'));
        $which_market = $this->params->get('market');
        $next_market_date = "";

        if ($which_market === "boeremark") {
            if (date('j') <= $first)
            {
                $next_market_date = date('j F Y', strtotime('first saturday of this month'));
            }
            else
            {
                $next_market_date = date('j F Y', strtotime('first saturday of next month'));
            }
        }

        if ($which_market === "menlyn_maine") {
            if (date('j') <= $last)
            {
                $next_market_date = date('j F Y', strtotime('last saturday of this month'));
            }
            else
            {
                $next_market_date = date('j F Y', strtotime('last saturday of next month'));
            }
        }

        return $next_market_date;
    }
}
