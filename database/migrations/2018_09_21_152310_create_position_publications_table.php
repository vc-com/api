<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionPublicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
            ->table('position_publications', function (Blueprint $table)
            {

                $table->string('name');     
                $table->string('position_publication');
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
            ->table('position_publications', function (Blueprint $table)
            {
                $table->dropIndex();
                $table->drop();
            });
            
    }

}

