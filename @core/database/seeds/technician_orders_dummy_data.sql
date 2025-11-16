-- إضافة بيانات وهمية لطلبات التقني
-- تأكد من وجود تقني (seller) وخدمات وعملاء في قاعدة البيانات أولاً

-- الحصول على ID التقني الأول (يمكنك تغييره حسب الحاجة)
SET @technician_id = (SELECT id FROM users WHERE user_type = 0 LIMIT 1);
SET @service_id = (SELECT id FROM services WHERE status = 1 LIMIT 1);
SET @buyer_id = (SELECT id FROM users WHERE user_type = 1 LIMIT 1);
SET @city_id = (SELECT id FROM service_cities LIMIT 1);
SET @area_id = (SELECT id FROM service_areas LIMIT 1);
SET @country_id = (SELECT id FROM countries LIMIT 1);

-- إذا لم يوجد تقني، إنشاء واحد
INSERT INTO users (name, email, username, password, phone, user_type, user_status, is_available, technician_code, rating, completed_orders_count, created_at, updated_at)
SELECT 'أحمد محمد التقني', 'technician@example.com', 'technician1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0501234567', 0, 1, 1, 'TECH001', 4.50, 0, NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'technician@example.com');

SET @technician_id = (SELECT id FROM users WHERE email = 'technician@example.com' LIMIT 1);

-- إذا لم يوجد عميل، إنشاء واحد
INSERT INTO users (name, email, username, password, phone, user_type, user_status, created_at, updated_at)
SELECT 'عميل تجريبي', 'client@example.com', 'client1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0501111111', 1, 1, NOW(), NOW()
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'client@example.com');

SET @buyer_id = (SELECT id FROM users WHERE email = 'client@example.com' LIMIT 1);

-- إضافة طلبات وهمية - قيد الانتظار (status = 0)
INSERT INTO orders (
    invoice, service_id, seller_id, buyer_id, name, email, phone, post_code, address, 
    city, area, country, date, schedule, package_fee, extra_service, sub_total, tax, total,
    payment_gateway, payment_status, status, order_note, is_order_online, tracking_code,
    urgency_level, assigned_at, created_at, updated_at
) VALUES
('INV-2024-000001', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12345', 'شارع 10، حي النزهة', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 5 DAY), 'صباحاً', 250.00, 50.00, 300.00, 45.00, 345.00, 'cash', 'pending', 0, 'صيانة عادية', 1, 'TRK-001', 'medium', DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY)),
('INV-2024-000002', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12346', 'شارع 20، حي الروضة', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 7 DAY), 'ظهراً', 300.00, 75.00, 375.00, 56.25, 431.25, 'bank_transfer', 'pending', 0, 'فحص شامل', 1, 'TRK-002', 'low', DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY)),
('INV-2024-000003', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12347', 'شارع 30، حي العليا', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 3 DAY), 'مساءً', 200.00, 30.00, 230.00, 34.50, 264.50, 'online', 'pending', 0, 'إصلاح عطل', 0, 'TRK-003', 'high', DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY)),
('INV-2024-000004', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12348', 'شارع 40، حي الملز', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 10 DAY), 'صباحاً', 400.00, 100.00, 500.00, 75.00, 575.00, 'cash', 'pending', 0, 'صيانة عاجلة', 1, 'TRK-004', 'high', DATE_SUB(NOW(), INTERVAL 5 DAY), DATE_SUB(NOW(), INTERVAL 5 DAY), DATE_SUB(NOW(), INTERVAL 5 DAY)),
('INV-2024-000005', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12349', 'شارع 50، حي العليا', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 6 DAY), 'ظهراً', 350.00, 80.00, 430.00, 64.50, 494.50, 'bank_transfer', 'pending', 0, 'صيانة عادية', 1, 'TRK-005', 'medium', DATE_SUB(NOW(), INTERVAL 4 DAY), DATE_SUB(NOW(), INTERVAL 4 DAY), DATE_SUB(NOW(), INTERVAL 4 DAY));

-- إضافة طلبات وهمية - نشط (status = 1)
INSERT INTO orders (
    invoice, service_id, seller_id, buyer_id, name, email, phone, post_code, address, 
    city, area, country, date, schedule, package_fee, extra_service, sub_total, tax, total,
    payment_gateway, payment_status, status, order_note, is_order_online, tracking_code,
    urgency_level, assigned_at, accepted_at, created_at, updated_at
) VALUES
('INV-2024-000006', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12350', 'شارع 60، حي النزهة', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 2 DAY), 'صباحاً', 280.00, 60.00, 340.00, 51.00, 391.00, 'cash', 'completed', 1, 'صيانة عادية', 1, 'TRK-006', 'medium', DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 9 DAY), DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 9 DAY)),
('INV-2024-000007', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12351', 'شارع 70، حي الروضة', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 4 DAY), 'ظهراً', 320.00, 70.00, 390.00, 58.50, 448.50, 'bank_transfer', 'completed', 1, 'فحص شامل', 1, 'TRK-007', 'low', DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 7 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 7 DAY)),
('INV-2024-000008', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12352', 'شارع 80، حي العليا', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 1 DAY), 'مساءً', 220.00, 40.00, 260.00, 39.00, 299.00, 'online', 'completed', 1, 'إصلاح عطل', 0, 'TRK-008', 'high', DATE_SUB(NOW(), INTERVAL 12 DAY), DATE_SUB(NOW(), INTERVAL 11 DAY), DATE_SUB(NOW(), INTERVAL 12 DAY), DATE_SUB(NOW(), INTERVAL 11 DAY)),
('INV-2024-000009', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12353', 'شارع 90، حي الملز', @city_id, @area_id, @country_id, NOW(), 'صباحاً', 450.00, 120.00, 570.00, 85.50, 655.50, 'cash', 'completed', 1, 'صيانة عاجلة', 1, 'TRK-009', 'high', DATE_SUB(NOW(), INTERVAL 6 DAY), DATE_SUB(NOW(), INTERVAL 5 DAY), DATE_SUB(NOW(), INTERVAL 6 DAY), DATE_SUB(NOW(), INTERVAL 5 DAY)),
('INV-2024-000010', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12354', 'شارع 100، حي النزهة', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 3 DAY), 'ظهراً', 380.00, 90.00, 470.00, 70.50, 540.50, 'bank_transfer', 'completed', 1, 'صيانة عادية', 1, 'TRK-010', 'medium', DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 14 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 14 DAY)),
('INV-2024-000011', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12355', 'شارع 110، حي الروضة', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 8 DAY), 'مساءً', 290.00, 65.00, 355.00, 53.25, 408.25, 'online', 'completed', 1, 'فحص شامل', 1, 'TRK-011', 'low', DATE_SUB(NOW(), INTERVAL 7 DAY), DATE_SUB(NOW(), INTERVAL 6 DAY), DATE_SUB(NOW(), INTERVAL 7 DAY), DATE_SUB(NOW(), INTERVAL 6 DAY)),
('INV-2024-000012', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12356', 'شارع 120، حي العليا', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 9 DAY), 'صباحاً', 310.00, 75.00, 385.00, 57.75, 442.75, 'cash', 'completed', 1, 'إصلاح عطل', 0, 'TRK-012', 'medium', DATE_SUB(NOW(), INTERVAL 9 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 9 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY)),
('INV-2024-000013', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12357', 'شارع 130، حي الملز', @city_id, @area_id, @country_id, DATE_ADD(NOW(), INTERVAL 11 DAY), 'ظهراً', 420.00, 110.00, 530.00, 79.50, 609.50, 'bank_transfer', 'completed', 1, 'صيانة عاجلة', 1, 'TRK-013', 'high', DATE_SUB(NOW(), INTERVAL 11 DAY), DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 11 DAY), DATE_SUB(NOW(), INTERVAL 10 DAY));

-- إضافة طلبات وهمية - مكتمل (status = 2)
INSERT INTO orders (
    invoice, service_id, seller_id, buyer_id, name, email, phone, post_code, address, 
    city, area, country, date, schedule, package_fee, extra_service, sub_total, tax, total,
    payment_gateway, payment_status, status, order_note, is_order_online, tracking_code,
    warranty_code, warranty_days, has_warranty, urgency_level, assigned_at, accepted_at, completed_at, created_at, updated_at
) VALUES
('INV-2024-000014', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12358', 'شارع 140، حي النزهة', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 5 DAY), 'صباحاً', 260.00, 55.00, 315.00, 47.25, 362.25, 'cash', 'completed', 2, 'صيانة عادية', 1, 'TRK-014', 'WAR-001', 90, 1, 'medium', DATE_SUB(NOW(), INTERVAL 20 DAY), DATE_SUB(NOW(), INTERVAL 19 DAY), DATE_SUB(NOW(), INTERVAL 5 DAY), DATE_SUB(NOW(), INTERVAL 20 DAY), DATE_SUB(NOW(), INTERVAL 5 DAY)),
('INV-2024-000015', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12359', 'شارع 150، حي الروضة', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 8 DAY), 'ظهراً', 330.00, 80.00, 410.00, 61.50, 471.50, 'bank_transfer', 'completed', 2, 'فحص شامل', 1, 'TRK-015', 'WAR-002', 180, 1, 'low', DATE_SUB(NOW(), INTERVAL 25 DAY), DATE_SUB(NOW(), INTERVAL 24 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 25 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY)),
('INV-2024-000016', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12360', 'شارع 160، حي العليا', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 12 DAY), 'مساءً', 240.00, 50.00, 290.00, 43.50, 333.50, 'online', 'completed', 2, 'إصلاح عطل', 0, 'TRK-016', 'WAR-003', 365, 1, 'high', DATE_SUB(NOW(), INTERVAL 30 DAY), DATE_SUB(NOW(), INTERVAL 29 DAY), DATE_SUB(NOW(), INTERVAL 12 DAY), DATE_SUB(NOW(), INTERVAL 30 DAY), DATE_SUB(NOW(), INTERVAL 12 DAY)),
('INV-2024-000017', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12361', 'شارع 170، حي الملز', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 15 DAY), 'صباحاً', 470.00, 130.00, 600.00, 90.00, 690.00, 'cash', 'completed', 2, 'صيانة عاجلة', 1, 'TRK-017', 'WAR-004', 120, 1, 'high', DATE_SUB(NOW(), INTERVAL 35 DAY), DATE_SUB(NOW(), INTERVAL 34 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 35 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY)),
('INV-2024-000018', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12362', 'شارع 180، حي النزهة', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 18 DAY), 'ظهراً', 360.00, 85.00, 445.00, 66.75, 511.75, 'bank_transfer', 'completed', 2, 'صيانة عادية', 1, 'TRK-018', 'WAR-005', 60, 1, 'medium', DATE_SUB(NOW(), INTERVAL 40 DAY), DATE_SUB(NOW(), INTERVAL 39 DAY), DATE_SUB(NOW(), INTERVAL 18 DAY), DATE_SUB(NOW(), INTERVAL 40 DAY), DATE_SUB(NOW(), INTERVAL 18 DAY)),
('INV-2024-000019', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12363', 'شارع 190، حي الروضة', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 22 DAY), 'مساءً', 300.00, 70.00, 370.00, 55.50, 425.50, 'online', 'completed', 2, 'فحص شامل', 1, 'TRK-019', 'WAR-006', 90, 1, 'low', DATE_SUB(NOW(), INTERVAL 45 DAY), DATE_SUB(NOW(), INTERVAL 44 DAY), DATE_SUB(NOW(), INTERVAL 22 DAY), DATE_SUB(NOW(), INTERVAL 45 DAY), DATE_SUB(NOW(), INTERVAL 22 DAY)),
('INV-2024-000020', @service_id, @technician_id, @buyer_id, 'عميل تجريبي', 'client@example.com', '0501111111', '12364', 'شارع 200، حي العليا', @city_id, @area_id, @country_id, DATE_SUB(NOW(), INTERVAL 28 DAY), 'صباحاً', 410.00, 100.00, 510.00, 76.50, 586.50, 'cash', 'completed', 2, 'إصلاح عطل', 0, 'TRK-020', 'WAR-007', 180, 1, 'medium', DATE_SUB(NOW(), INTERVAL 50 DAY), DATE_SUB(NOW(), INTERVAL 49 DAY), DATE_SUB(NOW(), INTERVAL 28 DAY), DATE_SUB(NOW(), INTERVAL 50 DAY), DATE_SUB(NOW(), INTERVAL 28 DAY));

-- تعيين دور التقني للمستخدم (إذا كان Spatie Permission مثبت)
-- يمكنك تنفيذ هذا الأمر إذا كان لديك جدول model_has_roles
-- INSERT INTO model_has_roles (role_id, model_type, model_id) 
-- SELECT (SELECT id FROM roles WHERE name = 'Technician' LIMIT 1), 'App\\User', @technician_id
-- WHERE NOT EXISTS (SELECT 1 FROM model_has_roles WHERE model_id = @technician_id AND role_id = (SELECT id FROM roles WHERE name = 'Technician' LIMIT 1));

