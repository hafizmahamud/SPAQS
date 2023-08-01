<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;
use App\Domains\Auth\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Roles::create([
            'id' => 2,
            'type' => User::TYPE_ADMIN,
            'name' => 'PENTADBIR SISTEM',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 3,
            'type' => User::TYPE_USER,
            'name' => 'PENGESAH NOMBOR PEROLEHAN',
            'guard_name' => 'web',
        ]);

        
        Roles::create([
            'id' => 4,
            'type' => User::TYPE_USER,
            'name' => 'PENGIKLAN',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 5,
            'type' => User::TYPE_USER,
            'name' => 'PENYARING PETENDER',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 6,
            'type' => User::TYPE_USER,
            'name' => 'PENDAFTAR JADUAL HARGA',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 7,
            'type' => User::TYPE_USER,
            'name' => 'PENDAFTAR PENILAI',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 8,
            'type' => User::TYPE_USER,
            'name' => 'PEGAWAI PENILAI 1',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 9,
            'type' => User::TYPE_USER,
            'name' => 'PEGAWAI PENILAI 2',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 10,
            'type' => User::TYPE_USER,
            'name' => 'PENDAFTAR KEPUTUSAN LP',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 11,
            'type' => User::TYPE_USER,
            'name' => 'PENYEDIA DOKUMEN',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 12,
            'type' => User::TYPE_USER,
            'name' => 'PELAKSANA',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'id' => 13,
            'type' => User::TYPE_USER,
            'name' => 'KETUA PENILAI',
            'guard_name' => 'web',
        ]);
    }
}
