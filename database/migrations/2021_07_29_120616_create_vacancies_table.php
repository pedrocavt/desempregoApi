<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateVacanciesTable.
 */
class CreateVacanciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vacancies', function (Blueprint $table) {
			$table->id();
			$table->string('title', 60);
			$table->text('description');
			$table->integer('wage');

			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');

			$table->unsignedBigInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vacancies', function (Blueprint $table) {
			$table->dropForeign('vacancies_category_id_foreign');
			$table->dropForeign('vacancies_user_id_foreign');
		});
		Schema::dropIfExists('vacancies');
	}
}
