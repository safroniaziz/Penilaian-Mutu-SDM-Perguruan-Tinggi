<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperatorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'unit_id'   =>  10,
                'nama_lengkap'    => 'Operator LPMPP',
                'nip' =>1111,
                'nidn' =>1111,
                'password'  =>  bcrypt('password'),
                'akses'     =>  'lpmpp',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'unit_id'   =>  7,
                'nama_lengkap'    => 'Operator FT',
                'nip' =>2222,
                'nidn' =>2222,
                'password'  =>  bcrypt('password'),
                'akses'     =>  'operator_fakultas',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
