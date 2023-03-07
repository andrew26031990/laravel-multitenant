<?php

namespace App\Http\Controllers\v1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Profile\updateEmployeeRequest;
use App\Http\Resources\v1\Profile\EmployeeResource;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public EmployeeService $employeeService;
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // privet
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Пользователь"},
     *   path="/v1/profile/employees/{id}",
     *   summary="Получение информации о пользователе",
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
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Profile.EmployeeResource")),
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
        return new EmployeeResource($this->employeeService->showById($id));
    }

    /**
     *
     *  @OA\Put(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Пользователь"},
     *   path="/v1/profile/employees/{id}",
     *   summary="Обновление информации о пользователе",
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
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Profile.EmployeeResource")),
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

    public function update(updateEmployeeRequest $request, $id)
    {
        return new EmployeeResource($this->employeeService->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     *  @OA\Post(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Пользователь"},
     *   path="/v1/profile/employee/logout",
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
