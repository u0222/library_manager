<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('AUTO_INCREMENT');
            $table->unsignedInteger('library_id')->comment('librariesテーブルとの外部キー');
            $table->unsignedInteger('user_id')->comment('usersテーブルとの外部キー');
            $table->dateTime('rent_date')->comment('貸し出し日');
            $table->dateTime('return_date')->nullable()->comment('返却日');
            $table->dateTime('return_due_date')->comment('返却予定日');
        });
        
        // テーブルのコメントとその他の設定
        DB::statement("ALTER TABLE `logs` COMMENT 'ログテーブル'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
