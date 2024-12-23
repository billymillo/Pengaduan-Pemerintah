<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responses_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('response_id')->after('id'); // Add the column
            $table->foreign('response_id')->references('id')->on('responses')->onDelete('cascade'); // Set the foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responses_progress', function (Blueprint $table) {
            $table->dropForeign(['response_id']);
            $table->dropColumn('response_id');
        });
    }
};
