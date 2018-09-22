<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
            ->table('banners', function (Blueprint $table)
            {

                $table->string('name');
                $table->string('active');          
                $table->string('description');
                $table->string('local_publication');
                $table->string('position_publication');
                $table->string('slug');
                $table->string('target');
                $table->string('image');
                $table->string('meta_title');
                $table->string('meta_description');
                $table->string('meta_keyword');
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
            ->table('banners', function (Blueprint $table)
            {
                $table->drop();
            });

    }

}
