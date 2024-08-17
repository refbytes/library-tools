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
            $table->boolean('is_featured')
                ->default(false);
            $table->string('name');
            $table->string('alternate_names')
                ->nullable();
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

        \Spatie\Permission\Models\Permission::create(['name' => 'subscriptions:view']);
        \Spatie\Permission\Models\Permission::create(['name' => 'subscriptions:create']);
        \Spatie\Permission\Models\Permission::create(['name' => 'subscriptions:update']);
        \Spatie\Permission\Models\Permission::create(['name' => 'subscriptions:delete']);
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
