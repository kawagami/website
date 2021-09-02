<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StocksUserIdUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')
            ->where('user_id', null)
            ->update(['user_id' => 1]);
    }
}
