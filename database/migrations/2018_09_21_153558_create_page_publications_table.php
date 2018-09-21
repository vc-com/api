<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagePublicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
            ->table('page_publications', function (Blueprint $table)
            {

                $table->string('name');     
                $table->string('page_publication');
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
            ->table('page_publications', function (Blueprint $table)
            {
                $table->dropIndex();
                $table->drop();
            });

    }

}
