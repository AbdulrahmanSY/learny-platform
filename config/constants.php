<?php
return [
    'teacher_statuses' => [
        'pending' => 'Pending',
        'pending_id' => '3',
        'accept' => 'Accept',
        'accept_id' => '1',
        'reject' => 'Reject',
        'reject_id' => '2',
    ],
    'appointments' => [
        'status_default' => 1, //waiting
        'paginate' => 5,
        'statuses'=>[
            'waiting_id'=>1,
            'rejected_id'=>2,
            'accepted_id'=>3
        ]
    ],
    'content' => [
        'paginate' => 4,
        'language_default' => 1,
        'category_default' => 1,
        'paragraph_category' => 1,
        'content_level_default' => 1,
        'post' => [
            'type_id' => 4,
        ]
    ],
    'roles'=>[
        'owner'=>'owner',
        'admin'=>'admin',
        'student'=>'student',
        'teacher'=>'teacher'
    ],
    'teacher'=>[
        'default_rating'=>'5'
    ],
    'panel'=>[
        'pagination'=>[
            'per_page'=>10
        ]
    ]

];
