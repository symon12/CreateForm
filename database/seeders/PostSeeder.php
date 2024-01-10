<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Use DB facade to insert dummy records
        for ($i = 0; $i < 50; $i++) {
            $title = "Post Title " . ($i + 1);
            $description = "Description for Post " . ($i + 1);
            $category = "Category " . ($i % 5 + 1);
            $tags = json_encode(['tag' . ($i % 3 + 1), 'tag' . ($i % 4 + 1)]);
            $status = ($i % 2 == 0) ? 'active' : 'inactive';
            $featured_image = 'image_' . ($i + 1) . '.jpg';

            Post::create([
                'title' => $title,
                'description' => $description,
                'category' => $category,
                'tags' => $tags,
                'status' => $status,
                'featured_image' => $featured_image,
            ]);
        }
    }
}


