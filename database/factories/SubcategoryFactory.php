<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => \App\Models\Category::all()->random()->id,
            'subCategoryName' => $slug = $this->faker->unique()->name(),
            'subCategorySlug' => Str::slug($slug, '-'),
            'subCategoryImage' => $slug.'jpg',

        ];
    }
}
