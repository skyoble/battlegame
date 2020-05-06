<?php

class Personne
{
    private $id = 0;
    private $_nom = 'inconnu'; // Attribue priver
    private $_experience = 0;
    private $_degats = 0;
    private $_Hp = 0;
    private $_lvl = 0;
    private static $_compteur =0; // Attribue de la class ( en gros marche sur tout les objets) Faut pour l'appeler self::

    public function __construct(array $ligne)
    {
        $this->hydrate($ligne);
        self::$_compteur++ ;
        print('<br/> Le personnage"' . $this->getNom() . '"est crée !'); // Message s'affiche
    }

    public function hydrate(array $ligne) // hydratation c'est associer une ligne une table à une entiter
    {
        foreach ($ligne as $key => $value)
        {
            //On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            //Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                //on appelle le setter.
                $this->$method($value);
            }
        }
      
    }
    public static function parler()  // pas besoin du this sa pointe directement
    {
        print('<br/>Il y a '.self::$_compteur.' personnage');
    }
    public function __toString()
    {
        return '<br/>' . $this->getNom() . ' a ' .$this->getHP() . ' point de vie et '. $this->getDegats().' Dégâts' ;
    }

    public function setId($id)
    {
        
        if(! is_int($id))
        {
            trigger_error('L\'id du personnage doit être une valeur int', E_USER_ERROR);
        }
        else{
            $this->_id = $id;
        }
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setNom($nom) //Mutateur permet de changer un attribue  et de vérifier si la donner est correct
    {
        if(! is_string($nom))
        {
            trigger_error('la force du personnage doit être une valeur string.' , E_USER_ERROR);
         }
        else{
            $this->_nom = $nom;
        }
    }
   public function getNom() // acesseur 
   {
       return $this->_nom ;
   }
    
    public function setDegats($degats)
    {
        if(! is_int($degats))
        {
            trigger_error('la force du personnage doit être une valeur entière.', E_USER_ERROR);
         }
        else{
            $this->_degats = $degats;
        }
    }
    public function getDegats() // acesseur 
   {
       return $this->_degats ;
   }
    public function setHp($Hp)
    {
        if( !is_int($Hp))
        {
            trigger_error('la vie du personnage doit être une valeur entière.', E_USER_ERROR);
         }
        else{
            $this->_Hp = $Hp;
        }
    }
    public function getHp() // acesseur 
   {
       return $this->_Hp ;
   }
   public function setLvl($lvl)
    {
        $lvl = (int) $lvl;
        if( $lvl >= 1 && $lvl <= 100)
        {
            $this->_lvl = $lvl;
         }
    }
    public function getLvl() // acesseur 
   {
       return $this->_lvl ;
   }

   public function setExperience($experience)
    {
        $experience = (int) $experience;
        if( $experience >= 1 && $experience <= 100)
        {
            $this->_experience = $experience;
         }
    }

    public function getExperience()
    {
        return $this->_experience;
    }
    
    public function frapper(Personne $adversaire)
    {
        $adversaire->_Hp -= $this->_degats;
        print('<br/>' . $this->_nom . ' tape ' . $adversaire->_nom . ' et inflige  = ' . $this->_degats
            . ' point de dégâts. <br/> Il reste a ' . $adversaire->_nom . ' ' . $adversaire->_Hp . ' Point de vie');
    }
    public function afficherXp()
    {
        print("<br/>Les points d'expérience de : " . $this->_nom . ' est de :' . $this->_experience);
    }
    public function afficherInfo()
    {
        print("<br/> Les stats de " . $this->_nom . ' sont de :<br/> ' . $this->_Hp .' point de vie <br/>'. $this->_experience .' expérience <br/>'. $this->_degats .' Point de dégâts ' );
    }
}


