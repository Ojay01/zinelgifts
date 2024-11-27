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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID instead of incremental ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number', 12)->unique();
            $table->enum('status', ['Paid', 'Confirmed', 'Processing', 'In Transit', 'Delivered', 'Cancelled'])
                  ->default('Paid');
            $table->string('address_id')->contraint()->onDelete('cascade');;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
