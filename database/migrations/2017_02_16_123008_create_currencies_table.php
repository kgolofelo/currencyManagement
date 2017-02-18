<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('currencies')) {
			Schema::create('currencies', function (Blueprint $table) {
				$table->increments('id')->length(10);
				$table->string('name')->length(100);
				$table->string('code')->length(10)->unique();
				$table->decimal('rate', 10, 6);
				$table->timestamps();
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
