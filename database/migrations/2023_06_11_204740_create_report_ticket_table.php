<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_ticket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')
                ->references('id')
                ->on('reports');
            $table->foreignId('ticket_id')
                ->references('id')
                ->on('tickets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_ticket');
    }
};
