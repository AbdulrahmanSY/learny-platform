<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation LanguageController Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => 'يجب قبول :attribute',
    'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون :attribute ًمصفوفة',
    'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date' => ':attribute ليس تاريخًا صحيحًا',
    'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا ',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists' => 'القيمة المحددة :attribute غير موجودة',
    'file' => 'الـ :attribute يجب أن يكون ملفا.',
    'filled' => ':attribute إجباري',
    'gt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت',
        'string' => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا',
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر',
    ],
    'image' => 'يجب أن تكون :attribute صورةً',
    'in' => ':attribute غير موجود',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'lt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت',
        'string' => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا',
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حرفًا',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حرفًا',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => ':values :يجب أن يكون ملفًا من نوع  .',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حرفًا',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا',
    ],
    'not_in' => ':attribute موجود',
    'not_regex' => 'صيغة :attribute غير صحيحة.',
    'numeric' => 'يجب على :attribute أن يكون رقمًا',
    'present' => 'يجب تقديم :attribute',
    'regex' => 'صيغة :attribute .غير صحيحة',
    'required' => ':attribute مطلوب.',
    'required_if' => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
    'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other',
    'size' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string' => 'يجب أن يحتوي النص :attribute على :size حرفًا بالضبط',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط',
    ],
    'string' => 'يجب أن يكون :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation LanguageController Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'appointment'=>[
            'not_found'=>'هذا الموعد غير موجود'
        ],
        'wrong' => 'حدث أمر خاطئ',
        'user' => [
            'not_found' => 'هذا المستخدم غير موجود'
        ],
        'admin' => [
            'assign_admin' => 'تم تعيين الآدمن بنجاح',
            'already_admin' => 'هذا المستخدم آدمن بالفعل'
        ],
        'day' => [
            'duplicated' => 'يوم غير مقبول، يوجد يوم بشكل متكرر',
        ],
        'time' => [
            'duplicated' => 'وقت غير مقبول، يوجد أوقات بشكل متكرر',
            'full_hour' => 'وقت غير مقبول، الوقت يجب أن يكون ساعة كاملة على الأقل',
            'hour_or_half' => 'وقت غير مقبول، الوقت يجب أن يكون إما [00:**] أو [30:**]'
        ],
        'accept_teacher' => [
            'accept' => [
                'title' => 'تهانينا!',
                'message' => 'تمت الموافقة عليك كمعلم في منصتنا',
                'response' => 'تم قبول المعلم بنجاح'
            ],
            'reject' => [
                'title' => 'للأسف!',
                'message' => 'طلبك كمعلم قد تم رفضه.',
                'response' => 'تم رفض المعلم بنجاح'
            ],
            'no_action' => 'الأستاذ المراد لا يوجد تأثير ممكن عليه'
        ],
        'teacher' => [
            'not_found' => 'لا يوجد معلم بهذا المعرف'
        ],
        'content' => [
            'question' => [
                'not_found' => 'لا يوجد سؤال!',
                'add' => '  تمت الاضافة بنجاح',
                'delete' => 'تم الحذف بنجاح',
                'permission' => 'لا تملك صلاحية',
                'answered' => "تمت الاجابة",
                'update_answered' => "تم تعديل الاجابة",
            ],
            'paragraph' => [
                'not_found' => 'لا يوجد مفالة!',
                'add' => '  تمت الاضافة بنجاح',
                'delete' => 'تم الحذف بنجاح',
                'permission' => 'لا تملك صلاحية',
                'appreciation' => "تمت  حفظ النسبة ",
                'update_appreciation' => "تم تعديل النسبة",
            ],
            'post' => [
                'not_found' => 'لا يوجد!',
                'add' => 'تمت الاضافة بنجاح',
                'delete' => 'تم الحذف بنجاح',
                'update' => 'تم تعديل',
                'permission' => "لا تملك صلاحية",

            ],
        ],
        'follow' => [
            'follow' => 'متابعة',
            'cancel_follow' => '  الغاء المتابعة',
            'get_teacher' => ' لا يوجد  استاذة تم متابعتها ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'username' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'first_name' => 'الاسم الأول',
        'last_name' => 'اسم العائلة',
        'password' => 'كلمة السر',
        'password_confirmation' => 'تأكيد كلمة السر',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'عنوان السكن',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'العنوان',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',
        'phone_number' => 'رقم الهاتف',
        'birth_date' => 'تاريخ الميلاد',
        'Y_m_d' => 'سنة_شهر_يوم',
        'video' => 'الفيديو التعريفي',
        'teaching_description' => 'وصف المعلم',
        'years_of_experience' => 'عدد سنوات الخبرة ',
        'national_number' => 'الرقم الوطني',
        'front_card_image' => 'الصورة الامامية للهوية',
        'back_card_image' => 'الصورة الخلفية للهوية',
        'dateformat' => 'سنة_شهر_يوم',
        'min_digits' => ':min_digits رقمًا',
        'about' => 'النص ',
        'teacher_id' => 'معرف الاستاذ',
        'language_id' => 'معرف اللغة',
        'language_level_id' => 'معرف مستوى اللغة',
        'certificate_date' => 'تاريخ الشهادة',
        'certificate_image' => 'صورة الشهادة',
        'certificate_type_id' => 'معرف نوع الشهادة',
        'doner_id' => 'معرف الجهة المانحة لشهادة',
        'doner_name' => 'اسم الجهة المانحة',
        'doner_type_id' => 'معرف نوع الجهة المانحة',
        'country_id' => 'معرف الدولة',
        'country_name' => 'اسم الدولة',
        'teacher_language_id' => 'معرف لغة المعلم',
        'working_days.*.working_times.*.end' => 'وقت الانتهاء',
        'working_days.*.working_times.*.first' => 'وقت البداية',
        'working_days.*.working_times' => 'أوقات العمل',
        'working_days' => 'أيام العمل',
        'working_days.*.day_id' => 'يوم العمل'
    ],
];
