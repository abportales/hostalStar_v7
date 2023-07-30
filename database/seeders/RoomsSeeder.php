<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
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
        DB::table('rooms')->truncate();
        Room::create(['name' => '1A', 'floor' => '1', 'price' => 500]);
        Room::create(['name' => '1B', 'floor' => '1', 'price' => 500]);
        Room::create(['name' => '1C', 'floor' => '1', 'price' => 500]);
        Room::create(['name' => '1D', 'floor' => '1', 'price' => 500]);
        Room::create(['name' => '1E', 'floor' => '1', 'price' => 500]);
        Room::create(['name' => '1F', 'floor' => '1', 'price' => 500]);

        Room::create(['name' => '2A', 'floor' => '2', 'price' => 550]);
        Room::create(['name' => '2B', 'floor' => '2', 'price' => 550]);
        Room::create(['name' => '2C', 'floor' => '2', 'price' => 550]);
        Room::create(['name' => '2D', 'floor' => '2', 'price' => 550]);
        Room::create(['name' => '2E', 'floor' => '2', 'price' => 550]);
        Room::create(['name' => '2F', 'floor' => '2', 'price' => 550]);

        Room::create(['name' => '3A', 'floor' => '3', 'price' => 600]);
        Room::create(['name' => '3B', 'floor' => '3', 'price' => 600]);
        Room::create(['name' => '3C', 'floor' => '3', 'price' => 600]);
        Room::create(['name' => '3D', 'floor' => '3', 'price' => 600]);
    }
}
