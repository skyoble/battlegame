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
        $this->_db = $db;
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
    public function delete(Personne $perso)
    {
        $this->_db->prepare('DELETE FROM personne WHERE id = :id;');
        $request->bindValue(':id',$perso->getId(),PDO::PARAM_INT);
        $request->execute();
    }
    public function getOne($id)
    {
        $id = (int) $id;

        $request = $this->_db->prepare('SELECT id, nom, hp, lvl, experience FROM personnages WHERE id = :id;');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute();

        $ligne = $request->fetch(PDO::FETCH_ASSOC);

        return new Personne($ligne);
    }
    public function getListe()
    {
        $liste = array();

        // $request = $this->_db->query('SELECT * FROM personnages;');

        $sql =  'SELECT * FROM personnages;';
        $rows = $this->_db->query($sql) ; // Exécuter la requete à partir de la base 
        foreach  ($rows as $row) {
            $perso = new Personne ($row);
            $liste[]= $perso;         // ajout d'un personnnage à un tableau 
        }

        return $liste;
    }
    public function update(Personne $perso)
    {
        $request = $this->_db->prepare('UPDATE personne SET hp = :hp, degats = :degats, lvl = :lvl, experience = :experience WHERE id = :id;');

        $request->bindValue(':hp', $perso-> getForce(), PDO::PARAM_INT);
        $request->bindValue(':degats', $perso-> getDegats(), PDO::PARAM_INT);
        $request->bindValue(':lvl', $perso-> getLvl(), PDO::PARAM_INT);
        $request->bindValue(':experience', $perso-> getExperience(), PDO::PARAM_INT);
        $request->bindValue(':Id', $perso-> getId(), PDO::PARAM_INT);

        $request->execute();
    }
    

}
