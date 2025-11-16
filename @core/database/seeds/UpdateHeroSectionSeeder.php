<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;

class UpdateHeroSectionSeeder extends Seeder
{
    /**
     * Content replacements for Hero Section
     */
    private $replacements = [
        'Order service you need. We have professionals ready to help.' => 'اطلب الخدمة التي تحتاجها. لدينا فنيون معتمدون جاهزون لخدمتك',
        'Order service you need, We have professionals ready to help' => 'اطلب الخدمة التي تحتاجها. لدينا فنيون معتمدون جاهزون لخدمتك',
        'Order service you need' => 'اطلب الخدمة التي تحتاجها',
        'We have professionals ready to help' => 'لدينا فنيون معتمدون جاهزون لخدمتك',
        '2k+ Satisficed Customer' => 'أكثر من 2000 عميل راضٍ',
        '2k+ Satisfied Customer' => 'أكثر من 2000 عميل راضٍ',
        '3k+ Satisfied Customer' => 'أكثر من 3000 عميل راضٍ',
        'Satisfied Customer' => 'عميل راضٍ',
        '5 Star Reviews' => 'تقييمات 5 نجوم',
        'Star Reviews' => 'تقييمات نجوم',
        '0+' => '',
        'no-image' => '',
        'noImage' => '',
        'Set Location' => 'تحديد الموقع',
    ];

    /**
     * Deep search and replace in array
     */
    private function deepReplace($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $originalValue = $value;
                    foreach ($this->replacements as $old => $new) {
                        if (stripos($value, $old) !== false) {
                            $value = str_ireplace($old, $new, $value);
                        }
                    }
                    if ($value !== $originalValue) {
                        $data[$key] = $value;
                    }
                } elseif (is_array($value)) {
                    $data[$key] = $this->deepReplace($value);
                }
            }
        } elseif (is_string($data)) {
            foreach ($this->replacements as $old => $new) {
                if (stripos($data, $old) !== false) {
                    $data = str_ireplace($old, $new, $data);
                }
            }
        }
        
        return $data;
    }

    public function run()
    {
        $this->command->info('=== Updating Hero Section Content ===');
        $this->command->info('');

        $homePageId = get_static_option('home_page');
        if (!$homePageId) {
            $homePage = Page::where('slug', 'home')
                ->orWhere('slug', 'homepage')
                ->orWhere('slug', 'index')
                ->first();
            $homePageId = $homePage ? $homePage->id : null;
        }

        if (!$homePageId) {
            $this->command->warn('Homepage ID not found.');
            return;
        }

        // Find HeaderStyleOne addons
        $pageBuilders = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->where(function($query) {
                $query->where('addon_name', 'HeaderStyleOne')
                      ->orWhere('addon_namespace', 'like', '%Header\\HeaderStyleOne%');
            })
            ->get();

        $this->command->info("Found {$pageBuilders->count()} HeaderStyleOne addons.");

        $updated = 0;
        foreach ($pageBuilders as $pb) {
            try {
                $settings = @unserialize($pb->addon_settings);
                if ($settings && is_array($settings)) {
                    $original = serialize($settings);
                    $settings = $this->deepReplace($settings);
                    $new = serialize($settings);
                    
                    if ($new !== $original) {
                        $pb->addon_settings = $new;
                        $pb->save();
                        $updated++;
                        $this->command->info("  ✓ Updated: HeaderStyleOne (ID: {$pb->id})");
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn("  ✗ Error updating addon ID {$pb->id}: " . $e->getMessage());
            }
        }
        
        $this->command->info("");
        $this->command->info("✓ Updated {$updated} Hero sections.");
        $this->command->info("");
    }
}

