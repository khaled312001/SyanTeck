<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;

class AddVision2030SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Adding Vision 2030 Section ===');
        $this->command->info('');

        // Get homepage ID
        $homePageId = get_static_option('home_page');
        if (!$homePageId) {
            $homePage = Page::where('slug', 'home')
                ->orWhere('slug', 'homepage')
                ->orWhere('slug', 'index')
                ->first();
            $homePageId = $homePage ? $homePage->id : null;
        }

        if (!$homePageId) {
            $this->command->warn('Homepage ID not found. Skipping homepage...');
        } else {
            $this->addVision2030ToHomepage($homePageId);
        }

        // Get about page ID
        $aboutPage = Page::where('slug', 'about')
            ->orWhere('slug', 'about-us')
            ->orWhere('slug', 'من-نحن')
            ->first();

        if (!$aboutPage) {
            $this->command->warn('About page not found. Skipping about page...');
        } else {
            $this->addVision2030ToAboutPage($aboutPage->id);
        }

        $this->command->info('');
        $this->command->info('✓ Vision 2030 section added successfully!');
        $this->command->info('');
    }

    /**
     * Add Vision 2030 section to homepage
     */
    private function addVision2030ToHomepage($homePageId)
    {
        // Check if Vision2030 addon already exists
        $existing = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage');
            })
            ->where('addon_name', 'Vision2030')
            ->orWhere('addon_namespace', 'like', '%Vision2030\\Vision2030%')
            ->first();

        if ($existing) {
            $this->command->info("  ℹ Vision2030 section already exists on homepage (ID: {$existing->id})");
            return;
        }

        // Get max order for homepage
        $maxOrder = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage');
            })
            ->max('addon_order') ?? 0;

        $settings = [
            'title' => 'دعم التحول الرقمي ضمن رؤية المملكة 2030',
            'subtitle' => 'نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم',
            'padding_top' => 80,
            'padding_bottom' => 80,
            'section_bg' => '#006633',
        ];

        PageBuilder::create([
            'addon_name' => 'Vision2030',
            'addon_type' => 'new',
            'addon_namespace' => 'App\PageBuilder\Addons\Vision2030\Vision2030',
            'addon_location' => 'dynamic_page',
            'addon_order' => $maxOrder + 1,
            'addon_page_id' => $homePageId,
            'addon_page_type' => 'dynamic_page',
            'addon_settings' => serialize($settings),
        ]);

        $this->command->info("  ✓ Added Vision2030 section to homepage (Page ID: {$homePageId})");
    }

    /**
     * Add Vision 2030 section to about page
     */
    private function addVision2030ToAboutPage($aboutPageId)
    {
        // Check if Vision2030 addon already exists
        $existing = PageBuilder::where('addon_page_id', $aboutPageId)
            ->where('addon_name', 'Vision2030')
            ->orWhere('addon_namespace', 'like', '%Vision2030\\Vision2030%')
            ->first();

        if ($existing) {
            $this->command->info("  ℹ Vision2030 section already exists on about page (ID: {$existing->id})");
            return;
        }

        // Get max order for about page
        $maxOrder = PageBuilder::where('addon_page_id', $aboutPageId)
            ->max('addon_order') ?? 0;

        $settings = [
            'title' => 'دعم التحول الرقمي ضمن رؤية المملكة 2030',
            'subtitle' => 'نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم',
            'padding_top' => 80,
            'padding_bottom' => 80,
            'section_bg' => '#006633',
        ];

        PageBuilder::create([
            'addon_name' => 'Vision2030',
            'addon_type' => 'new',
            'addon_namespace' => 'App\PageBuilder\Addons\Vision2030\Vision2030',
            'addon_location' => 'dynamic_page',
            'addon_order' => $maxOrder + 1,
            'addon_page_id' => $aboutPageId,
            'addon_page_type' => 'dynamic_page',
            'addon_settings' => serialize($settings),
        ]);

        $this->command->info("  ✓ Added Vision2030 section to about page (Page ID: {$aboutPageId})");
    }
}

