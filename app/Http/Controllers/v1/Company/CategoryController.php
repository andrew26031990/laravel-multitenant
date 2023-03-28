<?php

namespace App\Http\Controllers\v1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\storeCategoryRequest;
use App\Http\Requests\v1\Company\updateCategoryRequest;
use App\Http\Resources\v1\Company\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Категории компании"},
     *   path="/v1/company/categories",
     *   summary="Получение всех категорий компании",
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.CategoryResource")),
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
        return CategoryResource::collection($this->categoryService->getList());
    }

    /**
     *
     *  @OA\Post(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Категории компании"},
     *   path="/v1/company/categories",
     *   summary="Добавление категории в компанию",
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса на добавление категории в компанию",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "name": "Категория 1",
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.CategoryResource")),
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
    public function store(storeCategoryRequest $request)
    {
        return new CategoryResource($this->categoryService->store($request->validated()));
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Категории компании"},
     *   path="/v1/company/categories/{id}",
     *   summary="Получение всех категорий компании",
     *    @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID категории",
     *         required=true,
     *      ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.CategoryResource")),
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
        return new CategoryResource($this->categoryService->showById($id));
    }

    /**
     *
     *  @OA\Put(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Категории компании"},
     *   path="/v1/company/categories/{id}",
     *   summary="Редактирование категории в компании",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID категории",
     *         required=true,
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса на редактирование категории в компании",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "name": "Категория 2",
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.CategoryResource")),
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
    public function update(updateCategoryRequest $request, $id)
    {
        return new CategoryResource($this->categoryService->update($request->validated(), $id));
    }

    /**
     *
     *  @OA\Delete(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Категории компании"},
     *   path="/v1/company/categories/{id}",
     *   summary="Удаление категории из компании",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID категории",
     *         required=true,
     *      ),
     *     @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.CategoryResource")),
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
        return $this->categoryService->destroy($id);
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Категории компании"},
     *   path="/v1/company/category/{id}/products",
     *   summary="Получение всех товаров категории в компании",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID категории",
     *         required=true,
     *      ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.CategoryResource")),
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
    public function products($id){
        return new CategoryResource($this->categoryService->showById($id, ['products','products.brand']));
    }
}
