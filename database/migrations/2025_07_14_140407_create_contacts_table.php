<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('姓名');
            $table->string('phone')->nullable()->comment('電話');
            $table->string('email')->comment('信箱');
            $table->string('subject')->comment('主旨');
            $table->text('message')->comment('訊息');
            $table->enum('status', ['pending', 'processing', 'completed'])->default('pending')->comment('處理狀態');
            $table->text('reply')->nullable()->comment('回覆內容');
            $table->timestamp('replied_at')->nullable()->comment('回覆時間');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
