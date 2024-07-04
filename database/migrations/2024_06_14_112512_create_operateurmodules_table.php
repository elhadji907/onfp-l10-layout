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
        Schema::create('operateurmodules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->char('uuid', 36);
            $table->string('module', 50)->nullable();
            $table->string('domaine')->nullable();
            $table->string('niveau_qualification')->nullable();
            $table->longText('details')->nullable();
            $table->string('statut')->nullable();
            $table->unsignedInteger('operateurs_id')->nullable();
            $table->unsignedInteger('modules_id')->nullable();
            $table->unsignedInteger('validated_id');
            $table->softDeletes();
            $table->nullableTimestamps();
            
            $table->index(["operateurs_id"], 'fk_operateurmodules_operateurs1_idx');
            

            $table->foreign('operateurs_id', 'fk_operateurmodules_operateurs1_idx')
                ->references('id')->on('operateurs')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->index(["modules_id"], 'fk_operateurmodules_modules1_idx');
            

            $table->foreign('modules_id', 'fk_operateurmodules_modules1_idx')
                ->references('id')->on('modules')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operateurmodules');
    }
};
