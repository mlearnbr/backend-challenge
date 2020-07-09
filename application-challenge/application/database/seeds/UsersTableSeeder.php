<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'msisdn' => '+5598991695617',
            'name' => 'Marcony Caldeira',
            'access_level' => 'free',
            'password' => '123',
            'external_id' => '38'
        ]);
    }
}
