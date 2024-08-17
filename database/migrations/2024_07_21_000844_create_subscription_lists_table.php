<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->unique();
            $table->string('slug')
                ->unique();
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('list_subscription', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_list_id');
            $table->unsignedBigInteger('subscription_id');

            $table->foreign('subscription_list_id')
                ->references('id')
                ->on('subscription_lists')
                ->cascadeOnDelete();
            $table->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
