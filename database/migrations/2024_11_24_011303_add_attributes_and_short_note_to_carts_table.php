<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->json('attributes')->nullable(); // Stores size_id, quality_id, type_id, color_id as a JSON array
            $table->text('short_note')->nullable(); // User's short note
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('attributes');
            $table->dropColumn('short_note');
        });
    }
};
