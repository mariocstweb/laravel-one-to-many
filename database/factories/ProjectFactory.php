<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_image');
        $title = fake()->text(20);
        $slug = Str::slug($title);
        $img = fake()->image(null, 200, 200);
        $img_url = Storage::putFileAs('project_image', $img, "$slug.png");

        $type_ids = Type::pluck('id')->toArray();
        $type_ids[] = null;

        return [
            'title' => $title,
            'slug' => $slug,
            'type_id' => Arr::random($type_ids),
            'content' => fake()->paragraph(15, true),
            'image' => $img_url,
            'programming_language' => fake()->randomElement(['HTML', 'CSS', 'JS', 'PHP']),
        ];
    }
}
