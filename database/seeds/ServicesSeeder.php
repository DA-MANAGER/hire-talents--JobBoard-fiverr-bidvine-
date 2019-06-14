<?php

use App\Media;
use App\Service;
use Illuminate\Database\Seeder;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'name' => 'Cellphone',
            ],
            [
                'name' => 'Computer Graphic',
            ],
            [
                'name' => 'Consulting',
            ],
            [
                'name' => 'Conversation',
            ],
            [
                'name' => 'Digital Marketing',
            ],
            [
                'name' => 'Software',
            ],
            [
                'name' => 'Web Design',
            ],
            [
                'name' => 'Write Letter',
            ],
        ];

        Service::insert($list);

        $services = Service::all();

        $services->each(function ($service) {
            $file_name = str_slug($service->name);
            $path      = resource_path('images/services/' . $file_name . '.png');

            Media::store($path, $service);

            $question = $service->questions()->create([
                'question' => 'Do you like the service?',
            ]);
    
            $question->options()->create([
                'name' => 'Option 1',
            ]);
    
            $question->options()->create([
                'name' => 'Option 2',
            ]);
        });
    }
}
