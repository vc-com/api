<?php

use App\Entities\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
        ->table('users', function (Blueprint $table)
        {
           
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->boolean('active')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique('email');

            $table->index(
                [
                    "name" => "text",
                    "email" => "text"
                ],
                'users_full_text',
                null,
                [
                    "weights" => [
                        "name" => 32,
                        "email" => 16,
                    ],
                    'name' => 'users_full_text'
                ]
            );

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
        ->table('users', function (Blueprint $table)
        {
            $table->dropIndex();
            $table->drop();
        });

    }
}
