<?php

namespace App\Models\Interfaces;

interface Routinable
{
    public static function findForUser($user, $date_start = null, $date_end =null): array;

    public function save();

}