<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Spec;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        $spec1 = new Spec();
        $spec1->name = "software developer";
        $spec2 = new Spec();
        $spec2->name = "QA Engineer";
        $spec3 = new Spec();
        $spec3->name = "project manager";

        $spec1->save();
        $spec2->save();
        $spec3->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specs');
    }
};
