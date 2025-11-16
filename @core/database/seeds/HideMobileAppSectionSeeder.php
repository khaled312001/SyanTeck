<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;

class HideMobileAppSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Hiding Mobile App Section ===');
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
            $this->command->warn('Cannot find homepage ID. Skipping...');
            return;
        }

        // Find all BannerOne addons for homepage
        $bannerAddons = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->where('addon_name', 'BannerOne')
            ->orWhere('addon_namespace', 'like', '%Banner\\BannerOne%')
            ->get();

        $this->command->info("Found {$bannerAddons->count()} BannerOne addons.");

        $updated = 0;
        foreach ($bannerAddons as $addon) {
            try {
                $settings = @unserialize($addon->addon_settings);
                
                if ($settings && is_array($settings)) {
                    // Set section_show_hide to empty to hide the section
                    $settings['section_show_hide'] = '';
                    $addon->addon_settings = serialize($settings);
                    $addon->save();
                    $updated++;
                    $this->command->info("  ✓ Hidden: BannerOne (ID: {$addon->id})");
                }
            } catch (\Exception $e) {
                $this->command->warn("  ✗ Error updating addon ID {$addon->id}: " . $e->getMessage());
            }
        }

        $this->command->info("");
        $this->command->info("✓ Hidden {$updated} Mobile App sections.");
        $this->command->info("");
        $this->command->info("Note: You can show/hide this section from /admin/page-builder/home-page");
        $this->command->info("Look for 'Banner: 01' addon and toggle 'Show/Hide Section' option.");
    }
}

