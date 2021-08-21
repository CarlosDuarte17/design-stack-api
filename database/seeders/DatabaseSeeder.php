<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(10)->create();
        $users = User::all();
        $users->each(function ($user, $key){
            Log::info("email:".$user->email." token".$key." ".$user->createToken('auth_token')->plainTextToken);
        });
    }
}
