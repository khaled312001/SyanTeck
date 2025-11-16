# تعليمات إضافة البيانات الوهمية

## كيفية تشغيل Seeder البيانات الوهمية

### الطريقة الأولى: تشغيل Seeder مباشرة

```bash
php artisan db:seed --class=Database\\Seeds\\CompleteDummyDataSeeder
```

### الطريقة الثانية: إضافة Seeder إلى DatabaseSeeder

1. افتح ملف `@core/database/seeds/DatabaseSeeder.php`
2. قم بإلغاء التعليق عن السطر التالي:

```php
$this->call(CompleteDummyDataSeeder::class);
```

3. ثم قم بتشغيل:

```bash
php artisan db:seed
```

## البيانات التي سيتم إنشاؤها

### المستخدمون:
- **3 إداريين** (Admin)
- **5 وكلاء دعم** (Support)
- **3 وكلاء مالية** (Finance)
- **3 وكلاء جودة** (Quality)
- **30 عميل** (Client)
- **15 فني** (Technician)

### البيانات الأخرى:
- **8 فئات** (Categories)
- **عدة فئات فرعية** (Subcategories)
- **عدة خدمات** (Services)
- **100 طلب** (Orders)
- **30 متابعة جودة** (Quality Followups)
- **40 تقييم** (Reviews)
- **20 تذكرة دعم** (Support Tickets)

### الدول والمدن:
- **السعودية** مع 6 مدن رئيسية
- **عدة مناطق** لكل مدينة

## ملاحظات مهمة

1. **كلمة المرور الافتراضية** لجميع المستخدمين: `password`
2. **البريد الإلكتروني** للمستخدمين: `username@example.com`
3. سيتم إنشاء البيانات بشكل عشوائي مع علاقات صحيحة بين الجداول
4. يمكن تشغيل Seeder عدة مرات - سيتم إنشاء بيانات جديدة في كل مرة

## تحذير

⚠️ **تحذير**: هذا Seeder سيضيف بيانات وهمية كثيرة. تأكد من أنك تريد ذلك قبل التشغيل.

إذا كنت تريد حذف جميع البيانات وإعادة إنشائها:

```bash
php artisan migrate:fresh --seed
```

ثم قم بتشغيل Seeder البيانات الوهمية.

