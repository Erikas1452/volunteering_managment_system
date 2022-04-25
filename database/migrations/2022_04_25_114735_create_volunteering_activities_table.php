<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteeringActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteering_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('organization_id');
            $table->integer('category_id');
            $table->string('activity_photo');
            $table->integer('people_registered')->nullable()->default(0);
            $table->integer('people_limit')->nullable()->default(null);
            $table->boolean('papers_required')->default(true);
            $table->string('short_desc');
            $table->text('long_desc');
            $table->string('file_upload_path', 2048)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteering_activities');
    }
}
