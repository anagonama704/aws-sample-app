<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "総記"],
            ["name" => "哲学"],
            ["name" => "歴史"],
            ["name" => "社会科学"],
            ["name" => "自然科学"],
            ["name" => "技術・工学"],
            ["name" => "産業"],
            ["name" => "芸術・美術"],
            ["name" => "言語"],
            ["name" => "文学"]
        ];
        DB::table('categories')->insert($data);
    }
}
