<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$allowedLangs = ['ar','en'];

if(isset($_GET['lang']) && in_array($_GET['lang'], $allowedLangs,true)){
    $_SESSION['site_lang'] = $_GET['lang'];
}

$lang = $_SESSION['site_lang'] ?? 'ar';


$translations = [

'ar'=>[

'dir'=>'rtl',
'lang_code'=>'ar',


/* General */

'clinic_name'=>'عيادة الدكتورة نادين عطاري لتقويم الأسنان وطب الأسنان',
'home'=>'الرئيسية',
'about'=>'عن الدكتورة',
'services'=>'خدمات العيادة',
'gallery'=>'الحالات',
'reviews'=>'تقييمات المرضى',
'certificates'=>'الشهادات',
'location'=>'موقع العيادة',
'contact'=>'تواصل معنا',
'booking'=>'احجز موعد',
'articles'=>'المقالات',
'clinic_articles'=>'مقالات العيادة',
'articles_intro'=>'معلومات ونصائح موثوقة للعناية بصحة الأسنان وتقويم الأسنان والابتسامة.',
'no_articles_available'=>'لا توجد مقالات حاليًا',
'check_back_for_articles'=>'سيتم نشر مقالات ونصائح جديدة قريبًا.',


/* Hero */

'hero_title'=>'ابتسامة صحية تبدأ برعاية متخصصة',

'hero_description'=>
'أهلًا وسهلًا بكم في عيادة د. نادين عطاري لتقويم الأسنان وطب الأسنان في عمّان، الأردن.
نقدّم رعاية متخصصة في تقويم الأسنان، وتجميل الابتسامة، إلى جانب مجموعة متكاملة من علاجات الأسنان مثل التنظيف، التبييض، التركيبات، الفينيير، زراعة الأسنان، وعلاج أسنان الأطفال.

كما نوفر خدمات التجميل الوجهي غير الجراحي لتعزيز جمال وتناسق الملامح بطريقة طبيعية وآمنة. هدفنا تقديم تجربة علاجية مريحة وواضحة مبنية على الثقة، للحصول على ابتسامة صحية وجميلة.',


'whatsapp'=>'واتساب',

'call'=>'اتصال',

'instagram'=>'إنستغرام',

'doctor_badge_name'=>'الدكتورة نادين عطاري',
'doctor_badge_specialty'=>'طبيبة تقويم أسنان',

/* About */

'welcome_title'=>'أهلاً وسهلاً بكم في عيادة د. نادين عطاري',

'welcome_description'=>
'في عيادتنا نؤمن أن الابتسامة الصحية والجميلة تبدأ من رعاية دقيقة، تعامل لطيف، وخطة علاجية تناسب كل مريض حسب احتياجاته.',


'about_title'=>'عن الدكتورة نادين عطاري',

'about_description'=>
'الدكتورة نادين عطاري أخصائية تقويم أسنان في عمّان، الأردن، متخصصة في تقويم الأسنان، تصحيح الإطباق، وتحسين تناسق الابتسامة للأطفال والبالغين.',

'doctor_name'=>'الدكتورة نادين عطاري',

'doctor_specialty'=>'أخصائية تقويم الأسنان والفكين',

// 'about_description_2'=>
// 'حاصلة على درجة الماجستير في تقويم الأسنان والفكين من الجامعة الأردنية، والبورد الأردني في تقويم الأسنان وعضوية الكلية الملكية للجراحين في إيرلندا.',


'about_description_3'=>
'تقدم علاجاً متكاملاً يجمع بين صحة الأسنان، جمال الابتسامة، وتناسق ملامح الوجه بطريقة طبيعية وآمنة.',


/* Certificates */

'certificates_title'=>'الشهادات والمؤهلات',

'certificate_1'=>
'درجة الماجستير في تقويم الأسنان والفكين من الجامعة الأردنية',

'certificate_2'=>
'البورد الأردني في تقويم الأسنان والفكين',

'certificate_3'=>
'درجة دكتور في طب وجراحة الأسنان من الجامعة الأردنية',

'certificate_4'=>
'عضوية الكلية الملكية للجراحين في إيرلندا',

'certificate_5'=>
'تجميل الوجه غير الجراحي',


'orthodontics'=>'تقويم الأسنان',

'metal_braces'=>'التقويم المعدني',

'clear_aligners'=>'التقويم الشفاف',

'functional_appliances'=>'التقويم الوظيفي',

'retainers'=>'المثبتات بعد التقويم',

'cleaning'=>'تنظيف الأسنان والعناية باللثة',

'whitening'=>'تبييض الأسنان',

'veneers'=>'الفينيير',

'crowns'=>'تركيبات الأسنان',

'implants'=>'زراعة الأسنان',

'fillings'=>'حشوات الأسنان التجميلية',

'pediatric'=>'علاج أسنان الأطفال',

'facial_aesthetics'=>'تجميل الوجه غير الجراحي',


/* Services */

'services_title'=>'خدمات العيادة',

'services_description'=>'نقدم مجموعة متكاملة من خدمات طب الأسنان وتقويم الأسنان بأحدث التقنيات وبأعلى معايير الجودة.',


'orthodontics_desc'=>'تقويم الأسنان للأطفال والبالغين بهدف تحسين ترتيب الأسنان، تصحيح الإطباق، وتحسين تناسق الابتسامة.',


'metal_braces_desc'=>'من أكثر أنواع التقويم استخداماً، ويعتمد على حاصرات معدنية تثبت على الأسنان لتحريكها تدريجياً إلى الوضع الصحيح.',


'clear_aligners_desc'=>'تقويم شفاف يعتمد على قوالب شفافة مصممة خصيصاً لتحريك الأسنان تدريجياً مع الحفاظ على مظهر طبيعي أثناء فترة العلاج.',


'functional_appliances_desc'=>'يستخدم أثناء مراحل النمو عند الأطفال واليافعين للمساعدة في توجيه نمو الفكين وتحسين العلاقة بينهما.',


'retainers_desc'=>'تستخدم بعد إزالة التقويم للحفاظ على ترتيب الأسنان، وقد تكون ثابتة أو متحركة حسب حاجة المريض.',


'cleaning_desc'=>'يساعد تنظيف الأسنان الدوري على إزالة الترسبات والجير، الحفاظ على صحة اللثة، تقليل رائحة الفم، والوقاية من مشاكل
الأسنان واللثة.',


'whitening_desc'=>'تبييض الأسنان لتحسين لون الأسنان ومنح الابتسامة مظهراً أكثر إشراقاً حسب حالة الأسنان ودرجة التصبغات.',


'veneers_desc'=>'قشور تجميلية رقيقة تستخدم لتحسين شكل الأسنان ولونها وحجمها وإغلاق الفراغات البسيطة للحصول على ابتسامة متناسقة وطبيعية.',


'crowns_desc'=>'تركيبات الأسنان مثل التيجان والجسور تساعد على تعويض الأسنان المتضررة أو المفقودة وتحسين الشكل والوظيفة.',


'implants_desc'=>'حل ثابت لتعويض الأسنان المفقودة من خلال وضع زرعة داخل العظم ثم تركيب السن فوقها لاستعادة الشكل والوظيفة, والثقة أثناء االبتسام والمضغ.',


'fillings_desc'=>'حشوات تجميلية لعلاج التسوس أو ترميم الأسنان المتضررة مع الحفاظ على مظهر قريب من لون الأسنان الطبيعي.',


'pediatric_desc'=>'عناية لطيفة ومريحة بأسنان الأطفال تشمل الفحص الدوري، التنظيف، علاج التسوس، والمتابعة الوقائية, وتقييم الحاجة للتقويم في عمر مبكر.',


'facial_aesthetics_desc'=>'خدمات تجميل الوجه غير الجراحي لتحسين تناسق ملامح الوجه بطريقة طبيعية وآمنة بما ينسجم مع الابتسامة وشكل الوجه العام.',
/* Location */

'location_title'=>'موقع العيادة',

'phone'=>'رقم الهاتف',

'whatsapp'=>'واتساب',

'instagram'=>'إنستغرام',

'working_hours'=>'ساعات عمل العيادة',

'working_time'=>'السبت إلى الخميس من 10:00 صباحاً إلى 8:00 مساءً',


'clinic_address'=>'الشميساني، خلف المستشفى التخصصي، مجمع الرياض الطبي، الطابق الاول',
'working_time'=>'السبت إلى الخميس من 10:00 صباحاً إلى 8:00 مساءً',

/* Footer */

'follow_us'=>'تابعنا على مواقع التواصل الاجتماعي',

'facebook'=>'فيسبوك',

'rights'=>'جميع الحقوق محفوظة لدى عيادة د. نادين عطاري',


'reviews_title'=>'آراء المرضى',

'google_reviews'=>'عرض جميع التقييمات على Google',

'write_review'=>'شاركنا تجربتك',

'footer_description'=>'عيادة متخصصة في تقويم الأسنان وطب الأسنان نقدم رعاية متكاملة بابتسامة صحية وثقة.',

'footer_links'=>'روابط الصفحات',

'follow_us'=>'تابعنا على مواقع التواصل الاجتماعي',

'powered_by'=>'Powered by',

'clinic_owner'=>'الدكتورة نادين عطاري',

'cases'=>'الحالات',

'reviews'=>'تقييمات المرضى',

// admin panel

'admin_panel'=>'لوحة التحكم',
'logout'=>'تسجيل الخروج',
'language'=>'English',
'dashboard'=>'لوحة التحكم المسؤول',
'gallery'=>' الحالات',
'reviews'=>'تقييمات المرضى',
'messages'=>'الرسائل',
'cases'=>'الحالات',
'articles_management'=>'إدارة المقالات',
'content_management'=>'إدارة المحتوى',
'articles_management_description'=>'أضف المقالات بالعربية والإنجليزية وتحكم بالمحتوى المنشور.',
'published_articles'=>'مقالة منشورة',
'add_new_article'=>'إضافة مقالة جديدة',
'fill_both_languages'=>'أدخل عنوان ومحتوى المقالة باللغتين لضمان ظهورها الصحيح عند تبديل اللغة.',
'article_title_ar'=>'عنوان المقالة بالعربية',
'article_title_en'=>'Article title in English',
'article_content_ar'=>'محتوى المقالة بالعربية',
'article_content_en'=>'Article content in English',
'article_title_ar_placeholder'=>'اكتب عنوان المقالة بالعربية',
'article_title_en_placeholder'=>'Write the article title in English',
'article_content_ar_placeholder'=>'اكتب محتوى المقالة بالعربية...',
'article_content_en_placeholder'=>'Write the article content in English...',
'article_image'=>'صورة المقالة',
'article_image_hint'=>'JPG أو PNG أو WEBP — الحد الأقصى 5 MB',
'publish_article'=>'نشر المقالة',
'existing_articles'=>'المقالات الحالية',
'manage_existing_articles'=>'معاينة المقالات المنشورة وحذف أي مقالة عند الحاجة.',
'no_articles_yet'=>'لا توجد مقالات حتى الآن',
'no_articles_description'=>'أضف أول مقالة باستخدام النموذج الموجود في الأعلى.',
'delete_article'=>'حذف المقالة',
'confirm_delete_article'=>'هل أنت متأكد من حذف هذه المقالة؟ لا يمكن التراجع عن العملية.',
'article_added_successfully'=>'تمت إضافة المقالة بنجاح.',
'article_deleted_successfully'=>'تم حذف المقالة بنجاح.',
'article_not_found'=>'المقالة المطلوبة غير موجودة.',
'article_save_failed'=>'تعذر حفظ المقالة. يرجى المحاولة مرة أخرى.',
'all_article_fields_required'=>'يرجى تعبئة العنوان والمحتوى باللغتين العربية والإنجليزية.',
'image_upload_failed'=>'حدث خطأ أثناء رفع الصورة.',
'image_too_large'=>'حجم الصورة أكبر من 5 MB.',
'invalid_image_type'=>'نوع الصورة غير مدعوم. استخدم JPG أو PNG أو WEBP.',
'invalid_request'=>'الطلب غير صالح. يرجى إعادة المحاولة.',

'language'=>'English'

],



'en'=>[

'dir'=>'ltr',
'lang_code'=>'en',


/* General */

'clinic_name'=>'Dr. Nadeen Attari Orthodontic and Dental Clinic',

'home'=>'Home',
'about'=>'About Dr. Nadeen',
'services'=>'Services',
'gallery'=>'Cases',
'reviews'=>'Reviews',
'certificates'=>'Certificates',
'location'=>'Clinic Location',
'contact'=>'Contact Us',
'booking'=>'Book Appointment',
'articles'=>'Articles',
'clinic_articles'=>'Clinic Articles',
'articles_intro'=>'Trusted information and practical guidance for dental health, orthodontics, and confident smiles.',
'no_articles_available'=>'No articles available yet',
'check_back_for_articles'=>'New articles and dental tips will be published soon.',



/* Hero */

'hero_title'=>'A Healthy Smile Starts With Expert Care',

'hero_description'=>
'Welcome to Dr. Nadeen Attari Orthodontic and Dental Clinic in Amman, Jordan.
We provide specialized orthodontic care and comprehensive dental treatments, including cleaning, whitening, veneers, implants, children’s dentistry, and cosmetic care.

Our clinic also offers non-surgical facial aesthetics to enhance natural facial balance. We are committed to providing a comfortable, professional experience built on trust.',


'whatsapp'=>'WhatsApp',

'call'=>'Call',

'instagram'=>'Instagram',

'doctor_badge_name'=>'Dr. Nadeen Attari',
'doctor_badge_specialty'=>'Orthodontist',

/* About */

'welcome_title'=>'Welcome to Dr. Nadeen Attari Orthodontic and Dental Clinic',

'welcome_description'=>
'We believe that a healthy and confident smile starts with precise care, gentle treatment, and a personalized plan designed for every patient.',


'about_title'=>'About Dr. Nadeen Attari',

'about_description'=>
'Dr. Nadeen Attari is a specialist orthodontist in Amman, Jordan, focused on orthodontic treatment, bite correction, and improving smile harmony for children and adults.',

'doctor_name'=>'Dr. Nadeen Attari',

'doctor_specialty'=>'Specialist Orthodontist',

// 'about_description_2'=>
// 'She holds a Master’s degree in Orthodontics and Dentofacial Orthopedics from the University of Jordan, Jordanian Board in Orthodontics, and membership of the Royal College of Surgeons in Ireland.',


'about_description_3'=>
'Providing comprehensive care combining oral health, smile aesthetics, and facial harmony in a natural and safe way.',


/* Certificates */

'certificates_title'=>'Certificates & Qualifications',

'certificate_1'=>
'Master’s Degree in Orthodontics and Dentofacial Orthopedics from the University of Jordan',

'certificate_2'=>
'Jordanian Board in Orthodontics and Dentofacial Orthopedics',

'certificate_3'=>
'Doctor of Dental Surgery Degree from the University of Jordan',

'certificate_4'=>
'Membership of the Royal College of Surgeons in Ireland',

'certificate_5'=>
'Certified in Non-Surgical Facial Aesthetics',




'orthodontics'=>'Orthodontics',

'metal_braces'=>'Metal Braces',

'clear_aligners'=>'Clear Aligners',

'functional_appliances'=>'Functional Appliances',

'retainers'=>'Retainers After Braces',

'cleaning'=>'Professional Dental Cleaning and Gum Care',

'whitening'=>'Teeth Whitening',

'veneers'=>'Veneers',

'crowns'=>'Dental Crowns and Bridges',

'implants'=>'Dental Implants',

'fillings'=>'Cosmetic Dental Fillings',

'pediatric'=>'Pediatric Dentistry',

'facial_aesthetics'=>'Non-Surgical Facial Aesthetics',



/* Services */

'services_title'=>'Clinic Services',

'services_description'=>'We provide comprehensive dental and orthodontic services using modern techniques and high-quality care.',


'orthodontics_desc'=>'Orthodontic treatment for children and adults helps improve teeth alignment, correct bite problems, and create a balanced smile.',


'metal_braces_desc'=>'One of the most commonly used orthodontic treatments, using metal brackets to gradually move teeth into the correct position.',


'clear_aligners_desc'=>'A discreet treatment using custom-made clear trays to gradually move teeth while maintaining a natural appearance.',


'functional_appliances_desc'=>'Used during growth stages in children and teenagers to guide jaw development and improve jaw relationship.',


'retainers_desc'=>'Used after orthodontic treatment to maintain the new position of teeth and prevent relapse.',


'cleaning_desc'=>'Professional dental cleaning removes plaque and tartar, maintains gum health, and prevents dental problems.',


'whitening_desc'=>'Teeth whitening improves tooth color and provides a brighter smile based on tooth condition and staining level.',


'veneers_desc'=>'Thin cosmetic shells used to improve tooth shape, color, size, and minor gaps for a natural smile.',


'crowns_desc'=>'Dental crowns and bridges restore damaged or missing teeth and improve appearance and function.',


'implants_desc'=>'A fixed solution for replacing missing teeth by placing an implant inside the bone and restoring the tooth later.',


'fillings_desc'=>'Cosmetic fillings treat cavities and restore damaged teeth while maintaining a natural tooth-colored appearance.',


'pediatric_desc'=>'Gentle dental care for children including check-ups, cleaning, cavity treatment, and preventive follow-up.',


'facial_aesthetics_desc'=>'Non-surgical facial aesthetics services that enhance facial harmony naturally and safely.',

/* Location */

'location_title'=>'Clinic Location',

'phone'=>'Phone',

'whatsapp'=>'WhatsApp',

'instagram'=>'Instagram',

'working_hours'=>'Working Hours',

'working_time'=>'Saturday to Thursday from 10:00 AM to 8:00 PM',

'clinic_address'=>'Hunayn Bin Ishak St, Amman',
'working_time'=>'Saturday to Thursday from 10:00 AM to 8:00 PM',

/* Footer */

'follow_us'=>'Follow us on social media',

'facebook'=>'Facebook',

'rights'=>'All rights reserved to Dr. Nadeen Attari Clinic',

'reviews_title'=>'Patient Reviews',

'google_reviews'=>'View All Reviews on Google',

'write_review'=>'Share Your Experience',

'footer_description'=>'A specialized orthodontic and dental clinic providing comprehensive dental care with healthy confident smiles.',

'footer_links'=>'Quick Links',

'follow_us'=>'Follow Us',

'powered_by'=>'Powered by',

'clinic_owner'=>'Dr. Nadeen Attari',

'cases'=>'Cases',

'reviews'=>'Reviews',

// admin panel
'admin_panel'=>'Admin Dashboard',
'logout'=>'Logout',
'language'=>'العربية',
'dashboard'=>'Admin dashboard',
'gallery'=>'Gallery',
'reviews'=>'Reviews',
'messages'=>'Messages',
'cases'=>'Cases',
'articles_management'=>'Articles Management',
'content_management'=>'Content Management',
'articles_management_description'=>'Create bilingual articles and manage the content published on the website.',
'published_articles'=>'Published Articles',
'add_new_article'=>'Add New Article',
'fill_both_languages'=>'Enter the article title and content in both languages so it displays correctly after switching language.',
'article_title_ar'=>'Arabic Article Title',
'article_title_en'=>'Article Title in English',
'article_content_ar'=>'Arabic Article Content',
'article_content_en'=>'Article Content in English',
'article_title_ar_placeholder'=>'اكتب عنوان المقالة بالعربية',
'article_title_en_placeholder'=>'Write the article title in English',
'article_content_ar_placeholder'=>'اكتب محتوى المقالة بالعربية...',
'article_content_en_placeholder'=>'Write the article content in English...',
'article_image'=>'Article Image',
'article_image_hint'=>'JPG, PNG, or WEBP — maximum size 5 MB',
'publish_article'=>'Publish Article',
'existing_articles'=>'Existing Articles',
'manage_existing_articles'=>'Preview published articles and delete any article when needed.',
'no_articles_yet'=>'No articles yet',
'no_articles_description'=>'Create the first article using the form above.',
'delete_article'=>'Delete Article',
'confirm_delete_article'=>'Are you sure you want to delete this article? This action cannot be undone.',
'article_added_successfully'=>'The article was added successfully.',
'article_deleted_successfully'=>'The article was deleted successfully.',
'article_not_found'=>'The requested article was not found.',
'article_save_failed'=>'The article could not be saved. Please try again.',
'all_article_fields_required'=>'Please complete the title and content in both Arabic and English.',
'image_upload_failed'=>'An error occurred while uploading the image.',
'image_too_large'=>'The image is larger than 5 MB.',
'invalid_image_type'=>'Unsupported image type. Use JPG, PNG, or WEBP.',
'invalid_request'=>'Invalid request. Please try again.',

'language'=>'العربية'

]

];



function t($key){

    global $translations,$lang;

    return $translations[$lang][$key] ?? $key;

}



// function switch_lang_url($targetLang){

//     $params=$_GET;

//     $params['lang']=$targetLang;

//     $query=http_build_query($params);

//     $path=strtok($_SERVER["REQUEST_URI"],'?');

//     return $path.'?'.$query;

// }

if(!function_exists('switch_lang_url')){


function switch_lang_url($targetLang){


    $currentUrl = $_SERVER['REQUEST_URI'];


    $currentUrl = preg_replace(
        '/([&?])lang=[^&]*(&?)/',
        '$1',
        $currentUrl
    );


    $currentUrl = rtrim($currentUrl,'?&');


    if(strpos($currentUrl,'?') !== false){

        return $currentUrl.'&lang='.$targetLang;

    }


    return $currentUrl.'?lang='.$targetLang;


}


}

?>