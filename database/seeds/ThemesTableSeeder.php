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
            if ( ! Theme::where('key', $data['key'])->exists()) {
                $theme = Theme::create([
                    'name' => $data['name'],
                    'key' => $data['key'],
                    'settings' => $data['settings'],
                    'is_pro' => $data['is_pro'],
                ]);

                $theme->addMediaFromUrl(url($data['thumbnail']))->toMediaCollection('thumbnail');
            }
        }
    }
}
