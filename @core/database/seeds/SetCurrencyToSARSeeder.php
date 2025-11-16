<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\StaticOption;

class SetCurrencyToSARSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Setting Currency to SAR (Saudi Riyal) ===');
        $this->command->info('');

        // Update global currency to SAR
        $currencyOption = StaticOption::where('option_name', 'site_global_currency')->first();
        
        if ($currencyOption) {
            $currencyOption->option_value = 'SAR';
            $currencyOption->save();
            $this->command->info('✓ Updated site_global_currency to SAR');
        } else {
            StaticOption::create([
                'option_name' => 'site_global_currency',
                'option_value' => 'SAR',
            ]);
            $this->command->info('✓ Created site_global_currency option with SAR');
        }

        // Set currency symbol position to right (for Arabic)
        $positionOption = StaticOption::where('option_name', 'site_currency_symbol_position')->first();
        if ($positionOption) {
            $positionOption->option_value = 'right';
            $positionOption->save();
            $this->command->info('✓ Updated currency symbol position to right');
        } else {
            StaticOption::create([
                'option_name' => 'site_currency_symbol_position',
                'option_value' => 'right',
            ]);
            $this->command->info('✓ Created currency symbol position option');
        }

        // Disable decimal point for cleaner display
        $decimalOption = StaticOption::where('option_name', 'enable_disable_decimal_point')->first();
        if ($decimalOption) {
            $decimalOption->option_value = 'no';
            $decimalOption->save();
            $this->command->info('✓ Disabled decimal point');
        } else {
            StaticOption::create([
                'option_name' => 'enable_disable_decimal_point',
                'option_value' => 'no',
            ]);
            $this->command->info('✓ Created decimal point option');
        }

        $this->command->info('');
        $this->command->info('✓ Currency successfully set to SAR (Saudi Riyal)');
        $this->command->info('  Symbol: SR');
        $this->command->info('  Position: Right (for Arabic)');
        $this->command->info('');
    }
}

