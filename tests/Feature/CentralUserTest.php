<?php

namespace Tests\Feature;
define('host', env('DOMAIN', 'localhost'));

use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\Tenant\User;
use App\Models\VerificationCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedById;
use Tests\TestCase;

class CentralUserTest extends TestCase
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
    public function testSendOtp(){
        $data = [
            'phone' => '+998909101828',
        ];

        $this->withHeaders(['Accept'=>'application/json'])
            ->post('http://'.host.'/v1/profile/auth/code', $data)
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
        $this->assertInstanceOf(CentralUser::class, mockUser());
        $this->artisan('migrate:fresh --env=testing');
    }

    //logout
    public function testUserLogout()
    {
        $user = mockUser();
        $token = $user->createToken('revo')->accessToken;

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->json('post', 'http://' . host . '/v1/profile/auth/logout')
            ->assertSee('Logged out');

        $this->artisan('migrate:fresh --env=testing');
    }
}