<?php

//  This file will store the current layout that's being used.
//  Here, the env function will fetch the value of LAYOUT from the .env file.
//  If it doesn't exist, it will default to 'layout1'.
return [
    'current' => env('LAYOUT', 'app2'),
];
