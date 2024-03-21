<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('civilite', 45)->nullable();
            $table->string('firstname', 200)->nullable();
            $table->string('name', 200)->nullable();
            $table->string('username', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('telephone', 200)->nullable();
            $table->string('fixe', 200)->nullable();
            $table->string('sexe', 200)->nullable();
            $table->dateTime('date_naissance')->nullable();
            $table->string('lieu_naissance', 200)->nullable();
            $table->longText('adresse')->nullable();
            $table->string('bp', 200)->nullable();
            $table->string('fax', 200)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('created_by', 200)->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->string('deleted_by', 200)->nullable();
            
            $table->string('twitter', 200)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('linkedin', 200)->nullable();
            $table->unsignedInteger('professionnelles_id')->nullable();
            $table->unsignedInteger('familiales_id')->nullable();
            $table->rememberToken();

            $table->unique(["email"], 'email_UNIQUE');

            $table->index(["professionnelles_id"], 'fk_users_professionnelles1_idx')->onDelete('restrict');

            $table->index(["familiales_id"], 'fk_users_familiales1_idx')->onDelete('restrict');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('professionnelles_id', 'fk_users_professionnelles1_idx')->onDelete('restrict')
                ->references('id')->on('professionnelles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('familiales_id', 'fk_users_familiales1_idx')->onDelete('restrict')
                ->references('id')->on('familiales')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
