<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '管理者',
                'birth_date' => '2024/5/20',
                'zip_code' => '1111111',
                'address' => '東京都',
                'tel' => '1111111111',
                'email' => 'admins@root.com',
                'password' => Hash::make('rootroot'),
                'is_admin' => '1',
            ],
            [
                'name' => '田中太郎',
                'birth_date' => '1995/5/22',
                'zip_code' => '1140001',
                'address' => '東京都',
                'tel' => '9011111111',
                'email' => 'tanaka@aaa.com',
                'password' => Hash::make('tanaker'),
                'is_admin' => '0',
            ],
            [
                'name' => '鈴木一郎',
                'birth_date' => '2002/2/9',
                'zip_code' => '5341003',
                'address' => '大阪府',
                'tel' => '9011112222',
                'email' => 'suzuki@aaa.com',
                'password' => Hash::make('suzuki'),
                'is_admin' => '0',
            ],
            [
                "name" => "江口徹",
                "birth_date" => "1965-09-10",
                "zip_code" => "5522115",
                "address" => "大阪府富田林市寺池台3-3-7",
                "tel" => "05001017723",
                "email" => "eguchi910@example.org",
                "password" => Hash::make("TygiIcTxSP"),
                "is_admin" => '0'
            ],
            [
                "name" => "佐藤智也",
                "birth_date" => "2006-05-12",
                "zip_code" => "5322632",
                "address" => "大阪府大阪市生野区小路東3-2-6"
                , "tel" => "08028896796",
                "email" => "satotomoya@example.ne.jp",
                "password" => Hash::make("pLeIZuqeMn"),
                "is_admin" => false
            ],
            [
                "name" => "島岡俊雄",
                "birth_date" => "1957-10-01",
                "zip_code" => "7313827",
                "address" => "広島県三次市十日市中1-5-707",
                "tel" => "07063126772",
                "email" => "shimaoka_toshio@example.org",
                "password" => Hash::make("yEtAfElEee"),
                "is_admin" => false
            ],
            [
                "name" => "山田美保子",
                "birth_date" => "1943-08-08",
                "zip_code" => "2479700",
                "address" => "神奈川県座間市相模が丘3-2-4",
                "tel" => "08091940613",
                "email" => "mihokoyamada@example.net",
                "password" => Hash::make("VDVQsvAvVn"),
                "is_admin" => false
            ],
            [
                "name" => "細川加奈",
                "birth_date" => "1999-12-30",
                "zip_code" => "1351349",
                "address" => "東京都中央区日本橋本町1-1-10",
                "tel" => "08033305296",
                "email" => "kana_hosokawa@example.jp",
                "password" => Hash::make("nxZyiFLvkB"),
                "is_admin" => false
            ],
            [
                "name" => "岡田裕二",
                "birth_date" => "1998-04-23",
                "zip_code" => "1172010",
                "address" => "東京都大田区中央2-1-803",
                "tel" => "09074253039",
                "email" => "okadayuuji@example.org",
                "password" => Hash::make("tEYCVySpyf"),
                "is_admin" => false
            ],
            [
                "name" => "水口恵理",
                "birth_date" => "1990-06-26",
                "zip_code" => "1046486",
                "address" => "東京都渋谷区千駄ヶ谷3-1-409",
                "tel" => "08032419557",
                "email" => "mizuguchi_eri@example.co.jp",
                "password" => Hash::make("rUVWdHQTXh"),
                "is_admin" => false
            ],
            [
                "name" => "伊東洋介",
                "birth_date" => "2011-06-09",
                "zip_code" => "1023153",
                "address" => "東京都豊島区東池袋3-3-5",
                "tel" => "05001701925",
                "email" => "yousukeito@example.com",
                "password" => Hash::make("tZEzhYtcPg"),
                "is_admin" => false
            ],
            [
                "name" => "寺尾春樹",
                "birth_date" => "1989-05-20",
                "zip_code" => "1314005",
                "address" => "東京都武蔵村山市中央2-3-5",
                "tel" => "07078906425",
                "email" => "terao_haruki@example.com",
                "password" => Hash::make("gktDRMzlMH"),
                "is_admin" => false
            ],
            [
                "name" => "深見しのぶ",
                "birth_date" => "1969-01-14",
                "zip_code" => "8325546",
                "address" => "福岡県北九州市小倉北区下富野2-2-304",
                "tel" => "08016494946",
                "email" => "fukamishinobu@example.co.jp",
                "password" => Hash::make("iSaSEFjxZY"),
                "is_admin" => false
                ]
        ];
        foreach ($data as $customerData) {
            User::create($customerData);
        }
    }
}
