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
            UnidadSeeder::class,
            ProductoSeeder::class,
            EmpresaSeeder::class,
            MonedaSeeder::class,
            SucursalSeeder::class,
            ProveedorSeeder::class,
            CompraSeeder::class,
            // Agrega aquí más seeders si es necesario
        ]);
    }
}
