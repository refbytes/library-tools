<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authentications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('authenticatable_id');
            $table->string('authenticatable_type');
            $table->string('type');
            $table->string('name');
            $table->string('url')
                ->nullable();
            $table->string('username')
                ->nullable();
            $table->string('password')
                ->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['authenticatable_id', 'authenticatable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authentications');
    }
};
