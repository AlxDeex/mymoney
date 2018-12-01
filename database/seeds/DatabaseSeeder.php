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
            ['name' => 'Машина', 'type' => 1],
            ['name' => 'Связь','type' => 1],
            ['name' => 'Лекарства','type' => 1],
            ['name' => 'Одежда','type' => 1],
            ['name' => 'Жилье','type' => 1],
            ['name' => 'Подарки','type' => 1],
            ['name' => 'Еда','type' => 1],
            ['name' => 'Кафе','type' => 1],
            ['name' => 'Гигиена','type' => 1],
            ['name' => 'Питомцы','type' => 1],
            ['name' => 'Спорт','type' => 1],
            ['name' => 'Развлечения','type' => 1],
            ['name' => 'Транспорт','type' => 1],
            ['name' => 'Счета','type' => 1],
            ['name' => 'Такси','type' => 1],

            ['name' => 'Зарплата','type' => 2],
            ['name' => 'Сбережения','type' => 2],
            ['name' => 'Инвестиции','type' => 2],
        ]);
    }
}
