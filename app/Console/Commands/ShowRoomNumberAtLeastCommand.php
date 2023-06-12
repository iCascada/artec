<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowRoomNumberAtLeastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artec:show-room-number-at-least';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'show room number at least';

    private function getQuery(): string {
        return
            /** @lang TSQL */
            "
            WITH cte_main as (
                SELECT r.id,
                       p.first_name,
                       p.last_name,
                       r.room_number,
                       r.check_out_date
                FROM reservations as r
                LEFT JOIN persons p on p.id = r.person_id
                WHERE r.room_number IN (SELECT room_number
                     FROM (
                         SELECT count(room_number) as reservation_count, room_number
                         FROM reservations rs
                         GROUP BY room_number
                         HAVING reservation_count < 2
                     ) as room_numbers
                )
                  AND YEAR(r.reserved_at) = YEAR(DATE_SUB(NOW(), INTERVAL 1 YEAR))
                  AND MONTH(r.reserved_at) = 9
            )

            SELECT * FROM cte_main WHERE check_out_date = (SELECT MAX(check_out_date) as last_out_date FROM cte_main);
         ";
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = $this->getQuery();

        $this->info('SQL query');
        dump($query);

        $this->info('Result');
        dump(DB::select($query));

        return self::SUCCESS;
    }
}
