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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['appartment', 'house'])->default('appartment');
            $table->enum('category', ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9'])->default('T1');
            $table->float('area');
            $table->integer('floor')->default(0);
            $table->integer('floors')->default(1);
            $table->integer('rooms')->default(1);
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('toilets')->default(0);
            $table->boolean('is_furnished')->default(false);
            $table->boolean('contains_storage')->default(false);
            $table->boolean('is_kitchen_separated')->default(false);
            $table->boolean('contains_dining_room')->default(false);
            $table->enum('ground', ['wood', 'rock'])->default('wood'); // Type de sol
            $table->enum('heater', ['electrical', 'gas'])->default('gas');
            $table->boolean('fireplace')->default(false);
            $table->boolean('elevator')->default(false);
            $table->boolean('external_storage')->default(false);
            $table->float('area_external_storage')->default(0);
            $table->boolean('guarding')->default(false);
            $table->integer('energy_consumption')->default(0);
            $table->integer('gas_emissions')->default(0);
            $table->string('address');
            $table->integer('zip_code');
            $table->string('city');
            $table->enum('rentOrSale', ['rent', 'sale'])->default('sale');
            $table->float('price');
            $table->float('charges');
            $table->float('guarentee');
            $table->float('fees_price');
            $table->float('inventory_price');
            $table->boolean('published');
            $table->string('image_path');
            $table->date('construction_date');
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
        Schema::dropIfExists('properties');
    }
};
