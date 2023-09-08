<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $places = [
            ['id' => 'ChIJS4Ps0Di8BUcRNU3fpUdm2lE', 'name' => 'Błotkowo'],
            ['id' => 'ChIJZ0sX_SWjBUcR2_s96ufNp7A', 'name' => 'Goniembice'],
            ['id' => 'ChIJCQAcfZ-8BUcRpDlMkyzUDbo', 'name' => 'Górka Duchowna'],
            ['id' => 'ChIJedfLPQOYBUcRg2CNyMWHgOI', 'name' => 'Gronówko'],
            ['id' => 'ChIJdbnyW7P44kYR652SPuDdVJg', 'name' => 'Karolewko'],
            ['id' => 'ChIJ0YFJ3y69BUcRoRGmfPRX6hE', 'name' => 'Klonówiec'],
            ['id' => 'ChIJ31TbgTajBUcRXbw0upnbulo', 'name' => 'Koronowo'],
            ['id' => 'ChIJn8G-yeG8BUcRMgD_Oh1h3Bc', 'name' => 'Lipno'],
            ['id' => 'ChIJM46dHeaXBUcRpZGEHefvd7k', 'name' => 'Maryszewice'],
            ['id' => 'ChIJTbFkxKe9BUcRBF0g68IKL0g', 'name' => 'Mórkowo'],
            ['id' => 'ChIJd2uP6Wy8BUcR7YR2tiJxES0', 'name' => 'Radomicko'],
            ['id' => 'ChIJfc6PA6y8BUcRlK08BntfFXU', 'name' => 'Ratowice'],
            ['id' => 'ChIJL1Zj61q8BUcRgTeXcT070kY', 'name' => 'Smyczyna'],
            ['id' => 'ChIJXd6gnq6kBUcRqBWqz6GP_fA', 'name' => 'Sulejewo'],
            ['id' => 'ChIJO8Ka_oe8BUcRICg1jgnAm2g', 'name' => 'Targowisko'],
            ['id' => 'ChIJJ5TUKdyiBUcRa3ue-uthdkk', 'name' => 'Wyciążkowo'],
            ['id' => 'ChIJ3wYGIsm8BUcRv9Kj0zG0L0Q', 'name' => 'Żakowo'],

            ['id' => 'ChIJv0Zg7Gu9BUcRmVkTAVi7LdU', 'name' => 'Wilkowice'],

            ['id' => 'ChIJCYUwKteNBUcRl1-ijzw41Xc', 'name' => 'Klimontów'],
            ['id' => 'ChIJU5aAHF6OBUcR0LkkHkp9thg', 'name' => 'Niechlów'],
            ['id' => 'ChIJhcJvWAePBUcRFaG-4k65kqs', 'name' => 'Żuchlów'],

            ['id' => 'ChIJjbxRgXePBUcRq5eGC9WsLLk', 'name' => 'Wroniniec'],

            ['id' => 'ChIJVeDDlvqPBUcRf4Us4LrVDM4', 'name' => 'Bogucin'],
            ['id' => 'ChIJcSxleNSPBUcRNDY0yXv1bcw', 'name' => 'Łękanów'],
            ['id' => 'ChIJwT7MML-PBUcRqCWpzxAZZvM', 'name' => 'Naratów'],
            ['id' => 'ChIJTw84_CyQBUcREFZtt1_l26Y', 'name' => 'Siciny'],
            ['id' => 'ChIJEWuZuxCQBUcRBKD1JtxLI_0', 'name' => 'Tarpno'],
            ['id' => 'ChIJFajOIkOQBUcRS3yt7y6F6Ac', 'name' => 'Wioska'],
            ['id' => 'ChIJqwD48lOQBUcRRCPTNpgRe9c', 'name' => 'Wronów'],
        ];

        Place::insert($places);
    }
}
