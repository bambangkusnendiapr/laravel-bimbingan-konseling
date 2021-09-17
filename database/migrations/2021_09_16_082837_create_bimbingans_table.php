<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama');
            $table->unsignedBigInteger('pelanggaran_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('teacher_id');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pelanggaran_id')->references('id')->on('pelanggarans')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimbingans');
    }
}
