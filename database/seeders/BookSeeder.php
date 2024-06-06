<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_handler = fopen("public/csv/bookDB.csv", "r");
        while($data = fgetcsv($file_handler)){
            if($data[5] == "") {
                $data[5] = null;
            }

            Book::create([
                'category_id' => ((int)$data[0] + 1),
                'name' => $data[1],
                'description' => $data[2],
                'author' => $data[3],
                'publisher' => $data[4],
                'image' => $data[5],
            ]);
        }
        fclose($file_handler);
    }
}
