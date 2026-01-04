<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('unit_of_measure')->nullable();
            $table->decimal('quantity', 10, 2)->default(1);
            $table->integer('frequency')->default(1);
            $table->decimal('unit_cost', 15, 2);
            $table->decimal('total', 15, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_items');
    }
};

