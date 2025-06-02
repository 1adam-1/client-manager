<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlod_avis', function (Blueprint $table) {
            $table->string('generated_id')->primary(); 
            $table->string('solution');
            $table->string('entreprise')->nullable(); 
            $table->string('notes')->nullable(); 
            $table->string('nomComplet');
            $table->string('email')->unique()->nullable();
            $table->string('choixProduit')->nullable();
            $table->string('domaineActivite')->nullable();
            $table->string('adresse')->nullable();
            $table->string('source');
            $table->string('num');
            $table->enum('campagnePub',[
                'Vd 1 Boite carte',
                'Vd 2 Airlod',
                'Vd 3 Airlod carte transparente']);
            $table->enum('statut', [
                'Contact Initial',
                'Intérêt Manifesté',
                'Objection Prix',
                'Option Affiliation',
                'Négociation en Cours',
                'confirmation en attente',
                'attente logo',
                'design en cours',
                'design approuvé',
                'commande confirmé',
                'attente de production',
                'paiement en attente',
                'ramassage en cours',
                'commande expédiée',
                'première relance',
                'seconde relance',
                'livrée',
                'indisponibilité temporaire',
                'contact injoignable',
                'mauvaise cible',
                'confirmé',
                'application',
                'airlod avis intéret'
            ])->default('Contact Initial');
            $table->string('facture')->nullable();
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
        Schema::dropIfExists('airlod_avis');
    }
};
