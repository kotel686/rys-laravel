<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Dev-state lock for the Lezecká stěna mini-site
    |--------------------------------------------------------------------------
    |
    | While the climbing-wall section is in pre-launch / dev state we keep
    | it behind HTTP Basic Auth so only the assigned tester can browse it.
    | Leave either value empty to disable the gate (i.e. at public launch).
    |
    */

    'dev_lock' => [
        'user' => env('CLIMBING_DEV_LOCK_USER', 'kotel686'),
        'password' => env('CLIMBING_DEV_LOCK_PASSWORD'),
    ],

];
