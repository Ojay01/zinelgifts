<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeSubtitleColumnTypeInSlidesTable extends Migration
{
    public function up()
    {
        // Step 1: Rename the original column
        Schema::table('slides', function (Blueprint $table) {
            $table->renameColumn('subtitle', 'subtitle_old');
        });

        // Step 2: Add a new column with the desired datatype
        Schema::table('slides', function (Blueprint $table) {
            $table->text('subtitle')->nullable(); // Assuming 'subtitle' should now be TEXT
        });

        // Step 3: Copy data from the old column to the new column
        DB::statement('UPDATE slides SET subtitle = subtitle_old');

        // Step 4: Drop the old column
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('subtitle_old');
        });
    }

    public function down()
    {
        // Revert the changes by changing it back
        Schema::table('slides', function (Blueprint $table) {
            $table->renameColumn('subtitle', 'subtitle_old');
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->string('subtitle')->nullable(); // Assuming VARCHAR was the original type
        });

        DB::statement('UPDATE slides SET subtitle = subtitle_old');
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('subtitle_old');
        });
    }
};

