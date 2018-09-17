<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoles extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
        ->table('roles', function (Blueprint $table)
        {

            $table->string('name');
            $table->string('description');
            $table->uuid('uuid');
            $table->timestamps();
            $table->softDeletes();

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
        ->table('roles', function (Blueprint $table)
        {
            $table->dropIndex();
            $table->drop();
        });
    }
}
