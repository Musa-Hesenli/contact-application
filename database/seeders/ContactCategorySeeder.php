<?php

namespace Database\Seeders;

use App\Models\ContactCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Business',
            'Family',
            'Work',
            'Friends',
            'Acquaintances',
            'Social',
            'Educational',
            'Medical',
            'Legal',
            'Community'
        ];

        array_map( function ( $category ) {
            $contact_category = new ContactCategory();
            $contact_category->name  = $category;
            $contact_category->color = fake()->hexColor();
            $contact_category->save();
        }, $categories );

    }
}
