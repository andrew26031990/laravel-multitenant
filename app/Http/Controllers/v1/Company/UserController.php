<?php

namespace App\Http\Controllers\v1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\storeUserRequest;
use App\Http\Requests\v1\Company\updateUserRequest;
use App\Http\Resources\v1\Profile\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Пользователь компании"},
     *   path="/v1/company/users",
     *   summary="Получение всех пользователей компании",
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
        return UserResource::collection($this->userService->getList());
    }

    /**
     *
     *  @OA\Post(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Пользователь компании"},
     *   path="/v1/company/users",
     *   summary="Добавление пользователя в компанию",
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса на добавление пользователя в компанию",
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
    public function store(storeUserRequest $request)
    {
        return new UserResource($this->userService->store($request->validated()));
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Пользователь компании"},
     *   path="/v1/company/users/{id}",
     *   summary="Получение информации о пользователе в компании",
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
        return new UserResource($this->userService->showById($id));
    }

    /**
     *
     *  @OA\Put(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Пользователь компании"},
     *   path="/v1/company/users/{id}",
     *   summary="Обновление информации о пользователе компании",
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
        return new UserResource($this->userService->update($request->validated(), $id));
    }

    /**
     *
     *  @OA\Delete(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Пользователь компании"},
     *   path="/v1/company/users/{id}",
     *   summary="Удаление пользователя из компании",
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
        return new UserResource($this->userService->destroy($id));
    }
}
