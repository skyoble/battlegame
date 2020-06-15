<?php

function chargerClasse($classe)
{
    require $classe . '.php'; //Va chercher la classe nécéssaire
}

spl_autoload_register ('chargerClasse');
$perso1 = new Personnage(1,"Philipe" , 40);
$perso2 = new Personnage(2,"Michel");

$perso1->afficher();
$perso1->frapper($perso2);
$perso1->afficher();
$perso2->frapper($perso1);

$perso1->afficher();
$perso2->afficher();

