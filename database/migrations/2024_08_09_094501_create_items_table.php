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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('categoryid')->nullable();
            $table->integer('subcategoryid')->nullable();
            $table->string('item_name',80)->nullable();
            $table->integer('quantity')->nullable();
            $table->double('mrp')->nullable();
            $table->double('offer_price')->nullable();
            $table->string('item_image',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
