<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(15)->create();
        // \App\Models\Pelanggaran::factory(1000)->create();
        // \App\Models\Student::factory(15)->create();
        // \App\Models\Teacher::factory(15)->create();
        $this->call(LaratrustSeeder::class);
        DB::table('pelanggarans')->insert([
            ['nama' => 'Terlambat', 'poin' => 10, 'keterangan' => '-'],
            ['nama' => 'Tidak Piket', 'poin' => 20, 'keterangan' => '-'],
            ['nama' => 'Tidak Berseragam', 'poin' => 30, 'keterangan' => '-'],
            ['nama' => 'Buang Sampah Sembarangan', 'poin' => 30, 'keterangan' => '-'],
            ['nama' => 'Membuat izin palsu', 'poin' => 50, 'keterangan' => '-'],
            ['nama' => 'Melindungi teman yang salah/provokator', 'poin' => 60, 'keterangan' => '-'],
            ['nama' => 'Melompat pagar/tidak mengikuti upacara', 'poin' => 30, 'keterangan' => '-'],
            ['nama' => 'Mengganggu/mengacau kelas lain', 'poin' => 10, 'keterangan' => '-'],
            ['nama' => 'Bersikap tidak sopan/menentang guru/karyawan', 'poin' => 20, 'keterangan' => '-'],
            ['nama' => 'Melakukan tindakan amoral', 'poin' => 20, 'keterangan' => '-'],
            ['nama' => 'Membawa dan merokok pada lingkungan sekolah', 'poin' => 15, 'keterangan' => '-'],
            ['nama' => 'Berbahasa yang kotor/kasar kepada teman/orang lain', 'poin' => 25, 'keterangan' => '-'],
            ['nama' => 'Membuat tato pada anggota badan', 'poin' => 55, 'keterangan' => '-'],
            ['nama' => 'Memalsu tanda tangan walikelas, guru dan kepala sekolah', 'poin' => 30, 'keterangan' => '-'],
            ['nama' => 'Membawa/minum minuman keras', 'poin' => 75, 'keterangan' => '-'],
        ]);
    }
}
