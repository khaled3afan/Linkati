<?php

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = resource_path('seeders/themes.json');
        $themes = json_decode(file_get_contents($path), true);

        foreach ($themes as $data) {
            $theme = Theme::create([
                'name' => $data['name'],
                'key' => $data['key'],
                'settings' => $data['settings'],
                'is_pro' => $data['is_pro'],
            ]);

//            resource_path("assets{$data['thumbnail']}")
            $theme->addMediaFromUrl(url($data['thumbnail']))->toMediaCollection('thumbnail');
        }
    }
}
