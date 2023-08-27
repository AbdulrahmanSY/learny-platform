<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BecomeTeacherTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_UserNotLogin(): void
    {
        $response = $this->post('/api/teacher/beTeacher', headers: ['Accept' => 'application/json', 'Content-type' => 'application/json']);

        $response->assertStatus(401);
    }

    public function test_TeacherRoleWithoutBody(): void
    {
        $user = User::find(2);

        $login = $this->post('/api/login', ['email' => $user->email, 'password' => '0000']);

        $access_token = json_decode($login->getContent())->data->access_token;
        $response = $this->post('/api/teacher/beTeacher', headers: ['Accept' => 'application/json', 'Content-type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token]);

        $response->assertStatus(403);
    }

    public function test_StudentRoleWithoutBody(): void
    {
        $user = User::find(3);

        $login = $this->post('/api/login', ['email' => $user->email, 'password' => '0000']);

        $access_token = json_decode($login->getContent())->data->access_token;
        $response = $this->post('/api/teacher/beTeacher', headers: ['Accept' => 'application/json', 'Content-type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token]);

        $response->assertStatus(400);
    }

    public function test_WithoutFirstName(): void
    {
        $user = User::find(3);

        $login = $this->post('/api/login', ['email' => $user->email, 'password' => '0000']);

        $access_token = json_decode($login->getContent())->data->access_token;
        $response = $this->post('/api/teacher/beTeacher'
            , [
                'info' => [
                    'father_name' => 'wael',
                    'last_name' => 'orabi',
                    'about'=>'info for teacher',
                    'teacher_description'=>'teacher description',
                    'video'=>'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAnIAAAJyCA',
                ],
                'card'=>[
                    'national_number'=>0000000000,
                    'front_card_image'=>'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAnIAAAJyCA',
                    'back_card_image'=>'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAnIAAAJyCA',
                ],
                'languages'=>[
                    [
                        'language_id'=>1,
                        'language_level_id'=>1,
                        'years_of_experience'=>5,
                        'certificates'=>[
                            'certificate_image'=>'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAnIAAAJyCA',
                            'certificate_date'=>2001-01-01,
                            'certificate_type_id'=>1,
                            'doner'=>[
                                'doner_type_id'=>1,
                                'doner_name'=>'test',
                                'country_id'=>1
                            ]
                        ]
                    ],
                ]
            ], headers: ['Accept' => 'application/json', 'Content-type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token]);

        $data = json_decode($response->getContent());
        $response->assertJson(
            [
                "message" => "Bad Request",
                "errors" => [
                    "info.first name مطلوب."
                ]
            ]
        );
    }
}
