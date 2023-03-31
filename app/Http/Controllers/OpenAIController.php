<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class OpenAIController extends Controller
{
    /**
     *
     *  @OA\Post(
     *   tags={"Open AI"},
     *   path="/v1/openai/ask",
     *   summary="Задать вопрос OpenAI",
     *     @OA\RequestBody(
     *      required=true,
     *      description="Тело запроса к OpenAI",
     *      @OA\JsonContent(
     *            example=
     *            {
     *	           "question": "PHP is",
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
    public function ask(Request $request){
        $request->validate([
            'question' => 'required|string|min:3'
        ]);

        $client = OpenAI::client(getenv('OPENAI_API_KEY'));

        $result = $client->completions()->create([
            "model" => "text-davinci-003",
            "temperature" => 0.7,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 600,
            'prompt' => sprintf($request->question),
        ]);

        return trim($result['choices'][0]['text']);
    }
}
