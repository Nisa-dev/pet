<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
            'type' => 'Admin',
        ]);

        User::create([
            'name' => 'Deliveryman 1',
            'username' => 'deliveryman1',
            'email' => 'deliveryman1@mail.com',
            'password' => bcrypt('12345678'),
            'type' => 'Deliveryman',
        ]);

        User::create([
            'name' => 'Deliveryman 2',
            'username' => 'deliveryman2',
            'email' => 'deliveryman2@mail.com',
            'password' => bcrypt('12345678'),
            'type' => 'Deliveryman',
        ]);

        User::create([
            'name' => 'Member',
            'username' => 'member',
            'email' => 'member@mail.com',
            'password' => bcrypt('12345678'),
            'type' => 'Member',
        ]);
    }
}
