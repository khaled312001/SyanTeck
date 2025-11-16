<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Page;
use App\MetaData;
use Illuminate\Support\Str;

class CreatePrivacyPolicyPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if page already exists
        $existingPage = Page::where('slug', 'privacy-policy')->orWhere('slug', 'siyasat-al-khososia')->first();
        
        if ($existingPage) {
            $this->command->info('Privacy Policy page already exists. Updating...');
            $page = $existingPage;
        } else {
            $this->command->info('Creating Privacy Policy page...');
            $page = new Page();
        }

        // Set page data
        $page->title = 'سياسة الخصوصية';
        $page->slug = 'privacy-policy';
        $page->status = 'publish';
        $page->visibility = 'public';
        $page->page_builder_status = 0;
        $page->layout = 'default';
        $page->sidebar_layout = 'none';
        $page->page_class = '';
        $page->back_to_top = 'on';
        $page->breadcrumb_status = 'on';
        $page->footer_variant = '01';
        $page->navbar_variant = '01';
        $page->widget_style = '01';
        $page->left_column = 0;
        $page->right_column = 0;

        // Page content in Arabic
        $page->page_content = '
<div class="privacy-policy-page" style="max-width: 900px; margin: 0 auto; padding: 40px 20px; direction: rtl; text-align: right;">
    <h1 style="text-align: center; color: #2196F3; margin-bottom: 30px; font-size: 32px; font-weight: bold;">سياسة الخصوصية</h1>
    
    <div style="line-height: 1.8; color: #555; font-size: 16px;">
        <p style="margin-bottom: 20px; text-align: center; color: #666;">
            <strong>آخر تحديث:</strong> ' . date('Y-m-d') . '
        </p>
        
        <div style="background-color: #f0f7ff; padding: 20px; border-radius: 10px; margin-bottom: 30px; border-right: 4px solid #2196F3;">
            <p style="margin: 0; color: #1976D2; font-size: 17px;">
                نرحب بك في منصة <strong>صيانة تك</strong>. نحن ملتزمون بحماية خصوصيتك وضمان أمان معلوماتك الشخصية. تشرح هذه السياسة كيفية جمع واستخدام وحماية معلوماتك عند استخدام خدماتنا.
            </p>
        </div>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">1. المعلومات التي نجمعها</h2>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">1.1 المعلومات الشخصية</h3>
        <p style="margin-bottom: 15px;">
            عند استخدام خدماتنا، قد نجمع المعلومات التالية:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>معلومات الهوية:</strong> الاسم الكامل، رقم الهاتف، عنوان البريد الإلكتروني</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الموقع:</strong> العنوان التفصيلي، المنطقة، المدينة</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الطلب:</strong> تفاصيل الخدمة المطلوبة، التاريخ والوقت المفضل</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الدفع:</strong> طريقة الدفع المفضلة (لا نجمع تفاصيل البطاقات الائتمانية)</li>
        </ul>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">1.2 المعلومات التقنية</h3>
        <p style="margin-bottom: 15px;">
            نجمع تلقائياً بعض المعلومات التقنية عند زيارة موقعنا:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">عنوان IP الخاص بك</li>
            <li style="margin-bottom: 10px;">نوع المتصفح ونظام التشغيل</li>
            <li style="margin-bottom: 10px;">الصفحات التي تزورها ووقت الزيارة</li>
            <li style="margin-bottom: 10px;">مصدر الإحالة (الموقع الذي أتيت منه)</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">2. كيفية استخدامنا لمعلوماتك</h2>
        <p style="margin-bottom: 15px;">
            نستخدم المعلومات التي نجمعها للأغراض التالية:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>تقديم الخدمات:</strong> معالجة طلباتك وربطك بالفنيين المعتمدين</li>
            <li style="margin-bottom: 10px;"><strong>التواصل:</strong> إرسال تأكيدات الطلبات والتحديثات والرد على استفساراتك</li>
            <li style="margin-bottom: 10px;"><strong>تحسين الخدمة:</strong> تحليل استخدام الموقع لتحسين تجربتك</li>
            <li style="margin-bottom: 10px;"><strong>الأمان:</strong> حماية موقعنا ومستخدمينا من الاحتيال والأنشطة الضارة</li>
            <li style="margin-bottom: 10px;"><strong>التسويق:</strong> إرسال عروض خاصة وخدمات جديدة (يمكنك إلغاء الاشتراك في أي وقت)</li>
            <li style="margin-bottom: 10px;"><strong>الامتثال القانوني:</strong> الوفاء بالالتزامات القانونية والتنظيمية</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">3. مشاركة المعلومات</h2>
        <p style="margin-bottom: 15px;">
            نحن لا نبيع معلوماتك الشخصية لأطراف ثالثة. قد نشارك معلوماتك في الحالات التالية فقط:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>الفنيون المعتمدون:</strong> نشارك معلومات الاتصال والموقع مع الفنيين المعتمدين لتقديم الخدمة المطلوبة</li>
            <li style="margin-bottom: 10px;"><strong>مقدمي الخدمات:</strong> نستخدم مزودي خدمات موثوقين (مثل استضافة المواقع، معالجة المدفوعات) الذين ملتزمون بحماية معلوماتك</li>
            <li style="margin-bottom: 10px;"><strong>الالتزام القانوني:</strong> إذا طُلب منا قانونياً الكشف عن المعلومات</li>
            <li style="margin-bottom: 10px;"><strong>حماية الحقوق:</strong> لحماية حقوقنا وممتلكاتنا ومستخدمينا</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">4. أمان المعلومات</h2>
        <p style="margin-bottom: 15px;">
            نتخذ إجراءات أمنية متعددة لحماية معلوماتك:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">تشفير البيانات الحساسة أثناء النقل</li>
            <li style="margin-bottom: 10px;">خوادم آمنة ومحمية</li>
            <li style="margin-bottom: 10px;">الوصول المحدود للمعلومات الشخصية فقط للموظفين المصرح لهم</li>
            <li style="margin-bottom: 10px;">مراجعات أمنية منتظمة</li>
        </ul>
        <p style="margin-bottom: 20px; padding: 15px; background-color: #fff3cd; border-radius: 8px; border-right: 4px solid #ffc107;">
            <strong>ملاحظة مهمة:</strong> رغم اتخاذنا جميع الإجراءات الأمنية الممكنة، لا يمكن ضمان أمان 100% لأي بيانات عبر الإنترنت. ننصحك بعدم مشاركة معلومات حساسة جداً عبر الإنترنت.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">5. ملفات تعريف الارتباط (Cookies)</h2>
        <p style="margin-bottom: 15px;">
            نستخدم ملفات تعريف الارتباط لتحسين تجربتك على موقعنا. ملفات تعريف الارتباط هي ملفات نصية صغيرة يتم تخزينها على جهازك. نستخدمها ل:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">تذكر تفضيلاتك وإعداداتك</li>
            <li style="margin-bottom: 10px;">تحليل استخدام الموقع</li>
            <li style="margin-bottom: 10px;">تحسين أداء الموقع</li>
        </ul>
        <p style="margin-bottom: 20px;">
            يمكنك تعطيل ملفات تعريف الارتباط من إعدادات المتصفح، لكن قد يؤثر ذلك على وظائف الموقع.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">6. حقوقك</h2>
        <p style="margin-bottom: 15px;">
            لديك الحقوق التالية فيما يتعلق بمعلوماتك الشخصية:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>حق الوصول:</strong> يمكنك طلب نسخة من معلوماتك الشخصية</li>
            <li style="margin-bottom: 10px;"><strong>حق التصحيح:</strong> يمكنك تحديث أو تصحيح معلوماتك في أي وقت</li>
            <li style="margin-bottom: 10px;"><strong>حق الحذف:</strong> يمكنك طلب حذف معلوماتك الشخصية</li>
            <li style="margin-bottom: 10px;"><strong>حق الاعتراض:</strong> يمكنك الاعتراض على معالجة معلوماتك لأغراض تسويقية</li>
            <li style="margin-bottom: 10px;"><strong>حق نقل البيانات:</strong> يمكنك طلب نقل معلوماتك إلى خدمة أخرى</li>
        </ul>
        <p style="margin-bottom: 20px;">
            لممارسة أي من هذه الحقوق، يرجى الاتصال بنا من خلال معلومات الاتصال المذكورة أدناه.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">7. الاحتفاظ بالبيانات</h2>
        <p style="margin-bottom: 20px;">
            نحتفظ بمعلوماتك الشخصية طالما كانت ضرورية لتقديم الخدمات وتحقيق الأغراض المذكورة في هذه السياسة، أو كما يتطلب القانون. عند عدم الحاجة إلى المعلومات، سنقوم بحذفها بشكل آمن.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">8. خصوصية الأطفال</h2>
        <p style="margin-bottom: 20px;">
            خدماتنا موجهة للأشخاص الذين تزيد أعمارهم عن 18 عاماً. لا نجمع معلومات شخصية عن قصد من الأطفال دون سن 18 عاماً. إذا علمنا أننا جمعنا معلومات من طفل دون سن 18 عاماً، سنقوم بحذفها فوراً.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">9. التغييرات على سياسة الخصوصية</h2>
        <p style="margin-bottom: 20px;">
            قد نحدث هذه السياسة من وقت لآخر. سنقوم بإشعارك بأي تغييرات جوهرية عبر البريد الإلكتروني أو إشعار على الموقع. ننصحك بمراجعة هذه الصفحة بانتظام للاطلاع على آخر التحديثات.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">10. روابط لمواقع خارجية</h2>
        <p style="margin-bottom: 20px;">
            قد يحتوي موقعنا على روابط لمواقع خارجية. نحن لسنا مسؤولين عن ممارسات الخصوصية أو محتوى هذه المواقع. ننصحك بقراءة سياسات الخصوصية الخاصة بهم.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">11. الاتصال بنا</h2>
        <p style="margin-bottom: 15px;">
            إذا كان لديك أي أسئلة أو استفسارات حول سياسة الخصوصية هذه أو كيفية معالجتنا لمعلوماتك، يرجى الاتصال بنا:
        </p>
        <div style="background-color: #f5f5f5; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <p style="margin-bottom: 10px;"><strong>منصة صيانة تك</strong></p>
            <p style="margin-bottom: 10px;">البريد الإلكتروني: info@syanteck.com</p>
            <p style="margin-bottom: 10px;">الهاتف: متاح على صفحة التواصل</p>
            <p style="margin: 0;">الموقع الإلكتروني: www.syanteck.com</p>
        </div>
        
        <div style="margin-top: 40px; padding: 25px; background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%); border-radius: 15px; color: white; text-align: center;">
            <p style="margin: 0; font-size: 18px; font-weight: bold;">
                شكراً لثقتك في منصة صيانة تك
            </p>
            <p style="margin: 10px 0 0 0; font-size: 16px; opacity: 0.9;">
                نحن ملتزمون بحماية خصوصيتك وتقديم أفضل خدمة ممكنة
            </p>
        </div>
    </div>
</div>
';

        $page->save();

        // Create or update meta data
        $metaData = $page->meta_data;
        if (!$metaData) {
            $metaData = new MetaData();
            $metaData->meta_taggable_type = Page::class;
            $metaData->meta_taggable_id = $page->id;
        }

        $metaData->meta_title = 'سياسة الخصوصية - صيانة تك';
        $metaData->meta_tags = 'سياسة الخصوصية, صيانة تك, حماية البيانات, الخصوصية';
        $metaData->meta_description = 'سياسة الخصوصية لمنصة صيانة تك - نحمي معلوماتك الشخصية ونضمن أمان بياناتك';
        $metaData->facebook_meta_tags = 'سياسة الخصوصية, صيانة تك';
        $metaData->facebook_meta_description = 'سياسة الخصوصية لمنصة صيانة تك - حماية معلوماتك الشخصية';
        $metaData->twitter_meta_tags = 'سياسة الخصوصية, صيانة تك';
        $metaData->twitter_meta_description = 'سياسة الخصوصية لمنصة صيانة تك - حماية معلوماتك الشخصية';

        $metaData->save();

        $this->command->info('✓ Privacy Policy page created/updated successfully!');
        $this->command->info('  Page URL: /' . $page->slug);
        $this->command->info('  Page Title: ' . $page->title);
    }
}

