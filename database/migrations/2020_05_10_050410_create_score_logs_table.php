<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_logs', function (Blueprint $table) {
            $table->id();

            $table->string('source_ip')->nullable();
            $table->string('operation_type')->nullable();
            $table->string('operation_source')->nullable();
            $table->string('operation_value')->nullable();
            $table->string('target_email')->nullable();
            $table->string('target_score_after_operation')->nullable();
            $table->string('offer_id')->nullable();
            $table->string('offer_name')->nullable();
            $table->string('offer_conversion_date')->nullable();
            $table->string('offer_payout')->nullable();
            $table->string('offer_user_ip')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_logs');
    }
}