<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = fake()->sentence(6, true);
        return [
            'title'         => $title,
            'slug'          => News::generateSlug($title),
            'category'      => fake()->randomElement(['umum', 'teknis', 'kegiatan', 'kepegawaian']),
            'excerpt'       => fake()->paragraph(3, true),
            'content'       => fake()->optional(0.5)->paragraphs(4, true),
            'image'         => null,
            'author'        => fake()->randomElement(['Humas PLN NP', 'Dept. Teknik', 'Bagian CSR', 'Dept. K3', 'Dept. SDM']),
            'is_published'  => fake()->boolean(70),
            'published_at'  => fake()->optional(0.8)->dateTimeBetween('-2 weeks', 'now'),
            'author_user_id' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    public function category(string $category): static
    {
        return $this->state(fn (array $attributes) => ['category' => $category]);
    }
}
