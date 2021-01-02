<?php

use Illuminate\Database\Seeder;
use App\Home;
use App\About;
use App\Contact;

class WebpageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Home::create([
            'home_welcome_text' => 'Welcome to CHICKDOG CHICKDOG',
            'home_background_image' => 'banner.jpg',
            'home_google_map_embed' => 'https://www.google.com/maps/embed/v1/place?key=AIzaSyAlnf6iTIs_i_Ua04uLY7xBZOLDQtIlNc0&q=18.7481487366,98.9570212281&zoom=15',
        ]);

        About::create([
            'about_title' => 'Chickdog',
            'about_subtitle' => 'จำหน่ายปอมเมอเรเนียนแท้',
            'about_content' => 'จำหน่ายปอมเมอเรเนียนแท้ สายพันธ์ุดี แข็งแรงพร้อมรับประกันสุขภาพน้องหมา ยินดีให้คำปรึกษาตลอดการเลี้ยงดู มีบริการส่งฟรีทั่วประเทศ ยินดีรับบัตรเครดิต',
            'about_image' => 'about.jpg',
        ]);
        
        About::create([
            'about_title' => 'Chickdog',
            'about_subtitle' => 'Selling authentic Pomeranian',
            'about_content' => 'Selling authentic Pomeranian, Strong and healthy dog guarantee, Happy to give advice throughout parenting, Free delivery is available throughout the country, Accept credit cards',
            'about_image' => 'about.jpg',
        ]);

        Contact::create([
            'contact_name' => 'CHICK DOG Farm',
            'contact_address' => 'Karnkanok 21 Muang Chiang Mai, Chiang Mai, Thailand',
            'contact_tel_no' => '0910720197',
            'contact_google_map_link' => 'https://goo.gl/maps/4NaJG4H9QkxSaLci9',
            'contact_facebook' => 'CHICK DOG Farm',
            'contact_facebook_link' => 'https://www.facebook.com/chickDogCM/?__tn__=%2CdK-R-R&eid=ARBUSuU_47bxO1mswycSh0jlM2sL_U_eWH_UxZjuRJLFGA3dcC8uhQzXPBoSHJ3KT02ki9Ox6vtQYClK&fref=mentions',
            'contact_line_qr' => 'qr.png',
            'contact_logo' => 'logo.png',
        ]);
    }
}