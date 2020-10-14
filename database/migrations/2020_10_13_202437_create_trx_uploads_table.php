<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('siswa_id');
            $table->unsignedInteger('guru_id');
            $table->unsignedInteger('kelas_id');
            $table->string('file');

            $table->foreign('siswa_id')->references('id')->on('users');
            $table->foreign('guru_id')->references('id')->on('users');

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
        Schema::dropIfExists('trx_uploads');
    }
}
