<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminar conflictos padre-hijo al recrear la tabla, 
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //resetea el id de la tabla y borrar todos los registros
        DB::table('users')->truncate();
        User::create(['name' => 'Tin', 'email' => 'lordpsm@gmail.com', 'password' => Hash::make('Tin20tin')]);
    }
}
