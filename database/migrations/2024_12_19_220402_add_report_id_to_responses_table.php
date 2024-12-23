<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportIdToResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responses', function (Blueprint $table) {
            // Add the report_id column
            $table->unsignedBigInteger('report_id')->nullable()->after('id');

            // Add the foreign key constraint
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responses', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['report_id']);

            // Drop the report_id column
            $table->dropColumn('report_id');
        });
    }
}
