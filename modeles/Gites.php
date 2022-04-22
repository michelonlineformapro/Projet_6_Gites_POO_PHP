<?php

//Php strcit a typé
declare(strict_types=1);

class Gites
{
    //PROPRIETES = VARIABLES
    public string $nom_gite;
    public float $prix_gite;

    public function getGites(string $nom, float $prix){


        echo "Le gite creer s'appel " . $nom . " et le prix a la semaine est de  " . $prix. " €";
    }

}