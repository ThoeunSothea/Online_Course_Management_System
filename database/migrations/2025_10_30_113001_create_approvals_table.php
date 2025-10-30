<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_approvals', function (Blueprint $table) {
            $table->id('approval_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_approvals');
    }
};
