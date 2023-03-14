<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Tenant;
use App\Models\Tenant\User;
use App\Models\VerificationCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedById;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $tenancy = true;
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->artisan('passport:client --personal --name=revo');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */

    //create user and send OTP
    /*public function testSendOtp(){
        $data = [
            'phone' => '+998909101828',
        ];

        $this->withHeaders(['Accept'=>'application/json'])
            ->post('http://localhost/v1/profile/auth/code', $data)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'phone',
                    'first_name',
                    'last_name',
                    'is_active',
                ]
            ]);

        $this->artisan('migrate:fresh --env=testing');
    }

    //verifyOTP
    public function testVerifyOtp(){
        $this->assertInstanceOf(Employee::class, mockUser());
        $this->artisan('migrate:fresh --env=testing');
    }

    //show
    public function testGetUser(){
        $user = mockUser();

        $this->actingAs($user, 'api')
            ->json('get', 'http://localhost/v1/profile/employees/'.$user->id)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'phone',
                    'first_name',
                    'last_name',
                    'is_active',
                ]
            ]);

        $this->artisan('migrate:fresh --env=testing');
    }

    //update
    public function testUpdateUser(){
        $user = mockUser();

        $user = $this->actingAs($user, 'api')
            ->json('get', 'http://localhost/v1/profile/employees/'.$user->id)
            ->getOriginalContent();

        $dataToUpdate = [
            '_method' => 'PUT',
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
        ];

        $this->actingAs($user, 'api')
            ->json('post', 'http://localhost/v1/profile/employees/'.$user->id, $dataToUpdate)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'phone',
                    'first_name',
                    'last_name',
                    'is_active',
                ]
            ]);

        $this->artisan('migrate:fresh --env=testing');
    }

    //logout
    public function testUserLogout(){
        $user = mockUser();

        $token = $user->createToken('revo')->accessToken;

        \Auth::login($user);

        $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->json('post', 'http://localhost/v1/profile/employee/logout')
            ->assertSee('Logged out');

        $this->artisan('migrate:fresh --env=testing');
    }*/

    /**
     * @throws TenantCouldNotBeIdentifiedById
     */
    public function testUserInvitation(){
        $user = mockUser();

        $dataTenant = [
            'name' => substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 7)), 0, 7)
        ];

        $tenant = $this->actingAs($user, 'api')
            ->withHeaders(['Accept'=>'application/json'])
            ->post('http://localhost/v1/company/tenants', $dataTenant)
            ->content();

        $data = [
            'phone' => '+998909101828',
            'isa_active' => true
        ];

        $user = new User();

        tenant($tenant->id)->run(function () use($data, &$user){
            $user = User::create($data);
        });

        dd($user);



        $this->actingAs($user, 'api')
            ->json('post', 'http://'.tenancy()->tenant->getChanges()['slug'].'.localhost/v1/employee/invite', $data)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'phone',
                    'first_name',
                    'last_name',
                    'is_active',
                ]
            ]);

        $this->artisan('migrate:fresh --env=testing');
    }
}
