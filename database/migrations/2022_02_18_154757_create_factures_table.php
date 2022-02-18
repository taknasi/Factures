<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facture_num',500);
            $table->date('facture_date')->nullable();
            $table->decimal('montant-encaisse',8,2)->nullable();
            $table->decimal('montant-comission',8,2)->nullable();
            $table->decimal('remise',8,2)->nullable();
            $table->decimal('valeur_tva',8,2)->nullable();
            $table->string('taux-tva',999)->nullable();
            $table->decimal('totale',8,2);
            $table->string('status',50);
            $table->decimal('valeur_status',8,2);
            $table->text('note')->nullable();
            $table->date('paiment_date')->nullable();
            $table->softDeletes();

            $table->bigInteger('produit_id')->unsigned();
            $table->foreign('produit_id')->references('id')->on('produits')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
