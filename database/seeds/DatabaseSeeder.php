<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // call our class and run our seeds
        $this->call('BearAppSeeder');
        $this->command->info('Bear app seeds finished.'); // show information in the command line after everything is run
    }

}
