<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'                  => 'Admin User',
            'email'                 => 'admin@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::ADMIN,
            'profile_photo_path'    => 'profile-photos/author-four.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'Writer User 1',
            'email'                 => 'writer1@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::WRITER,
            'profile_photo_path'    => 'profile-photos/author-one.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'Writer User 2',
            'email'                 => 'writer2@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::WRITER,
            'profile_photo_path'    => 'profile-photos/author-two.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'Writer User 3',
            'email'                 => 'writer3@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::WRITER,
            'profile_photo_path'    => 'profile-photos/author-three.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'Writer User 4',
            'email'                 => 'writer4@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::WRITER,
            'profile_photo_path'    => 'profile-photos/author-four.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'Writer User 5',
            'email'                 => 'writer5@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::WRITER,
            'profile_photo_path'    => 'profile-photos/author-one.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'Moderator User',
            'email'                 => 'moderator@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::MODERATOR,
            'profile_photo_path'    => 'profile-photos/author-three.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->create([
            'name'                  => 'John Doe',
            'email'                 => 'john@example.com',
            'password'              => bcrypt('password'),
            'type'                  => User::DEFAULT,
            'profile_photo_path'    => 'profile-photos/author-four.jpg'
        ])->profile()->save(Profile::factory()->make());

        User::factory()->count(10)->create()->each(function($user){
            $user->profile()->save(Profile::factory()->make());
        });
    }
}
