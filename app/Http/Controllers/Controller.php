<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *         version="2.0",
 *         title="API Credit Broker 2.0",
 *         description="Документация
 * Во всех ответах приходит объект: `data`, кроме ошибок: В ошибках `401` имеется только поле `message`; в ошибке `422` имеются поля: `errors и message`.
 * Для авторизованных запросов необходимо вставить в HEADER `Authorization ` Bearer токен полученный при авторизации. Пример:
 *     Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbM3MjlkIn0.eyJhdWQiOiI2IiwianRpIjoiYThlYjY3NGVjMzIyMmU3MWY5Nzk3MzMwMjU
 * Токен можно получить при входе в систему или регистрации. Сам токен будет расположен в ответе HEADER:
 *      X-Access-Token: eyJ0eXAiOiJKV1QiLCJhbM3MjlkIn0.eyJhdWQiOiI2IiwianRpIjoiYThlYjY3NGVjMzIyMmU3MWY5Nzk3MzMwMjU
 *      X-Access-Token-Expires-At: 2023-11-08 10:13:18
 *  Важно! На всех запросах, кроме DEV - необходимо отправлять в HEADER Platform-Code и Device-Id. Иначе будет приходить  `403 ошибка`
 *      Platform-Code: ios
 *      Device-Id: DFIE3232dD
 *
 * На всех запросах в HEADER ОБЯЗАТЕЛЬНО установить:
 *     Accept: application/json"
 *   ,
 *         @OA\Contact(
 *             email="develop@tsay.uz"
 *         )
 *     )
 *
 * @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer",
 *         description="Пример: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0OT",
 *         name="Authorization",
 *         in="header",
 *     )
 *
 * @OA\SecurityScheme(
 *         securityScheme="Platform-Code",
 *         type="apiKey",
 *         description="Код платформы",
 *         name="Platform-Code",
 *         in="header",
 *     )
 *
 * @OA\SecurityScheme(
 *         securityScheme="Device-Id",
 *         type="apiKey",
 *         description="ID устройства",
 *         name="Device-Id",
 *         in="header",
 *     )
 *
 * @OA\SecurityScheme(
 *         securityScheme="Company-slug",
 *         type="apiKey",
 *         description="Slug компании",
 *         name="Company",
 *         in="header",
 *     )
 *
 *
 * @OA\Server(
 *     url="http://localhost",
 *     description="API LOCAL SERVER"
 * )
 * @OA\Server(
 *      url="http://{tenant}.localhost",
 *      description="API LOCAL SERVER WITH TENANT",
 *      @OA\ServerVariable(
 *          serverVariable="tenant",
 *          default="tenant"
 *      )
 * )
 * @OA\Server(
 *     url="https://api.sbi.retailbox.uz",
 *     description="API DEVELOP SERVER"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
