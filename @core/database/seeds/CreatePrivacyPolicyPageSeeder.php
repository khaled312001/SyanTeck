<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Page;
use App\MetaData;
use App\StaticOption;
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
                نرحب بك في منصة <strong>صيانة تك</strong> - منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نحن ملتزمون بحماية خصوصيتك وضمان أمان معلوماتك الشخصية. تشرح هذه السياسة كيفية جمع واستخدام وحماية معلوماتك عند استخدام خدماتنا التي تشمل ربط العملاء بالفنيين المعتمدين في مجالات الكهرباء والسباكة والتكييف والأجهزة المنزلية والإلكترونيات.
            </p>
        </div>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">1. المعلومات التي نجمعها</h2>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">1.1 المعلومات الشخصية</h3>
        <p style="margin-bottom: 15px;">
            عند استخدام خدماتنا، قد نجمع المعلومات التالية:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>معلومات الهوية:</strong> الاسم الكامل، رقم الهاتف، عنوان البريد الإلكتروني، رقم الهوية الوطنية (للفنيين والتحقق من الهوية)</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الموقع:</strong> العنوان التفصيلي، المنطقة، المدينة، إحداثيات GPS</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الطلب:</strong> نوع الخدمة (صيانة/استشارة/محادثة)، تفاصيل الخدمة المطلوبة، التاريخ والوقت المفضل، مستوى الاستعجال</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الفني (للمسجلين كفنيين):</strong> نوع الوظيفة، الخبرة والمهارات، ملف السيرة الذاتية</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الدفع:</strong> طريقة الدفع المفضلة (لا نجمع تفاصيل البطاقات الائتمانية)</li>
            <li style="margin-bottom: 10px;"><strong>معلومات التقييم:</strong> تقييماتك للفنيين بعد إتمام الخدمة</li>
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
            <li style="margin-bottom: 10px;"><strong>تقديم الخدمات:</strong> معالجة طلباتك (طلب فني صيانة، استشارة تلفونية، محادثة مع الدعم) وربطك بالفنيين المعتمدين</li>
            <li style="margin-bottom: 10px;"><strong>التواصل:</strong> إرسال تأكيدات الطلبات، تتبع الطلبات في الوقت الفعلي، التحديثات، الفواتير الإلكترونية، شهادات الضمان الرقمية، والرد على استفساراتك</li>
            <li style="margin-bottom: 10px;"><strong>التحقق من الهوية:</strong> التحقق من رقم الهوية الوطنية لضمان حساب واحد لكل رقم هوية</li>
            <li style="margin-bottom: 10px;"><strong>نظام التقييم:</strong> عرض تقييمات الفنيين وتمكينك من تقييم الفنيين بعد إتمام الخدمة</li>
            <li style="margin-bottom: 10px;"><strong>تحسين الخدمة:</strong> تحليل استخدام الموقع لتحسين تجربتك</li>
            <li style="margin-bottom: 10px;"><strong>الأمان:</strong> حماية موقعنا ومستخدمينا من الاحتيال والأنشطة الضارة</li>
            <li style="margin-bottom: 10px;"><strong>التسويق:</strong> إرسال عروض خاصة وخدمات جديدة (يمكنك إلغاء الاشتراك في أي وقت)</li>
            <li style="margin-bottom: 10px;"><strong>الامتثال القانوني:</strong> الوفاء بالالتزامات القانونية والتنظيمية ودعم التحول الرقمي ضمن رؤية المملكة 2030</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">3. مشاركة المعلومات</h2>
        <p style="margin-bottom: 15px;">
            نحن لا نبيع معلوماتك الشخصية لأطراف ثالثة. قد نشارك معلوماتك في الحالات التالية فقط:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>الفنيون المعتمدون:</strong> نشارك معلومات الاتصال والموقع مع الفنيين المعتمدين والموثوقين (المسجلين برقم الهوية الوطنية) لتقديم الخدمة المطلوبة</li>
            <li style="margin-bottom: 10px;"><strong>فريق الدعم:</strong> نشارك معلومات الطلب مع فريق الدعم الفني للمتابعة وحل المشاكل</li>
            <li style="margin-bottom: 10px;"><strong>مقدمي الخدمات:</strong> نستخدم مزودي خدمات موثوقين (مثل استضافة المواقع، معالجة المدفوعات، خدمات الخرائط) الذين ملتزمون بحماية معلوماتك</li>
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
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">8. رقم الهوية الوطنية والتحقق</h2>
        <p style="margin-bottom: 15px;">
            لضمان الأمان والثقة في خدماتنا، نطلب من المستخدمين (العملاء والفنيين) تقديم رقم الهوية الوطنية عند التسجيل:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>التحقق من الهوية:</strong> نستخدم رقم الهوية الوطنية للتحقق من هوية المستخدمين وضمان حساب واحد فقط لكل رقم هوية</li>
            <li style="margin-bottom: 10px;"><strong>الفنيون الموثوقون:</strong> الفنيون المسجلون برقم الهوية الوطنية يتم تمييزهم كـ "موثوق برقم الهوية الوطنية" في الملف الشخصي</li>
            <li style="margin-bottom: 10px;"><strong>الأمان:</strong> رقم الهوية الوطنية يتم تشفيره وحمايته بأعلى معايير الأمان</li>
            <li style="margin-bottom: 10px;"><strong>عدم المشاركة:</strong> لا نشارك رقم الهوية الوطنية مع أي أطراف ثالثة إلا في حالات الالتزام القانوني</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">9. نظام التقييم والمراجعات</h2>
        <p style="margin-bottom: 15px;">
            نتيح للعملاء تقييم الفنيين بعد إتمام الخدمة:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>التقييمات:</strong> يمكن للعملاء تقييم الفنيين بناءً على جودة الخدمة، الاحترافية، الوقت، والأسعار</li>
            <li style="margin-bottom: 10px;"><strong>المراجعات:</strong> يمكن للعملاء كتابة مراجعات نصية عن تجربتهم مع الفني</li>
            <li style="margin-bottom: 10px;"><strong>عرض التقييمات:</strong> يتم عرض متوسط التقييمات وعدد الطلبات المكتملة في ملف الفني الشخصي</li>
            <li style="margin-bottom: 10px;"><strong>الفلترة:</strong> يمكن للعملاء اختيار الفنيين بناءً على التقييم، الخبرة، الموقع، وحالة التحقق</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">10. خصوصية الأطفال</h2>
        <p style="margin-bottom: 20px;">
            خدماتنا موجهة للأشخاص الذين تزيد أعمارهم عن 18 عاماً. لا نجمع معلومات شخصية عن قصد من الأطفال دون سن 18 عاماً. إذا علمنا أننا جمعنا معلومات من طفل دون سن 18 عاماً، سنقوم بحذفها فوراً.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">11. التغييرات على سياسة الخصوصية</h2>
        <p style="margin-bottom: 20px;">
            قد نحدث هذه السياسة من وقت لآخر. سنقوم بإشعارك بأي تغييرات جوهرية عبر البريد الإلكتروني أو إشعار على الموقع. ننصحك بمراجعة هذه الصفحة بانتظام للاطلاع على آخر التحديثات.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">12. روابط لمواقع خارجية</h2>
        <p style="margin-bottom: 20px;">
            قد يحتوي موقعنا على روابط لمواقع خارجية. نحن لسنا مسؤولين عن ممارسات الخصوصية أو محتوى هذه المواقع. ننصحك بقراءة سياسات الخصوصية الخاصة بهم.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">13. دعم التحول الرقمي ضمن رؤية المملكة 2030</h2>
        <p style="margin-bottom: 20px; padding: 15px; background-color: #e8f5e9; border-radius: 8px; border-right: 4px solid #4caf50;">
            <strong>التزامنا:</strong> منصة صيانة تك تساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم. نحن ملتزمون بدعم التحول الرقمي في المملكة العربية السعودية.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">14. الاتصال بنا</h2>
        <p style="margin-bottom: 15px;">
            إذا كان لديك أي أسئلة أو استفسارات حول سياسة الخصوصية هذه أو كيفية معالجتنا لمعلوماتك، يرجى الاتصال بنا:
        </p>
        <div style="background-color: #f5f5f5; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <p style="margin-bottom: 10px;"><strong>منصة صيانة تك - منصة خدمات الصيانة المنزلية والتقنية</strong></p>
            <p style="margin-bottom: 10px;"><strong>البريد الإلكتروني:</strong> ' . (StaticOption::where('option_name', 'site_global_email')->value('option_value') ?? 'info@syanteck.com') . '</p>
            <p style="margin-bottom: 10px;"><strong>الهاتف:</strong> ' . (StaticOption::where('option_name', 'site_contact_phone')->value('option_value') ?? 'متاح على صفحة التواصل') . '</p>
            <p style="margin-bottom: 10px;"><strong>العنوان:</strong> ' . (StaticOption::where('option_name', 'site_contact_address')->value('option_value') ?? 'المملكة العربية السعودية') . '</p>
            <p style="margin: 0;"><strong>الموقع الإلكتروني:</strong> ' . url('/') . '</p>
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






