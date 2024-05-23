<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodenamesTableSeeder extends Seeder
{
    public function run()
    {
        $codenames = [
            'Rode Appel', 'Blauwe Banaan', 'Groene Kers', 'Gele Dadel', 'Paarse Vijg',
            'Oranje Druif', 'Indigo Braambes', 'Limoen Kiwi', 'Kastanje Citroen', 'Marine Mango',
            'Olijf Nectarine', 'Roze Sinaasappel', 'Kwarts Peer', 'Robijn Aardbei', 'Zilveren Mandarijn',
            'Turkoois Ugli', 'Violette Watermeloen', 'Witte Xigua', 'Gele Yam', 'Zink Courgette',
            'Amber Abrikoos', 'Bronzen Bes', 'Koraal Kokosnoot', 'Diamant Durian', 'Smaragd Vlierbes',
            'Fuchsia Guave', 'Gouden Honingmeloen', 'Ivoor Jackfruit', 'Jade Kumquat', 'Khaki Lychee',
            'Lavendel Moerbei', 'Magenta Nance', 'Neon Olijf', 'Okkernoot Perzik', 'Tin Kweepeer',
            'Framboos Rambutan', 'Saffier Stervrucht', 'Taupe Tomaat', 'Ultramarijn Uva', 'Vanille Wikke'
        ];

        foreach ($codenames as $codename) {
            DB::table('codenames')->insert([
                'codename' => $codename,
                'is_assigned' => false
            ]);
        }
    }
}
