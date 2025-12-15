<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;

class UpdatePopularServicesTitle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Updating Popular Services title...');

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
            $this->command->error('Homepage not found!');
            return;
        }

        // Get all PopularService addons
        $pageBuilders = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->whereIn('addon_name', ['PopularServiceThree', 'PopularService', 'PopularServiceTwo'])
            ->get();

        $this->command->info("Found {$pageBuilders->count()} PopularService addons.");

        $updated = 0;
        foreach ($pageBuilders as $pageBuilder) {
            try {
                $settings = @unserialize($pageBuilder->addon_settings);
                
                if ($settings && is_array($settings)) {
                    $oldTitle = $settings['title'] ?? '';
                    
                    // Update title if it contains old text
                    if (isset($settings['title'])) {
                        $title = $settings['title'];
                        $needsUpdate = false;
                        
                        // Check various old title formats
                        if (stripos($title, 'Popular Services') !== false || 
                            stripos($title, 'Popular Service') !== false ||
                            stripos($title, 'الخدمات الأكثر') !== false ||
                            stripos($title, 'الخدمات المتاحة') !== false ||
                            $title === 'Popular Services' ||
                            $title === 'Popular Service') {
                            $settings['title'] = 'الخدمات الأكثر طلباً';
                            $needsUpdate = true;
                            $this->command->info("  → Updating title: '{$oldTitle}' → 'الخدمات الأكثر طلباً'");
                        }
                        
                        if ($needsUpdate) {
                            $pageBuilder->addon_settings = serialize($settings);
                            $pageBuilder->save();
                            $updated++;
                            $this->command->info("  ✓ Updated: {$pageBuilder->addon_name}");
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn("  ✗ Error updating {$pageBuilder->addon_name}: " . $e->getMessage());
            }
        }

        $this->command->info("✓ Updated {$updated} addons.");
    }
}

