<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User();
            $data->id       = Uuid::uuid4()->getHex();
            $data->name     = "admin";
            $data->password = bcrypt("Admin123silk");
            $data->role_id  = 1;
            $data->save();
    }
}
