<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;

class AddMainDepartmentsSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Adding Main Departments Section ===');
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
            $this->command->warn('Homepage ID not found. Skipping...');
            return;
        }

        $this->addMainDepartmentsToHomepage($homePageId);

        $this->command->info('');
        $this->command->info('✓ Main Departments section added successfully!');
        $this->command->info('');
    }

    /**
     * Add Main Departments section to homepage after PopularServiceThree
     */
    private function addMainDepartmentsToHomepage($homePageId)
    {
        // Check if MainDepartments addon already exists
        $existing = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->where('addon_name', 'MainDepartments')
            ->orWhere('addon_namespace', 'like', '%MainDepartments\\MainDepartments%')
            ->first();

        if ($existing) {
            $this->command->info("  ℹ MainDepartments section already exists on homepage (ID: {$existing->id})");
            return;
        }

        // Find PopularServiceThree order
        $popularServiceOrder = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->where('addon_name', 'PopularServiceThree')
            ->orWhere('addon_namespace', 'like', '%PopularService\\PopularServiceThree%')
            ->max('addon_order');

        // If PopularServiceThree not found, get max order
        if (!$popularServiceOrder) {
            $popularServiceOrder = PageBuilder::where(function($query) use ($homePageId) {
                    $query->where('addon_page_id', $homePageId)
                          ->orWhere('addon_page_type', 'homepage')
                          ->orWhere('addon_page_type', 'dynamic_page');
                })
                ->max('addon_order') ?? 0;
        }

        // Set order to be after PopularServiceThree
        $newOrder = $popularServiceOrder + 1;

        // Update all addons with order >= newOrder to make room
        PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->where('addon_order', '>=', $newOrder)
            ->increment('addon_order');

        $settings = [
            'title' => 'الأقسام الرئيسية في صيانة تك',
            'subtitle' => 'نقدم لكم مجموعة شاملة من الأقسام المتخصصة لتلبية جميع احتياجاتكم في مجال الصيانة والبناء',
            'padding_top' => 100,
            'padding_bottom' => 100,
            'section_bg' => '#FFFFFF',
        ];

        PageBuilder::create([
            'addon_name' => 'MainDepartments',
            'addon_type' => 'new',
            'addon_namespace' => 'App\PageBuilder\Addons\MainDepartments\MainDepartments',
            'addon_location' => 'dynamic_page',
            'addon_order' => $newOrder,
            'addon_page_id' => $homePageId,
            'addon_page_type' => 'dynamic_page',
            'addon_settings' => serialize($settings),
        ]);

        $this->command->info("  ✓ Added MainDepartments section to homepage (Page ID: {$homePageId}, Order: {$newOrder})");
    }
}

