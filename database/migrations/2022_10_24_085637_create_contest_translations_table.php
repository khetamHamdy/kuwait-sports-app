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
        Schema::create('contest_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale')->index();
            $table->text("description");
            $table->unique(['contest_id', 'locale']);
            $table->foreignId('contest_id')->unsigned()->constrained('contests')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_translations');
    }
};
