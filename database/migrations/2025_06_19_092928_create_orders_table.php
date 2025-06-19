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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->date('order_date');
        $table->enum('status', ['новый', 'выполнен'])->default('новый');
        $table->text('comment')->nullable();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->unsignedBigInteger('quantity')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
