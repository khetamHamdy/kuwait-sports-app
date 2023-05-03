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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->string("video")->nullable();
            $table->enum("type", ['blog', 'featured', 'location', 'interviews', 'advice']);
            $table->string("link");
            $table->enum('status', ['active', 'not_active'])->default('active');
            $table->text("images")->nullable();
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
        Schema::dropIfExists('events');
    }
};
