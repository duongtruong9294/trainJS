<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'cate_name' => 'iphone',
                'cate_slug' => str_slug('iphone')
            ],
            [
                'cate_name' => 'Samsung',
                'cate_slug' => str_slug('Samsung')
            ]
        ];
        DB::table('categories')->insert($data);
    }
}
