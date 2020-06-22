<?php

function chargerClasse($classe)
{
    require $classe . '.php'; //Va chercher la classe nécéssaire
}

$dsn = 'mysql:dbname=raynfxeg_biblio;host=127.0.0.1';
$user = 'raynfxeg_biblio';
$password = 'raynBiblioAdmin.';

try {
    $db = new PDO($dsn, $user, $password);
    if ($db) {
        print('<br/>Lecture dans la base de données :');
        $request = $db->query('SELECT id, nom, degats,vie,experience FROM personnages;');
        while ($ligne = $request->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
        {
            print('<br/>' . $ligne['nom'] . ' a ' . $ligne['degats'] . ' de dégâts, '
                . $ligne['vie'] . ' de vie, ' . $ligne['experience'] . ' d\'expérience ');
        }
    }
} catch (PDOException $e) {
    print('<br/>Erreur de connexion : ' . $e->getMessage());
}

spl_autoload_register('chargerClasse');
$perso1 = new Personnage(['id'=>1, 'nom'=>"Philipe", 'degats'=>40, 'vie'=>20]);
$perso2 = new Personnage(['id'=>2, 'nom'=>"Michel",'degats'=>40, 'vie'=>20]);

$db = new PDO('mysql:host=127.0.0.1;dbname=raynfxeg_biblio', 'raynfxeg_biblio', 'raynBiblioAdmin.');
$manager = new PersonnagesManager($db);
$manager->add($perso1);
$manager->add($perso2);

$perso1->afficher();
$perso1->frapper($perso2);
$perso1->afficher();
$perso2->frapper($perso1);

$perso1->afficher();
$perso2->afficher();

Personnage::parler();

