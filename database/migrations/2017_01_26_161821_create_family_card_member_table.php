<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyCardMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_card_member', function (Blueprint $table) {
            $table->unsignedBigInteger('family_card_id');
            $table->unsignedBigInteger('resident_id');
            $table->boolean('is_patriarch')->default(false);
            $table->index(['family_card_id', 'resident_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_card_member');
    }
}
