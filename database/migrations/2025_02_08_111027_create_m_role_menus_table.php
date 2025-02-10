<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_role_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_m_roles');
            $table->unsignedBigInteger('id_m_menus');
            $table->boolean("flag_create");
            $table->boolean("flag_read");
            $table->boolean("flag_update");
            $table->boolean("flag_delete");
            $table->boolean("flag_export");
            $table->boolean("flag_import");

            $table->string("obj_type");
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string("created_by");
            $table->string("updated_by")->nullable();
            $table->string("deleted_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_role_menus');
    }
};
