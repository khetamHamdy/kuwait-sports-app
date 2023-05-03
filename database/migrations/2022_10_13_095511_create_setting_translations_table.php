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
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale')->index();

            $table->text('text_ourLogo');
            $table->text('text_socialMedia');
            $table->text('text_footer');

            $table->text("about_description1")->nullable();
            $table->text("provide_description1")->nullable();
            $table->text("service_title1")->nullable();
            $table->text("service_title2")->nullable();
            $table->text("service_title3")->nullable();

            $table->text("service_description1")->nullable();
            $table->text("service_description2")->nullable();
            $table->text("service_description3")->nullable();

            $table->unique(['setting_id', 'locale']);
            $table->foreignId('setting_id')->unsigned()->constrained('settings')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_translations');
    }
};
