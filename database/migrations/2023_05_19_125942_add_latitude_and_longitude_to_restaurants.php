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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->decimal('latitude' , 10 , 7)->nullable()->after('address');
            $table->decimal('longitude' , 10 , 7)->nullable()->after('latitude');
            $table->text('schedule')->nullable()->after('acc_number');
            $table->boolean('is_open')->default(1)->after('schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            //
        });
    }
};
