<?php

session_start();

function chargerClasse($classe)
{
    require $classe . '.php'; //Va chercher la classe nécéssaire
}


spl_autoload_register('chargerClasse');

print('<br/>PHP Battle Game<br/>');


$dsn = 'mysql:dbname=battlegame;host=127.0.0.1';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // permet de transformer le truc de base string en valeur

$personneManager = new PersonneManager($db);

//ajouter un perso
$perso = new Personne(array('nom' =>'Victor', 'hp'=>50,'degats'=>0, 'lvl'=>1, 'experience' => 0));

$personne = $personneManager->getListe();

foreach ($personne as $perso)
{
    print('<br/>' . $perso->getNom() . ' a ' . $perso->getHp() . ' d\'hp, ' . $perso->getDegats() . ' de dégâts, ' . $perso->getExperience() . ' d\'expérience et est au niveau' . $peros->getLvl());
}

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Si toutes les colonnes sont converties en string
    if ($db) {
        print('<br/>Lecture dans la base de données :');
        $personnemanager = new PersonneManager($db) ; // On lui attribue le db
       $personnes = $personnemanager->getListe();
        foreach ($personnes as $perso ) {
         
          // On passe les données (stockées dans un tableau) concernant le personnage au constructeur de la classe.
          // qui va être chargé d'assigner les valeurs qu'on lui a données, aux attributs correspondants               
          print('<br/>' . $perso->getNom() . ' a '. $perso->getHp() . ' d\'Hp, ' . $perso->getDegats()
            . ' de dégâts, ' . $perso->getExperience() . ' d\'expérience et est au niveau ' . $perso->getLvl());
        }
    }
} catch (PDOException $e) {
    print('<br/>Erreur de connexion : ' . $e->getMessage());
}

$_SESSION['perso'] = $perso;