<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('activities')) {
			Schema::create('activities', function (Blueprint $table) {
				$table->increments('id')->length(10);
				$table->string('loggable_type')->length(100);
				$table->integer('loggable_id')->length(10);
				$table->integer('user_id')->length(10);
				$table->string('event')->length(100);
				$table->string('before')->length(250)->nullable();
				$table->string('after')->length(250);
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
        Schema::dropIfExists('activities');
    }
}
