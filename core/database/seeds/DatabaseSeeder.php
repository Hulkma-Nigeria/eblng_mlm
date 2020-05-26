<?php

use App\Frontend;
use App\Helpers\Peach;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $peach = new Peach();
        $peach->saveBanks();
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            FrontendsTableSeeder::class,
            GeneralSettingsTableSeeder::class,
            EmailSmsTemplatesTableSeeder::class,
            PluginsTableSeeder::class,
            GatewaysTableSeeder::class,
            PlansTableSeeder::class
        ]);
    }
}
