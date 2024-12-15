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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('time')->nullable();
            $table->string('adress')->nullable();
            $table->text('comment')->nullable();
            $table->string('payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone_number');
            $table->dropColumn('time');
            $table->dropColumn('adress');
            $table->dropColumn('comment');
            $table->dropColumn('payment');
        });
    }
};
