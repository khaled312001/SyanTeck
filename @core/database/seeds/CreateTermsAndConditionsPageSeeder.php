<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Page;
use App\MetaData;
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
                مرحباً بك في منصة <strong>صيانة تك</strong>. يرجى قراءة هذه الشروط والأحكام بعناية قبل استخدام خدماتنا. باستخدام موقعنا وخدماتنا، فإنك توافق على الالتزام بهذه الشروط.
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
            <strong>صيانة تك</strong> هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نحن نعمل كوسيط بين العملاء والفنيين المعتمدين لتقديم الخدمات التالية:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">خدمات الصيانة المنزلية (كهرباء، سباكة، تكييف، دهان، ديكور)</li>
            <li style="margin-bottom: 10px;">خدمات الإصلاح والترميم</li>
            <li style="margin-bottom: 10px;">خدمات التركيب والتشطيب</li>
            <li style="margin-bottom: 10px;">خدمات الصيانة التقنية للأجهزة الإلكترونية</li>
            <li style="margin-bottom: 10px;">خدمات أخرى متعلقة بالصيانة والإصلاح</li>
        </ul>
        <p style="margin-bottom: 20px; padding: 15px; background-color: #fff3cd; border-radius: 8px; border-right: 4px solid #ffc107;">
            <strong>ملاحظة مهمة:</strong> نحن لا نقدم الخدمات مباشرة، بل نعمل كوسيط لربطك بالفنيين المعتمدين. العلاقة التعاقدية تكون مباشرة بينك وبين الفني.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">3. التسعير والدفع</h2>
        
        <h3 style="color: #1976D2; margin-top: 25px; margin-bottom: 15px; font-size: 20px;">3.1 آلية التسعير</h3>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">سيتم حساب سعر الصيانة أو الإصلاح أو التركيب <strong>بعد معاينة الفني</strong> للمشكلة في الموقع</li>
            <li style="margin-bottom: 10px;">السعر النهائي يعتمد على نوع الخدمة المطلوبة ومدى تعقيدها</li>
            <li style="margin-bottom: 10px;">سيقوم الفني بشرح التكلفة المقدرة قبل بدء العمل</li>
            <li style="margin-bottom: 10px;">يحق للعميل الموافقة أو رفض السعر المقترح</li>
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
            <li style="margin-bottom: 10px;">تقديم خدمة احترافية عالية الجودة</li>
            <li style="margin-bottom: 10px;">الوصول في الوقت المحدد أو إشعار العميل بأي تأخير</li>
            <li style="margin-bottom: 10px;">معاينة المشكلة بدقة وشرح الحل المقترح</li>
            <li style="margin-bottom: 10px;">تقديم سعر عادل وشفاف قبل بدء العمل</li>
            <li style="margin-bottom: 10px;">إتمام العمل بشكل صحيح وضمان جودة الخدمة</li>
            <li style="margin-bottom: 10px;">توفير ضمان مناسب حسب نوع الخدمة</li>
            <li style="margin-bottom: 10px;">الالتزام بمعايير السلامة والأمان</li>
            <li style="margin-bottom: 10px;">المحافظة على نظافة موقع العمل</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">5. مسؤوليات العميل</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">تقديم معلومات دقيقة وصحيحة عند طلب الخدمة (الاسم، رقم الهاتف، العنوان، وصف المشكلة)</li>
            <li style="margin-bottom: 10px;">توفير الوصول الكامل للموقع للمعاينة والإصلاح</li>
            <li style="margin-bottom: 10px;">توفير بيئة آمنة للفني للعمل</li>
            <li style="margin-bottom: 10px;">الالتزام بالموعد المحدد أو إشعار الفني بأي تغيير</li>
            <li style="margin-bottom: 10px;">فحص العمل المنجز قبل الدفع</li>
            <li style="margin-bottom: 10px;">الدفع بعد إتمام الخدمة والموافقة عليها</li>
            <li style="margin-bottom: 10px;">الاحتفاظ بإيصال الدفع كدليل على الخدمة المقدمة</li>
            <li style="margin-bottom: 10px;">التعامل مع الفني باحترام وأدب</li>
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
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">7. الضمان</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يتم تحديد فترة الضمان من قبل الفني حسب نوع الخدمة المقدمة</li>
            <li style="margin-bottom: 10px;">الضمان يغطي عيوب العمل والمواد المستخدمة (إن وجدت)</li>
            <li style="margin-bottom: 10px;">الضمان لا يغطي الأضرار الناتجة عن سوء الاستخدام أو الإهمال من قبل العميل</li>
            <li style="margin-bottom: 10px;">يجب على العميل الاحتفاظ بإيصال الدفع كدليل على الخدمة المقدمة والضمان</li>
            <li style="margin-bottom: 10px;">في حالة وجود مشكلة خلال فترة الضمان، يجب التواصل مع الفني مباشرة أو من خلال المنصة</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">8. الخصوصية وحماية البيانات</h2>
        <p style="margin-bottom: 20px;">
            نحن نلتزم بحماية خصوصية عملائنا ومعلوماتهم الشخصية. يتم استخدام المعلومات الشخصية فقط لتقديم الخدمات وتحسين تجربة المستخدم. لمزيد من التفاصيل حول كيفية جمع واستخدام وحماية معلوماتك، يرجى مراجعة <a href="/privacy-policy" style="color: #2196F3; text-decoration: underline;">سياسة الخصوصية</a>.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">9. التقييمات والمراجعات</h2>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يمكن للعملاء تقييم الفنيين وترك مراجعات بعد إتمام الخدمة</li>
            <li style="margin-bottom: 10px;">يجب أن تكون التقييمات صادقة وموضوعية</li>
            <li style="margin-bottom: 10px;">يحظر استخدام لغة مسيئة أو غير لائقة في المراجعات</li>
            <li style="margin-bottom: 10px;">نحتفظ بالحق في حذف أي مراجعات غير مناسبة</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">10. المسؤولية القانونية</h2>
        <p style="margin-bottom: 15px;">
            نحن نعمل كوسيط فقط ولا نتحمل المسؤولية عن:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">جودة الخدمات المقدمة من قبل الفنيين (نحن نتحقق من اعتماد الفنيين ولكن لا نضمن جودة كل خدمة)</li>
            <li style="margin-bottom: 10px;">الأضرار الناتجة عن سوء استخدام الخدمات</li>
            <li style="margin-bottom: 10px;">النزاعات المباشرة بين العملاء والفنيين (نوفر آلية لحل النزاعات)</li>
            <li style="margin-bottom: 10px;">أي خسائر مالية أو غير مالية ناتجة عن استخدام الخدمات</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">11. حل النزاعات</h2>
        <p style="margin-bottom: 15px;">
            في حالة وجود نزاع بين العميل والفني:
        </p>
        <ul style="margin-bottom: 20px; padding-right: 25px; list-style-type: disc;">
            <li style="margin-bottom: 10px;">يجب التواصل مع فريق الدعم الفني للمنصة</li>
            <li style="margin-bottom: 10px;">سنقوم بالتحقيق في النزاع ومحاولة حله بشكل عادل</li>
            <li style="margin-bottom: 10px;">في حالة عدم التوصل لحل، يمكن اللجوء للقضاء</li>
            <li style="margin-bottom: 10px;">القوانين المعمول بها في المملكة العربية السعودية هي التي تحكم هذه الشروط</li>
        </ul>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">12. التعديلات على الشروط</h2>
        <p style="margin-bottom: 20px;">
            نحتفظ بالحق في تعديل هذه الشروط والأحكام في أي وقت دون إشعار مسبق. سيتم إشعار المستخدمين بأي تغييرات جوهرية عبر الموقع أو البريد الإلكتروني. استمرار استخدامك للخدمات بعد التعديلات يعني موافقتك على الشروط المحدثة.
        </p>
        
        <h2 style="color: #2196F3; margin-top: 40px; margin-bottom: 20px; font-size: 26px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">13. الاتصال بنا</h2>
        <p style="margin-bottom: 15px;">
            إذا كان لديك أي أسئلة أو استفسارات حول هذه الشروط والأحكام، يرجى الاتصال بنا:
        </p>
        <div style="background-color: #f5f5f5; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <p style="margin-bottom: 10px;"><strong>منصة صيانة تك</strong></p>
            <p style="margin-bottom: 10px;">البريد الإلكتروني: info@syanteck.com</p>
            <p style="margin-bottom: 10px;">الهاتف: متاح على صفحة التواصل</p>
            <p style="margin: 0;">الموقع الإلكتروني: www.syanteck.com</p>
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

