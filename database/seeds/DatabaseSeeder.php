<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $files = File::allFiles(resource_path('seeders'));
//        foreach ($files as $table) {
//            $tableName = explode('.', $table->getFilename())[0];
//            if (Schema::hasTable($tableName)) {
//                DB::table($tableName)->truncate();
//                $tableContent = json_decode(file_get_contents($table->getPathname()), 1);
//                foreach ($tableContent as $model) {
//                    DB::table($tableName)->insert($model);
//                }
//            }
//        }

        $this->call(ThemesTableSeeder::class);
    }
}
