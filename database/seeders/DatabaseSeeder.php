<?php

namespace Database\Seeders;

use App\Models\NewsArticle;
use App\Models\Partner;
use App\Models\Tree;
use App\Models\User;
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
        User::factory(15)->create();
        Tree::factory(15)->create();
        NewsArticle::factory(20)->create();
    }
}
