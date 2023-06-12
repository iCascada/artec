<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Services\Ticket\TicketServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    /**
     * Compute the cost of ticket
     *
     * @OA\Get(
     *      path="/api/cost",
     *      summary="Get ticket cost",
     *      description="Прототип расчета стоимости каждого конкретного билета<br>
            <b>Allowed values:</b><br>
            <p>type: Enum<'offline','online'></p>
            <p>ticketId: int</p>
            <p>reportIds: array<'int'></p>
            <p>tariff: string, <b>Not implemented</b></p>
    ",
     *      tags={"Ticket"},
     *      @OA\Parameter(
     *        name="type",
     *        in="query",
     *        required=true,
     *        example="offline",
     *        @OA\Schema(
     *           type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *        name="ticketId",
     *        in="query",
     *        required=true,
     *        example=45,
     *        @OA\Schema(
     *           type="integer"
     *        )
     *      ),
     *      @OA\Parameter(
     *        name="tariff",
     *        in="query",
     *        required=false,
     *        @OA\Schema(
     *           type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *        name="reportIds",
     *        in="query",
     *        required=false,
     *        @OA\Schema(
     *           type="array",
     *           @OA\Items(
     *            type="integer"
     *          )
     *        )
     *      ),
     *      @OA\Response(response=200,description="OK",
     *      @OA\JsonContent(
     *        example={
     *          "cost": 33000
     *       })
     *      ),
     *      @OA\Response(response=422,description="Validation errors",
     *      @OA\JsonContent(
     *          example={
     *              "error": "The ticket id field is required."
     *          })
     *      ),
     *      @OA\Response(response=501,description="Not implemented",
     *      @OA\JsonContent(
     *          example={
     *              "error": "Tariff's is not supported yet."
     *          })
     *      )
     * )
     */
    public function cost(
        TicketRequest $request,
        TicketServiceInterface $ticketService,
    ): JsonResponse {
        if ($request->tariff) {
            return response()->json([], Response::HTTP_NOT_IMPLEMENTED);
        }

        return response()->json([
            'cost' => $ticketService->getCost()
        ]);
    }

    /**
     * Ticket pay
     *
     * @OA\Post(
     *      path="/api/pay",
     *      summary="Pay ticket",
     *      description="Прототип оплаты билета<br>
            <b>Allowed values:</b><br>
            <p>type: Enum<'offline','online'></p>
            <p>ticketId: int</p>
            <p>reportIds: array<'int'></p>
            <p>tariff: string, <b>Not implemented</b></p>
    ",
     *      tags={"Ticket"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *          example={
     *              "type": "offline",
     *              "ticketId": "45"
     *          })
     *      ),
     *      @OA\Response(response=200,description="OK"),
     *      @OA\Response(response=422,description="Validation errors",
     *      @OA\JsonContent(
     *          example={
     *              "error": "The ticket id field is required."
     *          })
     *      ),
     *      @OA\Response(response=501,description="Not implemented",
     *      @OA\JsonContent(
     *          example={
     *              "error": "Tariff's is not supported yet."
     *          })
     *      )
     * )
     */
    public function pay(
        TicketRequest $request,
        TicketServiceInterface $ticketService,
    ): JsonResponse {
        if ($request->tariff) {
            return response()->json([], Response::HTTP_NOT_IMPLEMENTED);
        }

        $ticketService->pay();

        return response()->json();
    }
}
