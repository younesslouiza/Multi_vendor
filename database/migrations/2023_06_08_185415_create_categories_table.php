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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')            //create foreign key
            ->nullable()    
            ->constrained('categories','id')          //reference this fk is categories and table is id
            ->nullOnDelete();                         // delete data and null values recommanded proprieter
            //->cascadeOnDelete() =>  delete all data
            //->restrictOnDelete()=>عدم حدف هادا خيار لانه مرتبط ببيانات من جادول اخر
            
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['active','archived']);
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
        Schema::dropIfExists('categories');
    }
};
