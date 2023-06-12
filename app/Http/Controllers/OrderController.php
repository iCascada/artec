<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Compute the cost of ticket
     *
     * @OA\Get(
     *      path="/api/order",
     *      summary="Get payed tickets",
     *      description="Прототип получения заказа<br>
    <b>Allowed values:</b><br>
    <p>ids: array<'int'></p>
    ",
     *      tags={"Order"},
     *      @OA\Parameter(
     *        name="ids[]",
     *        in="query",
     *        required=true,
     *        example={3,4},
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
     *          "total": 1395,
     *          "tickets": {
     *              {
     *                  "Eligendi.": 919
     *              },
     *              {
     *                  "Non et.": 476
     *              }
     *          }
     *       })
     *      ),
     *      @OA\Response(response=422,description="Validation errors",
     *      @OA\JsonContent(
     *          example={
     *              "error": "The ids field is required."
     *          })
     *      )
     * )
     */
    public function order(
        OrderRequest $paidTicketRequest,
        TicketRepository $ticketRepository,
    ): JsonResponse {
        $tickets = $ticketRepository->getTicketsByIdsWithCost($paidTicketRequest->ids);

        return response()->json([
            'total' => $tickets->reduce(fn(?int $accum, Ticket $ticket) => $accum + $ticket->cost()),
            'tickets' => $tickets->map(fn(Ticket $ticket) => ["$ticket->name" => $ticket->cost()]),
        ]);
    }
}
