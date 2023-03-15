<?php

namespace App\Http\Controllers\v1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\updateUserRequest;
use App\Http\Resources\v1\Profile\UserResource;
use App\Services\CentralUserService;

class CentralUserController extends Controller
{
    public CentralUserService $employeeService;
    public function __construct(CentralUserService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Центральный пользователь"},
     *   path="/v1/profile/users",
     *   summary="Получение всех центральных пользователей системы",
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
    public function index()
    {
        return UserResource::collection($this->employeeService->getList());
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Центральный пользователь"},
     *   path="/v1/profile/users/{id}",
     *   summary="Получение информации о центральном пользователе системы",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *      ),
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
    public function show($id)
    {
        return new UserResource($this->employeeService->showById($id));
    }

    /**
     *
     *  @OA\Put(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Центральный пользователь"},
     *   path="/v1/profile/users/{id}",
     *   summary="Обновление информации о центральном пользователе системы",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса для обновления данных пользователя",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "first_name": "Vasya",
     *	           "last_name": "Pupkin",
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

    public function update(updateUserRequest $request, $id)
    {
        return new UserResource($this->employeeService->update($request->validated(), $id));
    }

    /**
     *
     *  @OA\Delete(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Центральный пользователь"},
     *   path="/v1/profile/users/{id}",
     *   summary="Удаление центрального пользователя",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *      ),
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
    public function destroy($id)
    {
        return $this->employeeService->destroy($id);
    }
}
