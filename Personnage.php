<?php

class Personnage
{
    // Attribue, Constante et Statique 

    //Dépend de l'objet
    private $_id;
    private $_nom;
    private $_vie;
    private $_degats;
    private $_experience;

    //Appartient à la classe 

    //Ne change pas
    const DEGATS_PETIT = 20;
    const DEGATS_MOYEN = 50;
    const DEGATS_FORT = 80;

    // Peux être modifier 
    private static $_texteADire = 'La partie est démarrée. Qui veut se battre !';

    public function __construct($id, $nom, $vie = 20, $degats = 5, $experience = 0)
    {
        $this->_id = $id;
        $this->setNom($nom);
        $this->setVie($vie);
        $this->setDegats($degats);
        $this->setExperience($experience);
        print('<br/> Le personnage ' . $nom . ' est créé !');
    }

    // -----------------------------------------------------------------------------------------------------------------------------------------------------------
    //Mutateur chargé de modifier l'attribut, pour vérifier les conditions de modification de l'attribut.
    // -----------------------------------------------------------------------------------------------------------------------------------------------------------
    public function setNom($nom)
    {
        if (!is_string($nom)) // S'il ne s'agit pas d'un texte.
        {
            trigger_error('Le nom d\'un personnage doit être un texte', E_USER_WARNING);
            return;
        }
        $this->_nom = $nom;
    }
    public function setVie($vie)
    {
        if ($vie == 0) // S'il n'est pas nul.
        {
            trigger_error('La vie d\'un personnage doit être supérieur à 0', E_USER_WARNING);
            return;
        }
        if (!is_int($vie)) // S'il ne s'agit pas d'un entiers.
        {
            trigger_error('La vie d\'un personnage doit être un entier', E_USER_WARNING);
            return;
        }
        $this->_vie = $vie;
    }
    public function setDegats($degats)
    {
        if (!is_int($degats)) 
        {
            trigger_error('Les dégâts d\'un personnage doit être un entier', E_USER_WARNING);
            return;
        }
        // On vérifie qu'on nous donne bien soit un "DEGATS_PETIT", soit un "DEGATS_MOYEN", soit un "DEGATS_FORT".
        if (!in_array($degats, array(self::DEGATS_PETIT, self::DEGATS_MOYEN, self::DEGATS_FORT))) {
            trigger_error('Les dégâts du personnage ' . $this->getNom() . 'ne sont pas de soit 20 , 50 ou 80', E_USER_WARNING);
            return;
        }
        $this->_degats = $degats;

    }
    public function setExperience($experience)
    {
        if (!is_int($experience)) 
        {
            trigger_error('L\'expérience d\'un personnage doit être un entier', E_USER_WARNING);
            return;
        }
        $this->_experience = $experience;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------------------------
    //Accesseur
    // -----------------------------------------------------------------------------------------------------------------------------------------------------------
    public function getNom()
    {
        return $this->_nom;
    }

    public function getVie()
    {
        return $this->_vie;
    }

    public function getDegats()
    {
        return $this->_degats;
    }

    public function getExperience()
    {
        return $this->_experience;
    }

    // -----------------------------------------------------------------------------------------------------------------------------------------------------------
    //Function utile
    // -----------------------------------------------------------------------------------------------------------------------------------------------------------
    public function afficher()
    {
        print('<br/> Le personnage : ' . $this->getNom() . ' possède,  ' . $this->getVie() . ' point de vie, '
            . $this->getDegats() . ' point de dégâts et ' . $this->getExperience() . ' point d\'éxpérience ');
    }
    public function frapper(Personnage $adversaire)
    {
        $adversaire->_vie -= $this->_degats;
        $this->gagnerExperience();
        print('<br/>' . $this->getNom() . ' frappe avec un coup normal ' . $adversaire->getNom() . ' et inflige  = ' . $this->getDegats()
            . ' point de dégâts. <br/> Il reste a ' . $adversaire->getNom() . ' , ' . $adversaire->getVie() . ' Point de vie');
    }

    public function gagnerExperience()
    {
        $this->_experience += 1;
    }

    public static function parler() // Le static permet de faire une fonction qui est pour la classe et non pour l'objets
    {
        print('Je suis le 3ème personnage');
    }
}
