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
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // auto-incrementing ID
            $table->string('tieude', 200); // Tiêu đề
            $table->string('ten_bhat', 100); // Tên bài hát
            $table->unsignedInteger('ma_tloai'); // Mã loại
            $table->text('tomtat'); // Tóm tắt
            $table->text('noidung')->nullable(); // Nội dung
            $table->unsignedInteger('ma_tgia'); // Mã tác giả
            $table->timestamps(); // created_at và updated_at
            $table->timestamp('ngayviet')->useCurrent(); // Ngày viết
            $table->string('hinhanh', 200)->nullable(); // Hình ảnh

            // Foreign keys
            $table->foreign('ma_tloai')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('ma_tgia')->references('id')->on('authors')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
