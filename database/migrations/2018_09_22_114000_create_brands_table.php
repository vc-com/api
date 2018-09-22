<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
            ->table('brands', function (Blueprint $table)
            {

                $table->string('name');
                $table->string('active');          
                $table->string('description');
                $table->string('slug');
                $table->string('image');
                $table->string('meta_title');
                $table->string('meta_description');
                $table->string('sort_order');
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

        Schema::connection(env('DB_CONNECTION'))
            ->table('brands', function (Blueprint $table)
            {
                $table->drop();
            });

    }

}
