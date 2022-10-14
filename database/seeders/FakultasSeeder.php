<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([

            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'KEGURUAN DAN ILMU PENDIDIKAN',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'HUKUM',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'EKONOMI DAN BISNIS',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'ILMU SOSIAL DAN ILMU POLITIK',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'PERTANIAN',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'MATEMATIKA DAN ILMU PENGETAHUAN ALAM',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'TEKNIK',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'KEDOKTERAN DAN ILMU KESEHATAN',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'KAMPUS MERDEKA',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'REKTORAT',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'LPTIK',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'LPPM',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'LPMPP',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'UPT PKM',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'UPT PERPUSTAKAAN',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'jenis_unit'    =>  'fakultas',
                'nama_unit' => 'UPT BAHASA',
                'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
