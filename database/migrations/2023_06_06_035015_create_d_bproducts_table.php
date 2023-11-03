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
        Schema::create('d_bproducts', function (Blueprint $table) {
            $table->id();
            $table->text("sell_id")->nullable();
            $table->text("co_name")->nullable();
            $table->text("co_city")->nullable();
            $table->text("coe_name")->nullable();
            $table->text("coe_add")->nullable();
            $table->text("artc")->nullable();
            $table->text("packages")->nullable();
            $table->text("weight")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_bproducts');
    }
};
