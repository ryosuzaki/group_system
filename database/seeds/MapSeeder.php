<?php

use Illuminate\Database\Seeder;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use App\User;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $shelter_list=[
            ["横浜市立戸塚中学校",139.52373,35.40177],
            ["横浜市立深谷小学校",139.502893,35.391593],
            ["横浜市立深谷中学校",139.499532,35.383469],
            ["横浜市立豊田中学校",139.542318,35.382179],
            ["横浜市立大正中学校",139.503179,35.378315],
            ["横浜市立東俣野小学校",139.496302,35.367938],
            ["横浜市立小雀小学校",139.511651,35.37699],
            ["横浜市立大正小学校",139.503301,35.379567],
            ["横浜市立南戸塚中学校",139.518261,35.381145],
            ["横浜市立下郷小学校",139.52363,35.386456],
            ["横浜市立横浜深谷台小学校",139.496471,35.388097],
            ["横浜市立戸塚小学校",139.532463,35.397321],
            ["横浜市立南戸塚小学校",139.525683,35.388119],
            ["横浜市立南舞岡小学校",139.554647,35.388816],
            ["横浜市立倉田小学校",139.540882,35.389511],
            ["横浜市立汲沢中学校",139.507476,35.398465],
            ["横浜市立汲沢小学校",139.514159,35.397634],
            ["横浜市立東汲沢小学校",139.521314,35.399498],
            ["横浜市立東戸塚小学校",139.538084,35.401717],
            ["横浜市立舞岡小学校",139.550945,35.407069],
            ["横浜市立矢部小学校",139.523388,35.4073],
            ["横浜市立舞岡中学校",139.544887,35.408886],
            ["横浜市立鳥が丘小学校",139.522297,35.411183],
            ["横浜市立柏尾小学校",139.551819,35.414946],
            ["横浜市立秋葉小学校",139.544101,35.420782],
            ["横浜市立平戸台小学校",139.567937,35.422981],
            ["横浜市立上矢部小学校",139.528352,35.423548],
            ["横浜市立川上小学校",139.545212,35.426609],
            ["横浜市立平戸小学校",139.563741,35.426789],
            ["横浜市立川上北小学校",139.554136,35.429072],
            ["横浜市立名瀬小学校",139.541248,35.431069],
            ["横浜市立名瀬中学校",139.543634,35.433955],
            ["横浜市立東品濃小学校",139.560724,35.434174],
            ["横浜市立品濃小学校",139.557355,35.426156],
            ["横浜市立境木中学校",139.569429,35.436991],
        ];
        //
        $user=User::findByEmail('cars1201023@gn.iwasaki.ac.jp');
        //
        foreach($shelter_list as $shelter){
            $tmp=Group::setUp($user->id,$shelter[0],GroupType::findByName('shelter'),"aaaa");
            $tmp->setLocation($shelter[2],$shelter[1]);
        }
    }
}
