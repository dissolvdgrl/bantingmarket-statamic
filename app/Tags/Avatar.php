<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class Avatar extends Tags
{
    /**
     * The {{ avatar }} tag. Takes a vendor parameter and modifies it to return only the initials
     *
     * @return string|array
     */
    public function index()
    {
        $vendor_title = $this->params->get('vendor');
        $title_exploded = explode(" ", $vendor_title);
        $initials = "";

        foreach($title_exploded as $title) {
            $initials .= $title[0];
        }

        return "$initials[0]$initials[-1]";
    }
}
