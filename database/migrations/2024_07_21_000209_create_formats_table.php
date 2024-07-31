<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')
                ->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('format_subscription', function (Blueprint $table) {
            $table->foreignId('format_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('subscription_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->primary(['format_id', 'subscription_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formats');
    }
};
