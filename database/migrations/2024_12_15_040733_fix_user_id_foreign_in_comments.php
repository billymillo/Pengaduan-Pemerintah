<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixUserIdForeignInComments extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Drop the incorrect foreign key
            $table->dropForeign(['user_id']);

            // Add the correct foreign key referencing the `users` table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['user_id']);

            // Restore the old foreign key referencing the `reports` table
            $table->foreign('user_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }
}

