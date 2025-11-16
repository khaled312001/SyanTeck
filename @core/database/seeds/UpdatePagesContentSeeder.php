<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Page;
use App\StaticOption;

class UpdatePagesContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update About Page
        $aboutPage = Page::where('slug', 'about')->first();
        if ($aboutPage) {
            $aboutPage->update([
                'title' => 'من نحن',
            ]);
        }

        // Update Contact Page
        $contactPage = Page::where('slug', 'contact')->first();
        if ($contactPage) {
            $contactPage->update([
                'title' => 'تواصل معنا',
            ]);
        }

        // Update Contact Page Settings
        $contactSettings = [
            'contact_page_contact_us_ar_title' => 'تواصل معنا',
            'contact_page_button_ar_text' => 'إرسال رسالة',
        ];

        foreach ($contactSettings as $key => $value) {
            $option = StaticOption::where('option_name', $key)->first();
            if ($option) {
                $option->update(['option_value' => $value]);
            } else {
                StaticOption::create([
                    'option_name' => $key,
                    'option_value' => $value,
                ]);
            }
        }

        $this->command->info('Pages content updated successfully!');
    }
}

