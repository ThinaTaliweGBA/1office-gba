<?php
/**
 * PHP version 9
 *
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;

class migrateandseed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrateandseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix up the database and seed in data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        exec('php artisan migrate');
        $this->info('Fixed permissions table.');
        exec('php artisan migrate');
        $this->info('Fixed roles table.');
        exec('php artisan migrate');
        $this->info('Fixed model_has_roles table.');
        exec('php artisan migrate');
        $this->info('Migration Completed!');
        $this->info('-----------------------------------');
        exec('php artisan db:seed --class=BasicAdminPermissionSeeder');
        $this->info('Seeded BasicAdminPermissionSeeder!');
        exec('php artisan db:seed --class=DatabaseSeeder');
        $this->info('Seeded DatabaseSeeder!');
        exec('php artisan db:seed --class=MembershipSeeder');
        $this->info('Seeded MembershipSeeder!');
        $this->info('-----------------------------------');
        $this->info('SUCCESS, serve and test your site!!');
        
    }
}
