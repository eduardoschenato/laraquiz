<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Português'],
            ['name' => 'Matemática'],
            ['name' => 'História'],
            ['name' => 'Geografia'],
            ['name' => 'Biologia'],
            ['name' => 'Física'],
            ['name' => 'Química']
        ]);
    }
}
