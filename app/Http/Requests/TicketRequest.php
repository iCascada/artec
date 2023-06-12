<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Ticket;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $tariff
 * @property-read string $type
 * @property-read array $reportIds
 * @property-read int $ticketId
 */
class TicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:' . join(',', [Ticket::TYPE_OFFLINE, Ticket::TYPE_ONLINE]),
            'ticketId' => 'required|int',
            'reportIds' => 'array',
            'reportIds.*' => 'int',
        ];
    }
}
