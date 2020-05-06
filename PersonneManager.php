<?php
class PersonneManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb($db)
    {
        $this->_db = $_db;
        return $this;
    }

    public function add(Personne $perso)
    {
        $request = $this->_db->prepare('INSERT INTO personnages SET nom = :nom,
      `hp` = :hp, degats = :degats, niveau = :niveau, experience = :experience;');

        $request->bindValue(':nom', $perso->getNom(), PDO::PARAM_STR);
        $request->bindValue(':hp', $perso->getHp(), PDO::PARAM_INT);
        $request->bindValue(':degats', $perso->getDegats(), PDO::PARAM_INT);
        $request->bindValue(':lvl', $perso->getLvl(), PDO::PARAM_INT);
        $request->bindValue(':experience', $perso->getExperience(), PDO::PARAM_INT);

        $request->execute();
    }
    public function getListe()
    {
        $liste = array();

        $request = $this->_db->query('SELECT * FROM personnages;');

        return $liste;
    }

}
