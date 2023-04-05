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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->nullable();
            $table->string('promo_type')->nullable();
            $table->float('worth')->nullable();
            $table->string('activation_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('featured_status')->default(0)->nullable();
            // $table->string('eligible')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('promo_codes');
    }
};
