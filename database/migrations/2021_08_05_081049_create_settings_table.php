<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->enum('type', ['string', 'password', 'text', 'number', 'boolean', 'html', 'date', 'date_time', 'json']);
            $table->integer('sort')->default(0);
            $table->string('key');
            $table->longText('value')->nullable()->default("");
            $table->integer('provider_key')->default(0);
            $table->string('provider_name')->default('G');
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
}
