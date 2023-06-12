<?php

namespace App\Services\Ticket;

use App\Events\AfterPayed;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Repositories\PriceRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;

class TicketServiceDefault implements TicketServiceInterface
{
    public function __construct(
        private readonly TicketRequest $request,
        private readonly PriceRepository $priceRepository,
        private readonly TicketRepository $ticketRepository,
        protected readonly UserRepository $userRepository,
    ) {
        //
    }

    public function pay(): void
    {
        $ticket = $this->ticketRepository->getTicketByIdWithReports($this->request->ticketId);

        if (!$ticket) {
            throw new \Exception('Ticket not found');
        }

        $cost = $this->getCost();

        // ------ Pay logic ------

        event(
            new AfterPayed(
                $ticket,
                $cost,
                collect($this->request->reportIds)->count()
            )
        );
    }

    public function getCost(): int
    {
        return match ($this->request->type) {
            Ticket::TYPE_ONLINE => $this->getOnlineCost(),
            Ticket::TYPE_OFFLINE => $this->getOfflineCost(),

            default => throw new \LogicException('Ticket type is not implemented'),
        };
    }

    private function getOnlineCost(): int
    {
        if (!$this->request->reportIds) {
            return $this->priceRepository->getDefaultOnlineAllValue();
        }

        $itemCost = $this->priceRepository->getDefaultOnlineItemValue();

        return collect($this->request->reportIds)->reduce(
            function (?int $accum, int $reportId, int $index) use ($itemCost) {
                if (($index % 2) === 0) {
                    return $accum + $itemCost + 100;
                }

                return $accum + $itemCost;
            }
        );
    }

    private function getOfflineCost(): int
    {
        if (!$this->request->reportIds) {
            return $this->priceRepository->getDefaultOfflineAllValue();
        }

        $itemCost = $this->priceRepository->getDefaultOfflineItemValue();

        return collect($this->request->reportIds)->reduce(
            function (?int $accum, int $reportId, int $index) use ($itemCost) {
                return $accum + $itemCost - ($index * 100);
            }
        );
    }
}