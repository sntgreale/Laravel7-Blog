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

        // Create 3 categories
        for ($i = 1; $i <= 3; $i++)
        {
            DB::table('categories') -> insert(array(
                'category_name' => "Category " . $i,
                'category_created_at' => now(),
            ));
        }
    }
}
