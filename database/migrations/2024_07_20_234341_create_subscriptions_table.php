<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            $table->string('type');
            $table->boolean('is_public')
                ->default(true);
            $table->string('name');
            $table->string('url')
                ->nullable();
            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('proxy_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->longText('description')
                ->nullable();
            $table->longText('authenticated_description')
                ->nullable();
            $table->longText('internal_notes')
                ->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
