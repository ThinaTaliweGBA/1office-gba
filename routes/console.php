<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command(
    'inspire', function () {
        $this->comment(Inspiring::quote());
    }
)->purpose('Display an inspiring quote');

Artisan::command(
    'project:init', function () {

        // Artisan::call('migrate', ['--path=/database/migrations/create_store_address_procedure.php']); 
        Artisan::call('db:seed', ['--class=DatabaseSeeder']);
        Artisan::call('db:seed', ['--class=MembershipSeeder']);
        // Artisan::call('migrate' , ['--path=/database/migrations/2022_12_07_223001_create_permission_tables.php']);
        Artisan::call('db:seed', ['--class=BasicAdminPermissionSeeder']);
    }
)->describe('Running commands');