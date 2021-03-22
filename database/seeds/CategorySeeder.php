<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create 5 categories

        DB::table('categories') -> insert(array(
            'category_name' => "Not specified ",
            'category_created_at' => now(),
        ));

        for ($i = 1; $i <= 4; $i++)
        {
            DB::table('categories') -> insert(array(
                'category_name' => "Category " . $i,
                'category_created_at' => now(),
            ));
        }
    }
}
