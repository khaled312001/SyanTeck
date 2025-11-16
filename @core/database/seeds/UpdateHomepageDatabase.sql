-- SQL Script to Update Homepage Content in Database
-- Based on SyanTeck Platform Summary
-- Run this script to update homepage content directly in the database

-- Step 1: Update Homepage Page Title
UPDATE pages 
SET title = 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية'
WHERE id = (SELECT option_value FROM static_options WHERE option_name = 'home_page' LIMIT 1)
   OR slug IN ('home', 'homepage', 'index');

-- Step 2: Update Static Options for Site Title and Description
INSERT INTO static_options (option_name, option_value, created_at, updated_at)
VALUES 
    ('site_ar_title', 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية', NOW(), NOW()),
    ('site_ar_tag_line', 'منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية', NOW(), NOW()),
    ('site_meta_ar_description', 'صيانة تك - منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. ربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.', NOW(), NOW())
ON DUPLICATE KEY UPDATE 
    option_value = VALUES(option_value),
    updated_at = NOW();

-- Note: Page Builder content (page_builders table) should be updated through the seeder
-- as it contains serialized PHP arrays that need proper handling

-- Step 3: Update About Page if exists
UPDATE pages 
SET title = 'من نحن'
WHERE slug = 'about';

-- Step 4: Update Contact Page if exists
UPDATE pages 
SET title = 'تواصل معنا'
WHERE slug = 'contact';

-- Verification Queries (optional - run to check results)
-- SELECT * FROM pages WHERE id = (SELECT option_value FROM static_options WHERE option_name = 'home_page' LIMIT 1);
-- SELECT * FROM static_options WHERE option_name IN ('site_ar_title', 'site_ar_tag_line', 'site_meta_ar_description');

