<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing asset URL generation...\n\n";

$testPath = 'assets/uploads/media-uploader/gemini-generated-image-kdeoj4kdeoj4kdeo1765180935.png';

echo "APP_URL: " . config('app.url') . "\n";
echo "Asset URL: " . asset($testPath) . "\n";
echo "Public path: " . public_path($testPath) . "\n";
echo "File exists: " . (file_exists(public_path($testPath)) ? 'YES' : 'NO') . "\n\n";

// Test different URL formats
echo "Possible URLs:\n";
echo "1. " . asset($testPath) . "\n";
echo "2. " . url($testPath) . "\n";
echo "3. " . config('app.url') . '/' . $testPath . "\n";
echo "4. http://localhost/SyanTeck/@core/public/" . $testPath . "\n";

