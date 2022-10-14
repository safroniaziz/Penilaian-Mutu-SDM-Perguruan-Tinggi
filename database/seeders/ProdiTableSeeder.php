<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prodis')->insert([
            [
                'fakultas_id'   =>  7,
                'nama_prodi'    => 'INFORMATIKA',
                'jumlah_mahasiswa' =>1383,
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'fakultas_id'   =>  7,
                'nama_prodi'    => 'TEKNIK SIPIL',
                'jumlah_mahasiswa' =>1554,
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'fakultas_id'   =>  7,
                'nama_prodi'    => 'TEKNIK MESIN',
                'jumlah_mahasiswa' =>1188,
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'fakultas_id'   =>  7,
                'nama_prodi'    => 'TEKNIK ELEKTRO',
                'jumlah_mahasiswa' =>1146,
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'fakultas_id'   =>  7,
                'nama_prodi'    => 'ARSITEKTUR',
                'jumlah_mahasiswa' =>240,
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'fakultas_id'   =>  7,
                'nama_prodi'    => 'SISTEM INFORMASI',
                'jumlah_mahasiswa' =>292,
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
