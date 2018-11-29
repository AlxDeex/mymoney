<?php

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
        DB::table('categories')->insert([
            ['name' => 'Машина'],
            ['name' => 'Связь'],
            ['name' => 'Лекарства'],
            ['name' => 'Одежда'],
            ['name' => 'Жилье'],
            ['name' => 'Подарки'],
            ['name' => 'Еда'],
            ['name' => 'Кафе'],
            ['name' => 'Гигиена'],
            ['name' => 'Питомцы'],
            ['name' => 'Спорт'],
            ['name' => 'Развлечения'],
            ['name' => 'Транспорт'],
            ['name' => 'Счета'],
            ['name' => 'Такси'],
        ]);
    }
}
