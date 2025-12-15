<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Page;
use App\MetaData;
use App\StaticOption;
use Illuminate\Support\Str;

class CreateTermsAndConditionsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if page already exists
        $existingPage = Page::where('slug', 'terms-and-conditions')->orWhere('slug', 'shorout-wa-al-ahkam')->first();
        
        if ($existingPage) {
            $this->command->info('Terms and Conditions page already exists. Updating...');
            $page = $existingPage;
        } else {
            $this->command->info('Creating Terms and Conditions page...');
            $page = new Page();
        }

        // Set page data
        $page->title = 'الشروط والأحكام';
        $page->slug = 'terms-and-conditions';
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
<div class="terms-and-conditions-page" style="max-width: 900px; margin: 0 auto; padding: 40px 20px; direction: rtl; text-align: right;">
    <h1 style="text-align: center; color: #2196F3; margin-bottom: 30px; font-size: 32px; font-weight: bold;">الشروط والأحكام</h1>
    
    <div style="line-height: 1.8; color: #555; font-size: 16px;">
        <p style="margin-bottom: 20px; text-align: center; color: #666;">
            <strong>آخر تحديث:</strong> ' . date('Y-m-d') . '
        </p>
        
        <div style="background-color: #f0f7ff; padding: 20px; border-radius: 10px; margin-bottom: 30px; border-right: 4px solid #2196F3;">
            <p style="margin: 0; color: #1976D2; font-size: 17px;">
                مرحباً بك في منصة <strong>صيانة تك</strong> - منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نحن نعمل كوسيط بين العملاء والفنيين المعتمدين لتقديم خدمات الصيانة والإصلاح والتركيب. يرجى قراءة هذه الشروط والأحكام بعناية قبل استخدام خدماتنا. باستخدام موقعنا وخدماتنا، فإنك توافق على الالتزام بهذه الشروط.
            </p>
        </div>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">1. القبول والشروط</h2>
        <p style="margin-bottom: 15px;">
            من خلال الوصول إلى واستخدام منصة صيانة تك، فإنك تقر بأنك قد قرأت وفهمت ووافقت على الالتزام بهذه الشروط والأحكام وجميع القوانين واللوائح المعمول بها. إذا كنت لا توافق على أي جزء من هذه الشروط، فيرجى عدم استخدام خدماتنا.
        </p>
        <p style="margin-bottom: 20px;">
            نحتفظ بالحق في تحديث أو تعديل هذه الشروط في أي وقت دون إشعار مسبق. استمرار استخدامك للخدمات بعد أي تغييرات يعني موافقتك على الشروط المحدثة.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">2. تعريف الخدمات</h2>
        <p style="margin-bottom: 15px;">
            <strong>صيانة تك</strong> هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نحن نعمل كوسيط بين العملاء والفنيين المعتمدين والموثوقين (المسجلين برقم الهوية الوطنية) لتقديم الخدمات التالية:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>خدمات الصيانة المنزلية:</strong> كهرباء، سباكة، تكييف، أجهزة منزلية، إلكترونيات</li>
            <li style="margin-bottom: 10px;"><strong>خدمات الإصلاح والترميم:</strong> إصلاح الأعطال وإعادة التأهيل</li>
            <li style="margin-bottom: 10px;"><strong>خدمات التركيب:</strong> تركيب الأجهزة والأنظمة</li>
            <li style="margin-bottom: 10px;"><strong>أنواع الطلبات:</strong> طلب فني صيانة، استشارة تلفونية فورية مجانية، فتح محادثة مجانية مع الدعم الفني</li>
            <li style="margin-bottom: 10px;"><strong>خدمات إضافية:</strong> تتبع مباشر للطلبات، فواتير إلكترونية، ضمانات رقمية، نظام تقييم الفنيين</li>
        </ul>
        <p style="margin-bottom: 20px; padding: 15px; background-color: #fff3cd; border-radius: 8px; border-right: 4px solid #ffc107;">
            <strong>ملاحظة مهمة:</strong> نحن لا نقدم الخدمات مباشرة، بل نعمل كوسيط لربطك بالفنيين المعتمدين والموثوقين. العلاقة التعاقدية تكون مباشرة بينك وبين الفني. جميع التواصل يتم من خلال المنصة وليس مباشرة مع الفني.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">3. التسعير والدفع</h2>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">3.1 آلية التسعير</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">سيتم حساب سعر الصيانة أو الإصلاح أو التركيب <strong>بعد معاينة الفني</strong> للمشكلة في الموقع</li>
            <li style="margin-bottom: 10px;">السعر النهائي يعتمد على نوع الخدمة المطلوبة (كهرباء، سباكة، تكييف، أجهزة منزلية، إلكترونيات) ومدى تعقيدها</li>
            <li style="margin-bottom: 10px;">سيقوم الفني بشرح التكلفة المقدرة قبل بدء العمل</li>
            <li style="margin-bottom: 10px;">يحق للعميل الموافقة أو رفض السعر المقترح</li>
            <li style="margin-bottom: 10px;"><strong>الاستشارات والمحادثات:</strong> الاستشارة التلفونية الفورية والمحادثة مع الدعم الفني مجانية تماماً</li>
        </ul>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">3.2 طرق الدفع</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>الدفع النقدي (كاش):</strong> الدفع مباشرة للفني بعد إتمام الخدمة</li>
            <li style="margin-bottom: 10px;"><strong>البطاقات الائتمانية (فيزا/ماستركارد):</strong> الدفع الإلكتروني عبر البطاقة</li>
            <li style="margin-bottom: 10px;"><strong>STC Pay:</strong> الدفع عبر تطبيق STC Pay</li>
        </ul>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">3.3 توقيت الدفع</h3>
        <p style="margin-bottom: 20px;">
            يتم الدفع <strong>بعد إتمام الخدمة والموافقة عليها من قبل العميل</strong>. يجب على العميل فحص العمل المنجز والتأكد من جودته قبل الدفع. بعد الدفع، يُعتبر العميل راضياً عن الخدمة المقدمة.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">4. مسؤوليات الفني</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">تقديم خدمة احترافية عالية الجودة في مجال تخصصه (كهرباء، سباكة، تكييف، أجهزة منزلية، إلكترونيات)</li>
            <li style="margin-bottom: 10px;">الوصول في الوقت المحدد أو إشعار العميل بأي تأخير</li>
            <li style="margin-bottom: 10px;">معاينة المشكلة بدقة وشرح الحل المقترح</li>
            <li style="margin-bottom: 10px;">تقديم سعر عادل وشفاف قبل بدء العمل</li>
            <li style="margin-bottom: 10px;">إتمام العمل بشكل صحيح وضمان جودة الخدمة</li>
            <li style="margin-bottom: 10px;">توفير ضمان مناسب حسب نوع الخدمة (يتم إصدار شهادة ضمان رقمية)</li>
            <li style="margin-bottom: 10px;">الالتزام بمعايير السلامة والأمان</li>
            <li style="margin-bottom: 10px;">المحافظة على نظافة موقع العمل</li>
            <li style="margin-bottom: 10px;">تحديث حالة الطلب في الوقت الفعلي (في الطريق، وصل، بدء العمل، اكتمال العمل)</li>
            <li style="margin-bottom: 10px;">تقديم تقرير فني بعد إتمام الخدمة</li>
            <li style="margin-bottom: 10px;">التواصل مع العميل من خلال المنصة فقط وليس مباشرة</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">5. مسؤوليات العميل</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">تقديم معلومات دقيقة وصحيحة عند طلب الخدمة (الاسم، رقم الهاتف، العنوان، وصف المشكلة، نوع الطلب: صيانة/استشارة/محادثة)</li>
            <li style="margin-bottom: 10px;">تحديد موقعك بدقة على الخريطة أو توفير العنوان التفصيلي</li>
            <li style="margin-bottom: 10px;">توفير الوصول الكامل للموقع للمعاينة والإصلاح</li>
            <li style="margin-bottom: 10px;">توفير بيئة آمنة للفني للعمل</li>
            <li style="margin-bottom: 10px;">الالتزام بالموعد المحدد أو إشعار الفني بأي تغيير</li>
            <li style="margin-bottom: 10px;">فحص العمل المنجز قبل الدفع</li>
            <li style="margin-bottom: 10px;">الدفع بعد إتمام الخدمة والموافقة عليها</li>
            <li style="margin-bottom: 10px;">الاحتفاظ بالفاتورة الإلكترونية وشهادة الضمان الرقمية كدليل على الخدمة المقدمة</li>
            <li style="margin-bottom: 10px;">التعامل مع الفني باحترام وأدب</li>
            <li style="margin-bottom: 10px;">تقييم الفني بعد إتمام الخدمة بشكل موضوعي وصادق</li>
            <li style="margin-bottom: 10px;">التواصل مع الفني من خلال المنصة فقط وليس مباشرة</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">6. الإلغاء والاسترجاع</h2>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">6.1 إلغاء الطلب</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يمكن للعميل إلغاء الطلب <strong>قبل وصول الفني</strong> دون أي رسوم</li>
            <li style="margin-bottom: 10px;">في حالة إلغاء الطلب <strong>بعد وصول الفني</strong>، قد يتم تطبيق رسوم إلغاء حسب المدة التي قضاها الفني</li>
            <li style="margin-bottom: 10px;">يحق للفني إلغاء الطلب في حالات معينة (مثل عدم توفر الأدوات المطلوبة، أو عدم إمكانية الوصول للموقع)</li>
        </ul>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">6.2 الاسترجاع</h3>
        <p style="margin-bottom: 20px; padding: 15px; background-color: #f8d7da; border-radius: 8px; border-right: 4px solid #dc3545;">
            <strong>سياسة الاسترجاع:</strong> لا يمكن استرجاع المبلغ بعد إتمام الخدمة والموافقة عليها من قبل العميل. في حالة وجود مشكلة في الخدمة المقدمة، يجب التواصل مع فريق الدعم خلال 48 ساعة من إتمام الخدمة.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">7. الفواتير الإلكترونية والضمانات الرقمية</h2>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">7.1 الفواتير الإلكترونية</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">بعد إتمام الخدمة، يتم إصدار فاتورة إلكترونية مفصلة تلقائياً</li>
            <li style="margin-bottom: 10px;">الفاتورة تحتوي على جميع تفاصيل الخدمة المقدمة والأسعار</li>
            <li style="margin-bottom: 10px;">يمكن للعميل تحميل الفاتورة بصيغة PDF في أي وقت</li>
            <li style="margin-bottom: 10px;">الفاتورة الإلكترونية تعتبر وثيقة رسمية للخدمة المقدمة</li>
        </ul>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">7.2 الضمانات الرقمية</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">بعد إتمام الخدمة، يتم إصدار شهادة ضمان رقمية تلقائياً</li>
            <li style="margin-bottom: 10px;">يتم تحديد فترة الضمان من قبل الفني حسب نوع الخدمة المقدمة</li>
            <li style="margin-bottom: 10px;">الضمان يغطي عيوب العمل والمواد المستخدمة (إن وجدت)</li>
            <li style="margin-bottom: 10px;">الضمان لا يغطي الأضرار الناتجة عن سوء الاستخدام أو الإهمال من قبل العميل</li>
            <li style="margin-bottom: 10px;">يمكن للعميل تحميل شهادة الضمان بصيغة PDF في أي وقت</li>
            <li style="margin-bottom: 10px;">في حالة وجود مشكلة خلال فترة الضمان، يجب التواصل مع الفني من خلال المنصة</li>
        </ul>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">7.3 تتبع الطلبات في الوقت الفعلي</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يمكن للعميل تتبع حالة طلبه في الوقت الفعلي</li>
            <li style="margin-bottom: 10px;">حالات الطلب: في انتظار التعيين، تم التعيين، في الطريق، وصل، بدء العمل، اكتمال العمل</li>
            <li style="margin-bottom: 10px;">يتم إرسال إشعارات تلقائية عند تغيير حالة الطلب</li>
            <li style="margin-bottom: 10px;">يمكن للعميل متابعة تقدم العمل من خلال رمز التتبع المخصص</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">8. الخصوصية وحماية البيانات</h2>
        <p style="margin-bottom: 20px;">
            نحن نلتزم بحماية خصوصية عملائنا ومعلوماتهم الشخصية. يتم استخدام المعلومات الشخصية فقط لتقديم الخدمات وتحسين تجربة المستخدم. لمزيد من التفاصيل حول كيفية جمع واستخدام وحماية معلوماتك، يرجى مراجعة <a href="/privacy-policy" style="color: #2196F3; text-decoration: underline;">سياسة الخصوصية</a>.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">9. التسجيل ورقم الهوية الوطنية</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>التسجيل:</strong> يجب على جميع المستخدمين (عملاء وفنيين) التسجيل في المنصة قبل استخدام الخدمات</li>
            <li style="margin-bottom: 10px;"><strong>رقم الهوية الوطنية:</strong> نطلب من جميع المستخدمين تقديم رقم الهوية الوطنية للتحقق من الهوية</li>
            <li style="margin-bottom: 10px;"><strong>حساب واحد فقط:</strong> يُسمح بحساب واحد فقط لكل رقم هوية وطنية لضمان الأمان والثقة</li>
            <li style="margin-bottom: 10px;"><strong>الفنيون الموثوقون:</strong> الفنيون المسجلون برقم الهوية الوطنية يتم تمييزهم كـ "موثوق برقم الهوية الوطنية" في ملفهم الشخصي</li>
            <li style="margin-bottom: 10px;"><strong>معلومات الفني:</strong> عند التسجيل كفني، يجب تقديم نوع الوظيفة، الخبرة والمهارات، وملف السيرة الذاتية</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">10. التقييمات والمراجعات</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يمكن للعملاء تقييم الفنيين وترك مراجعات بعد إتمام الخدمة</li>
            <li style="margin-bottom: 10px;">يجب أن تكون التقييمات صادقة وموضوعية</li>
            <li style="margin-bottom: 10px;">يحظر استخدام لغة مسيئة أو غير لائقة في المراجعات</li>
            <li style="margin-bottom: 10px;">نحتفظ بالحق في حذف أي مراجعات غير مناسبة</li>
            <li style="margin-bottom: 10px;">يتم عرض متوسط التقييمات وعدد الطلبات المكتملة في ملف الفني الشخصي</li>
            <li style="margin-bottom: 10px;">يمكن للعملاء اختيار الفنيين بناءً على التقييم، الخبرة، الموقع، وحالة التحقق</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">11. التواصل من خلال المنصة</h2>
        <p style="margin-bottom: 15px;">
            لضمان الأمان والشفافية، يجب أن يتم جميع التواصل بين العملاء والفنيين من خلال المنصة فقط:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;"><strong>نظام المحادثة:</strong> يتم التواصل من خلال نظام المحادثة المدمج في المنصة</li>
            <li style="margin-bottom: 10px;"><strong>عدم التواصل المباشر:</strong> يحظر على العملاء والفنيين التواصل مباشرة خارج المنصة</li>
            <li style="margin-bottom: 10px;"><strong>حماية المعلومات:</strong> هذا يضمن حماية معلومات الاتصال الشخصية</li>
            <li style="margin-bottom: 10px;"><strong>سجل المحادثات:</strong> يتم حفظ سجل جميع المحادثات للمراجعة في حالة وجود نزاع</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">12. المسؤولية القانونية</h2>
        <p style="margin-bottom: 15px;">
            نحن نعمل كوسيط فقط ولا نتحمل المسؤولية عن:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">جودة الخدمات المقدمة من قبل الفنيين (نحن نتحقق من اعتماد الفنيين ولكن لا نضمن جودة كل خدمة)</li>
            <li style="margin-bottom: 10px;">الأضرار الناتجة عن سوء استخدام الخدمات</li>
            <li style="margin-bottom: 10px;">النزاعات المباشرة بين العملاء والفنيين (نوفر آلية لحل النزاعات)</li>
            <li style="margin-bottom: 10px;">أي خسائر مالية أو غير مالية ناتجة عن استخدام الخدمات</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">13. حل النزاعات</h2>
        <p style="margin-bottom: 15px;">
            في حالة وجود نزاع بين العميل والفني:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يجب التواصل مع فريق الدعم الفني للمنصة</li>
            <li style="margin-bottom: 10px;">سنقوم بالتحقيق في النزاع ومحاولة حله بشكل عادل</li>
            <li style="margin-bottom: 10px;">في حالة عدم التوصل لحل، يمكن اللجوء للقضاء</li>
            <li style="margin-bottom: 10px;">القوانين المعمول بها في المملكة العربية السعودية هي التي تحكم هذه الشروط</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">14. دعم التحول الرقمي ضمن رؤية المملكة 2030</h2>
        <p style="margin-bottom: 20px; padding: 15px; background-color: #e8f5e9; border-radius: 8px; border-right: 4px solid #4caf50;">
            <strong>التزامنا:</strong> منصة صيانة تك تساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم. نحن ملتزمون بدعم التحول الرقمي في المملكة العربية السعودية من خلال توفير منصة إلكترونية متكاملة تتيح للعملاء الوصول للخدمات بسهولة وتوفر للفنيين فرص عمل منظمة.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">15. التعديلات على الشروط</h2>
        <p style="margin-bottom: 20px;">
            نحتفظ بالحق في تعديل هذه الشروط والأحكام في أي وقت دون إشعار مسبق. سيتم إشعار المستخدمين بأي تغييرات جوهرية عبر الموقع أو البريد الإلكتروني. استمرار استخدامك للخدمات بعد التعديلات يعني موافقتك على الشروط المحدثة.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">16. الاتصال بنا</h2>
        <p style="margin-bottom: 15px;">
            إذا كان لديك أي أسئلة أو استفسارات حول هذه الشروط والأحكام، يرجى الاتصال بنا:
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
                باستخدام خدماتنا، فإنك تقر بأنك قد قرأت وفهمت ووافقت على الالتزام بهذه الشروط والأحكام
            </p>
            <p style="margin: 10px 0 0 0; font-size: 16px; opacity: 0.9;">
                شكراً لاختيارك منصة صيانة تك
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

        $metaData->meta_title = 'الشروط والأحكام - صيانة تك';
        $metaData->meta_tags = 'شروط وأحكام, صيانة تك, خدمات الصيانة';
        $metaData->meta_description = 'شروط وأحكام استخدام منصة صيانة تك لخدمات الصيانة والإصلاح والتركيب';
        $metaData->facebook_meta_tags = 'شروط وأحكام, صيانة تك';
        $metaData->facebook_meta_description = 'شروط وأحكام استخدام منصة صيانة تك';
        $metaData->twitter_meta_tags = 'شروط وأحكام, صيانة تك';
        $metaData->twitter_meta_description = 'شروط وأحكام استخدام منصة صيانة تك';

        $metaData->save();

        // Update static option to link this page (support both slugs)
        \App\StaticOption::updateOrCreate(
            ['option_name' => 'select_terms_condition_page'],
            ['option_value' => $page->slug]
        );
        
        // Also create/update the old slug page if it doesn't exist
        $oldPage = Page::where('slug', 'shorout-wa-al-ahkam')->where('id', '!=', $page->id)->first();
        if ($oldPage) {
            $oldPage->delete(); // Remove duplicate
        }

        $this->command->info('✓ Terms and Conditions page created/updated successfully!');
        $this->command->info('  Page URL: /' . $page->slug);
        $this->command->info('  Page Title: ' . $page->title);
    }
}

