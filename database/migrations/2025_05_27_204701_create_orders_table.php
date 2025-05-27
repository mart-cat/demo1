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
       Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('service_id')->nullable()->constrained('services');
        $table->string('other_service')->nullable();
        $table->string('address');
        $table->string('phone');
        $table->dateTime('service_time');
        $table->enum('payment_type', ['cash', 'card']);
        $table->enum('status', ['new', 'in_progress', 'done', 'cancelled'])->default('new');
        $table->string('cancel_reason')->nullable();
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
