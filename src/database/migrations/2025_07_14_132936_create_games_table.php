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
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partner_id');
            $table->uuid('provider_id');
            $table->string('category');  // casino | livetable | virtual game |
            $table->string('category_type'); // slot | reel | casino | live table | live | virtual
            $table->string('game_name');
            $table->boolean('desktop')->default(true);
            $table->boolean('mobile')->default(true);
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->string('game_id')->unique(); // CasinoGameId / EMGameId
            $table->string('game_code')->nullable(); // GameCode
            $table->string('game_model')->nullable(); // GameModel
            $table->string('vendor')->nullable();
            $table->string('launch_url')->nullable(); 
            $table->string('thumbnail')->nullable(); //thumbnail
            $table->json('languages')->nullable();
            $table->json('currencies')->nullable();
            $table->json('jackpot_info')->nullable();
            $table->json('bonus_info')->nullable();
            $table->json('games_log')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
