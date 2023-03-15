<?php

namespace App\Http\Controllers\v1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Profile\getCodeRequest;
use App\Http\Requests\v1\Profile\verifyCodeRequest;
use App\Http\Resources\v1\Profile\UserResource;
use App\Services\CentralUserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public CentralUserService $employeeService;
    public function __construct(CentralUserService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     *
     *  @OA\Post(
     *   tags={"Аутентификация"},
     *   path="/v1/profile/auth/code",
     *   summary="Запрос на получение OTP кода",
     *   @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса OTP аутентификации",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "phone": "+998909101828",
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Profile.UserResource")),
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
    public function getCode(getCodeRequest $request)
    {
        return new UserResource($this->employeeService->sendOtp($request->validated()));
    }

    /**
     *
     *  @OA\Post(
     *   tags={"Аутентификация"},
     *   path="/v1/profile/auth/verify",
     *   summary="Запрос на верификацию OTP кода",
     *   @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса OTP верификации",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "phone": "+998909101828",
     *	           "otp": "789456",
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Profile.UserResource")),
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
    public function verifyCode(verifyCodeRequest $request)
    {
        return new UserResource($this->employeeService->verifyOtp($request->validated()));
    }

    /**
     *
     *  @OA\Post(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Аутентификация"},
     *   path="/v1/profile/auth/logout",
     *   summary="Запрос на выход из системы",
     *   @OA\Response(
     *     response=200,
     *     description="",
     *  ),
     *   @OA\Response(response=401, description="Не авторизован"),
     *   @OA\Response(response=403, description="Контент не доступен"),
     *   @OA\Response(response=404, description="Не найдено"),
     *   @OA\Response(response=422, description="Валидация формы"),
     *   @OA\Response(response=429, description="Бан запросов на 1 минуту"),
     *   @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function logout(){
        return $this->employeeService->logout();
    }
}
