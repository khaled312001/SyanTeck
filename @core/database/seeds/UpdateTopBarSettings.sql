-- SQL Script to Update Top Bar Settings
-- تحديث إعدادات الشريط العلوي

-- 1. تحديث البريد الإلكتروني
UPDATE static_options 
SET option_value = 'info@syanatech.com', updated_at = NOW()
WHERE option_name = 'site_global_email';

-- إذا لم يكن موجوداً، قم بإنشائه
INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_global_email', 'info@syanatech.com', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_global_email');

-- 2. تحديث/إضافة رقم الهاتف السعودي
UPDATE static_options 
SET option_value = '+966 50 123 4567', updated_at = NOW()
WHERE option_name = 'site_contact_phone';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_contact_phone', '+966 50 123 4567', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_contact_phone');

-- 3. إضافة/تحديث روابط السوشيال ميديا
-- Facebook
UPDATE static_options 
SET option_value = 'https://www.facebook.com/syanatech', updated_at = NOW()
WHERE option_name = 'site_facebook_link';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_facebook_link', 'https://www.facebook.com/syanatech', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_facebook_link');

-- Twitter
UPDATE static_options 
SET option_value = 'https://www.twitter.com/syanatech', updated_at = NOW()
WHERE option_name = 'site_twitter_link';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_twitter_link', 'https://www.twitter.com/syanatech', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_twitter_link');

-- Instagram
UPDATE static_options 
SET option_value = 'https://www.instagram.com/syanatech', updated_at = NOW()
WHERE option_name = 'site_instagram_link';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_instagram_link', 'https://www.instagram.com/syanatech', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_instagram_link');

-- LinkedIn
UPDATE static_options 
SET option_value = 'https://www.linkedin.com/company/syanatech', updated_at = NOW()
WHERE option_name = 'site_linkedin_link';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_linkedin_link', 'https://www.linkedin.com/company/syanatech', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_linkedin_link');

-- YouTube
UPDATE static_options 
SET option_value = 'https://www.youtube.com/@syanatech', updated_at = NOW()
WHERE option_name = 'site_youtube_link';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_youtube_link', 'https://www.youtube.com/@syanatech', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_youtube_link');

-- WhatsApp
UPDATE static_options 
SET option_value = 'https://wa.me/966501234567', updated_at = NOW()
WHERE option_name = 'site_whatsapp_link';

INSERT INTO static_options (option_name, option_value, created_at, updated_at)
SELECT 'site_whatsapp_link', 'https://wa.me/966501234567', NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM static_options WHERE option_name = 'site_whatsapp_link');

-- التحقق من النتائج
-- SELECT option_name, option_value FROM static_options 
-- WHERE option_name IN ('site_global_email', 'site_contact_phone', 'site_facebook_link', 'site_twitter_link', 'site_instagram_link', 'site_linkedin_link', 'site_youtube_link', 'site_whatsapp_link');

