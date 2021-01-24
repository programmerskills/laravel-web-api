<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSubactIdInSubchildcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subchildcategories', function (Blueprint $table) {
            $table->renameColumn('subact_id','subcat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subchildcategories', function (Blueprint $table) {
            $table->renameColumn('subcat_id','subact_id');
        });
    }
}
