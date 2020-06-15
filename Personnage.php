<?php

class Personnage
{
    private $_id ;
    private $_nom ;
    private $_vie  ;
    private $_degats ;
    private $_experience  ;

    public function __construct ($id , $nom, $vie = 20, $degats = 5  , $experience = 0) 
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
        if ($vie==0) // S'il ne s'agit pas d'un texte.
        {
            trigger_error('La vie d\'un personnage doit être supérieur à 0', E_USER_WARNING);
            return;
        }
        if (!is_int($vie)) // S'il ne s'agit pas d'un texte.
        {
            trigger_error('La vie d\'un personnage doit être un entier', E_USER_WARNING);
            return;
        }
        $this->_vie = $vie;
    } 
    public function setDegats($degats)
    {
        if (!is_int($degats)) // S'il ne s'agit pas d'un texte.
        {
            trigger_error('Les dégâts d\'un personnage doit être un entier', E_USER_WARNING);
            return;
        }
        if ($degats > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
        {
            trigger_error('Les dégâts d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }
        $this->_degats = $degats;
    } 
    public function setExperience($experience)
    {
        if (!is_int($experience)) // S'il ne s'agit pas d'un texte.
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
        print ('<br/> Le personnage : ' . $this->_nom . ' possède,  '. $this->_vie . ' point de vie, '
               . $this->_degats . ' point de dégâts et '. $this->_experience . ' point d\'éxpérience ');
    }
    public function frapper(Personnage $adversaire)
    {
        $adversaire->_vie -= $this->_degats;
        $this->gagnerExperience();
        print('<br/>' . $this->_nom . ' frappe avec un coup normal ' . $adversaire->_nom . ' et inflige  = ' . $this->_degats
            . ' point de dégâts. <br/> Il reste a ' . $adversaire->_nom . ' , ' . $adversaire->_vie . ' Point de vie');
    }

    public function gagnerExperience ()
    {
        $this->_experience += 1;
    }
}
