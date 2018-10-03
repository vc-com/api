<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DB_CONNECTION'))
        ->table('products', function (Blueprint $table)
        {

            $table->timestamps();
            $table->softDeletes();
            $table->unique('name');
            $table->unique('slug');

            $table->index(
                [
                    "name" => "text",
                    "description" => "text",
                    "tag" => "text"
                ],
                'products_full_text',
                null,
                [
                    "weights" => [
                        "name" => 32,
                        "tag" => 16,
                        "description" => 8,
                    ],
                    'name' => 'products_full_text'
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
        ->table('products', function (Blueprint $table)
        {

            $table->dropIndex();
            $table->drop();

        });

    }

}