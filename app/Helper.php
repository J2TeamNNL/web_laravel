<?php

if (!function_exists('checkSuperAdmin')) {
    function checkSuperAdmin(): bool
    {
        return session()->get('level') === 1;
    }
}