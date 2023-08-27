<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $values = [
            [
                'about_us_ar' => '
مرحبا بكم في التعلم! نحن منصة لتعلم اللغة مصممة لمساعدة الأفراد على إتقان اللغات بفعالية وثقة. تقديم الطعام للمتعلمين من جميع المستويات ، من المبتدئين إلى المتحدثين المتقدمين.

في Learny ، ندرك أهمية إتقان اللغة في عالم اليوم المترابط. سواء كنت تتعلم لغة جديدة للسفر أو العمل أو النمو الشخصي ، فنحن هنا لدعمك في رحلة تعلم اللغة الخاصة بك. طور فريقنا من مدربي اللغة ذوي الخبرة دورات تفاعلية وجذابة تجمع بين النظرية والتطبيق والرؤى الثقافية.

مهمتنا هي تزويد المتعلمين بالأدوات والموارد التي يحتاجونها لتحقيق الطلاقة في لغتهم المستهدفة. نحن لا نركز فقط على القواعد والمفردات ولكن أيضًا على تطوير مهارات الاستماع والتحدث والقراءة. من خلال دروسنا المنسقة بعناية وتماريننا الغامرة ، نهدف إلى خلق بيئة تكرر سيناريوهات اللغة الواقعية',
                'about_us_en' => 'Welcome to learny! We are a language learning platform designed to help individuals master languages effectively and confidently. catering to learners of all levels, from beginners to advanced speakers.

At learny, we understand the importance of language proficiency in today s interconnected world. Whether you are learning a new language for travel, work, or personal growth, we are here to support you on your language learning journey. Our team of experienced language instructors has developed engaging and interactive courses that combine theory, practice, and cultural insights.

    Our mission is to provide learners with the tools and resources they need to achieve fluency in their target language. We focus not only on grammar and vocabulary but also on developing listening, speaking and reading skills. Through our carefully curated lessons and immersive exercises, we aim to create an environment that replicates real-life language scenarios',
                'terms_of_service_ar' => '

نشكرك على اختيارك التعلم كمنصة تعلم لغتك. من خلال الوصول إلى نظامنا الأساسي واستخدامه ، فإنك توافق على الامتثال لشروط الخدمة التالية. يرجى قراءتها بعناية قبل المتابعة:

1. تسجيل الحساب:
    - يجب ألا يقل عمرك عن 13 عامًا لإنشاء حساب على موقع Learny.
    - أنت مسؤول عن الحفاظ على سرية بيانات اعتماد حسابك.
    - يجب عليك تقديم معلومات دقيقة وحديثة أثناء عملية التسجيل.

2. سلوك المستخدم:
    - من المتوقع أن تنخرط في سلوك محترم ومناسب عند استخدام التعلم.
    - يُحظر تمامًا التحرش أو التمييز أو أي شكل من أشكال السلوك المسيء تجاه المستخدمين الآخرين.

3. الملكية الفكرية:
    - جميع مواد الدورة التدريبية والمحتوى المقدم على التعلم مملوكة للمتعلمين أو صانعي المحتوى.
    - لا يجوز لك إعادة إنتاج مواد الدورة التدريبية أو نسخها أو تعديلها دون إذن.

5. الخصوصية:
    - يحترم Learny خصوصيتك ويتعامل مع معلوماتك الشخصية وفقًا لسياسة الخصوصية الخاصة بنا.
    - باستخدام النظام الأساسي ، فإنك توافق على جمع واستخدام البيانات الخاصة بك على النحو المبين في سياسة الخصوصية',
                'terms_of_service_en' => 'Thank you for choosing learny as your language learning platform. By accessing and using our platform, you agree to comply with the following terms of service. Please read them carefully before proceeding:

1. Account Registration:
   - You must be at least 13 years old to create an account on learny.
   - You are responsible for maintaining the confidentiality of your account credentials.
   - You must provide accurate and up-to-date information during the registration process.

2. User Conduct:
   - You are expected to engage in respectful and appropriate behavior when using learny.
   - Harassment, discrimination, or any form of abusive conduct towards other users is strictly prohibited.

3. Intellectual Property:
   - All course materials and content provided on learny are owned by learny or its content creators.
   - You may not reproduce, copy, or modify the course materials without permission.

5. Privacy:
   - learny respects your privacy and handles your personal information in accordance with our Privacy Policy.
   - By using the platform, you consent to the collection and use of your data as outlined in the Privacy Policy'  ],


        ];
        DB::table('platform_information')->insert($values);
    }
}
