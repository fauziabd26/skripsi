<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->id = '1';
		$admin->name         = 'admin';
		$admin->save();

		$dosen = new Role();
		$dosen->id = '2';
		$dosen->name = 'dosen';
		$dosen->save();

		$mahasiswa = new Role();
		$mahasiswa->id = '3';
		$mahasiswa->name = 'mahasiswa';
		$mahasiswa->save();

        $kalab = new Role();
		$kalab->id = '4';
		$kalab->name = 'kalab';
		$kalab->save();
    }
}
