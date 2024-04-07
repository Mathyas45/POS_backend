<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call([
            CategoriaSeeder::class,
            MarcaSeeder::class,
            ProductoSeeder::class,
            // Agrega aquí más seeders si es necesario
        ]);
    }
}
