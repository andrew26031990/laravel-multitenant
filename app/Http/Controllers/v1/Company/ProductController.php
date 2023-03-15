<?php

namespace App\Http\Controllers\v1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\storeProductRequest;
use App\Http\Requests\v1\Company\updateProductRequest;
use App\Http\Resources\v1\Company\ProductResource;
use App\Models\Tenant\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Товар компании"},
     *   path="/v1/company/products",
     *   summary="Получение всех товаров компании",
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.ProductResource")),
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
        return ProductResource::collection($this->productService->getList());
    }

    /**
     *
     *  @OA\Post(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Товар компании"},
     *   path="/v1/company/products",
     *   summary="Добавление товара в компанию",
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса на добавление товара в компанию",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "name": "Груша",
     *	           "barcode": "123456789"
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.ProductResource")),
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
    public function store(storeProductRequest $request)
    {
        return new ProductResource($this->productService->store($request->validated()));
    }

    /**
     *
     *  @OA\Get(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Товар компании"},
     *   path="/v1/company/products/{id}",
     *   summary="Просмотр товара в компании",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID товара",
     *         required=true,
     *      ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.ProductResource")),
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
        return new ProductResource($this->productService->showById($id));
    }

    /**
     *
     *  @OA\Put(
     *   security={ {"bearerAuth" : ""}},
     *   tags={"Товар компании"},
     *   path="/v1/company/products/{id}",
     *   summary="Редактирование товара в компании",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID товара",
     *         required=true,
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса на редактирование товара в компании",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "name": "Яблоко",
     *	           "barcode": "987654321"
     *             }
     *          ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.ProductResource")),
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
    public function update(updateProductRequest $request, $id)
    {
        return new ProductResource($this->productService->update($request->validated(), $id));
    }

    /**
     *
     *  @OA\Delete(
     *     security={ {"bearerAuth" : ""} },
     *   tags={"Товар компании"},
     *   path="/v1/company/products/{id}",
     *   summary="Удаление товара из компании",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID товара",
     *         required=true,
     *      ),
     *     @OA\Response(
     *     response=200,
     *     description="",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array",  @OA\Items(ref="#/components/schemas/v1.Company.ProductResource")),
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
        return $this->productService->destroy($id);
    }
}
