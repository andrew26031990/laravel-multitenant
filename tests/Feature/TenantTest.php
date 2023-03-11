<?php

namespace Tests\Feature;

use App\Models\Tenant;
use Database\Factories\TenantFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\CreatesApplication;
use Tests\TestCase;

class TenantTest extends TestCase
{
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
    /*public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    /*public function testUser(){
        dd(mockUser()->access->accessToken);
    }*/

    //index
    public function testGetTenants()
    {
        $user = mockUser();
        $data = [
            'name' => Str::random(10)
        ];

        $this->actingAs($user, 'api')->withHeaders(['Accept'=>'application/json'])->post('http://localhost/v1/company/tenants', $data)->content();
        $this->actingAs($user, 'api')
            ->json('get', 'http://localhost/v1/company/tenants')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                         'name',
                          'slug'
                    ]
                ]
            ]);
    }


    //store
    /*public function testCreateTenant()
    {
        $data = [
            'name' => fake()->firstName
        ];

        \DB::beginTransaction();
        try {
            $this->actingAs(mockUser(), 'api')
                ->json('post', 'http://localhost/v1/company/tenants', $data)
                ->assertJsonStructure([
                    'name',
                    'slug'
                ]);
            \DB::commit();
        }catch (\Exception $exception){
            \DB::rollback();
        }
    }*/

    /*public function testGetSingleTenant()
    {
        $data = [
            'name' => fake()->firstName
        ];

        $user = mockUser();

        DB::transaction(function () use($user, $data){
            dd($this->actingAs($user, 'api')
                ->json('post', 'http://localhost/v1/company/tenants', $data)->content());
        });

        dd('$tenant');

        $this->actingAs($user, 'api')
            ->json('get', 'http://localhost/v1/company/tenants/'.$tenant->id)
            ->assertJsonStructure([
                'name',
                'slug'
            ]);
    }

    public function getDeleteTenant()
    {
        $tenantName = \Str::random(10);
        $tenant = Tenant::create(
            [
                'name' => $tenantName,
                'slug' => Str::slug($tenantName)
            ]
        );
        $result = app(TenantService::class)->destroy($tenant->id);
        $this->assertTrue($result);
    }

    public function testDatabaseCreatedAfterTenantWasCreated(){
        $tenantName = \Str::random(10);
        $tenant = Tenant::create(
            [
                'name' => $tenantName,
                'slug' => Str::slug($tenantName)
            ]
        );
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, ['tenant_'.$tenant->id.'_db']);
        if (empty($db)) {
            $this->assertTrue(true);
        } else {
            $this->assertFalse(false);
        }
    }*/

}
