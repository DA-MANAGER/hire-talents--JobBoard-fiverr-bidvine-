<?php

use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'key' => 'business_localization',
                'value' => json_encode([
                    'I travel to my customers.',
                    'My customers travel to me.',
                    'I conduct all my business remotely over the phone or internet.'
                ])
            ]
        ];

        \App\Option::insert($options);
    }
}
