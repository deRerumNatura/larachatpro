<?php

namespace App\Traits;

trait Color
{
    public function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}