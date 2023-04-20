<?php

use App\Models\SorteioStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSorteioStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteio_status', function (Blueprint $table) {
            $table->unsignedBigInteger('codigo')->primary();
            $table->string('desc');
        });

        Schema::table('sorteios', function (Blueprint $table) {
            $table->unsignedBigInteger('status_codigo');
            $table->foreign('status_codigo')->references('codigo')->on('sorteio_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sorteios', function (Blueprint $table) {
            $table->dropForeign('sorteios_status_codigo_foreign');
            $table->dropColumn('status_codigo');
        });

        Schema::dropIfExists('sorteio_status');
    }
}
