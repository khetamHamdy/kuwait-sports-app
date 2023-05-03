<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("fav_icon");
            $table->string('mobile');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('youTube');
            $table->string('primaryLogo');
            $table->string('secondaryLogo');
            $table->string("count_total_client");
            $table->string("count_project_complete");
            $table->string("count_active_employee");
            $table->string("count_avg_rating");
            $table->string("service_image1")->nullable();
            $table->string("service_image2")->nullable();
            $table->string("service_image3")->nullable();
            $table->foreignId("product_id")->nullable()->constrained("products")->nullOnDelete();
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
        Schema::dropIfExists('settings');
    }
};
