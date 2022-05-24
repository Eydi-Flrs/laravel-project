<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         User::create(['firstname'=>'admin',
             'lastname'=>'admin', 'name'=> 'admin',
             'email'=>'tupkms2022@gmail.com',
             'contact_number'=>'09999999999',
             'password'=>'12345678',
             'email_verified_at'=>Carbon::now()
         ]);
         Role::create(['name'=>'Admin','slug'=>'admin']);
         DB::table('role_user')->insert(['user_id'=>1,'role_id'=>1]);
    }
}
