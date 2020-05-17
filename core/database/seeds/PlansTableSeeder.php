<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert(
            array(
                array('id' => '1', 'name' => 'king', 'price' => '500.00', 'ref_bonus' => '2.00', 'status' => '1', 'created_at' => '2020-04-16 12:10:26', 'updated_at' => '2020-04-16 12:10:26'),
                array('id' => '2', 'name' => 'king', 'price' => '500.00', 'ref_bonus' => '2.00', 'status' => '1', 'created_at' => '2020-04-16 12:13:33', 'updated_at' => '2020-04-16 12:13:33')
            )
        );

        DB::table('matrix_levels')->insert(
            array(
                array('id' => '1', 'plan_id' => '1', 'amount' => '2', 'level' => '1', 'created_at' => '2020-04-16 12:10:26', 'updated_at' => '2020-04-16 12:10:26'),
                array('id' => '2', 'plan_id' => '1', 'amount' => '3', 'level' => '2', 'created_at' => '2020-04-16 12:10:26', 'updated_at' => '2020-04-16 12:10:26'),
                array('id' => '3', 'plan_id' => '1', 'amount' => '5', 'level' => '3', 'created_at' => '2020-04-16 12:10:26', 'updated_at' => '2020-04-16 12:10:26'),
                array('id' => '4', 'plan_id' => '1', 'amount' => '7', 'level' => '4', 'created_at' => '2020-04-16 12:10:26', 'updated_at' => '2020-04-16 12:10:26'),
                array('id' => '5', 'plan_id' => '1', 'amount' => '10', 'level' => '5', 'created_at' => '2020-04-16 12:10:26', 'updated_at' => '2020-04-16 12:10:26'),
                array('id' => '6', 'plan_id' => '2', 'amount' => '2', 'level' => '1', 'created_at' => '2020-04-16 12:13:33', 'updated_at' => '2020-04-16 12:13:33'),
                array('id' => '7', 'plan_id' => '2', 'amount' => '3', 'level' => '2', 'created_at' => '2020-04-16 12:13:33', 'updated_at' => '2020-04-16 12:13:33'),
                array('id' => '8', 'plan_id' => '2', 'amount' => '5', 'level' => '3', 'created_at' => '2020-04-16 12:13:33', 'updated_at' => '2020-04-16 12:13:33'),
                array('id' => '9', 'plan_id' => '2', 'amount' => '7', 'level' => '4', 'created_at' => '2020-04-16 12:13:33', 'updated_at' => '2020-04-16 12:13:33'),
                array('id' => '10', 'plan_id' => '2', 'amount' => '10', 'level' => '5', 'created_at' => '2020-04-16 12:13:33', 'updated_at' => '2020-04-16 12:13:33')
            )
        );
    }
}
