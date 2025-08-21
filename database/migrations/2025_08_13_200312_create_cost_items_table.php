<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cost_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('group_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('billing_type')->default('monthly'); // z.B. monthly, quarterly, yearly, once
            $table->date('interval_start')->nullable();
            $table->date('interval_end')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cost_items');
    }
};
