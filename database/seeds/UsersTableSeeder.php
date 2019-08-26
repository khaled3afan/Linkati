<?php

use App\Models\Link;
use App\Models\Theme;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'حسام عبد',
            'email' => 'hussam3bd@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
            'settings' => [
                'email' => [
                    'newsletter' => true
                ]
            ]
        ]);

        $profile = $user->profiles()->save(new Profile([
            'theme_id' => Theme::first()->id,
            'name' => $user->name,
            'username' => 'Hussam3bd',
        ]));

        # Add links to the profile.
        $path = resource_path('seeders/links.json');
        $themes = json_decode(file_get_contents($path), true);

        foreach ($themes as $data) {
            $profile->links()->save(new Link([
                'user_id' => $profile->user_id,
                'name' => $data['name'],
                'url' => $data['url'],
                'order' => $data['order'],
                'type' => $data['type'],
            ]));
        }
    }
}
