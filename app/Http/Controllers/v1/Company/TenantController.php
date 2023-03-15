<?php

namespace App\Http\Controllers\v1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\storeTenantRequest;
use App\Http\Resources\v1\Company\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     *
     *  @OA\Get(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Компания"},
     *   path="/v1/company/tenants",
     *   summary="Получения списка всех компаний пользователя",
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="tenant", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.TenantResource")),
     *         @OA\Property(property="domain", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.DomainResource")),
     *     )
     *  ),
     *   @OA\Response(response=401, description="Не авторизован"),
     *   @OA\Response(response=403, description="Контент не доступен"),
     *   @OA\Response(response=404, description="Не найдено"),
     *   @OA\Response(response=422, description="Валидация формы"),
     *   @OA\Response(response=429, description="Бан запросов на 1 минуту"),
     *   @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function index()
    {
        return TenantResource::collection($this->tenantService->getList());
    }

    /**
     *
     *  @OA\Post(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Компания"},
     *   path="/v1/company/tenants",
     *   summary="Создание компании",
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса OTP верификации",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "name": "Revo",
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.TenantResource")),
     *     )
     *  ),
     *   @OA\Response(response=401, description="Не авторизован"),
     *   @OA\Response(response=403, description="Контент не доступен"),
     *   @OA\Response(response=404, description="Не найдено"),
     *   @OA\Response(response=422, description="Валидация формы"),
     *   @OA\Response(response=429, description="Бан запросов на 1 минуту"),
     *   @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function store(storeTenantRequest $request)
    {
        return new TenantResource($this->tenantService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return TenantResource
     */
    public function show($id)
    {
        return new TenantResource($this->tenantService->showById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return TenantResource
     */
    public function destroy($id)
    {
        return $this->tenantService->destroy($id);
    }
}
