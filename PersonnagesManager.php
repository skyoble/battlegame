<?php
class PersonnagesManager 
{
  private $_db;


  public function __construct($db)
  {
    $this->setDb($db);
  }
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
  public function add(Personnage $perso)
  {
    $request = $this->_db->prepare('INSERT INTO personnages SET nom = :nom, degats = :degats, vie = :vie, experience = :experience;');

      $request->bindValue(':nom', $perso->getNom(), PDO::PARAM_STR);
      $request->bindValue(':degats', $perso->getDegats(), PDO::PARAM_INT);
      $request->bindValue(':vie', $perso->getVie(), PDO::PARAM_INT);
      $request->bindValue(':experience', $perso->getExperience(), PDO::PARAM_INT);

    $request->execute();
  }

  public function delete(Personnage $perso)
  {
    $this->_db->exec('DELETE FROM personnages WHERE id = '.$perso->id().';');
  }
  public function getOne($id)
  {
    $id = (int) $id;

    $request = $this->_db->query('SELECT id, nom, degats, vie, experience FROM personnages WHERE id = '.$id.';');
    $ligne = $request->fetch(PDO::FETCH_ASSOC); // tableau d'accosier clef/valeur

    return new Personnage($ligne);
  }

  public function getList()
  {
    $persos = array();

    $request = $this->_db->query('SELECT id, nom, degats, vie, experience FROM personnages ORDER BY nom;');

    while ($ligne = $request->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($ligne);
    }

    return $persos;
  }

  public function update(Personnage $perso)
  {
    $request = $this->_db->prepare('UPDATE personnages SET nom = :nom, degats = :degats, vie = :vie, experience = :experience WHERE id = :id;');

      $request->bindValue(':id', $perso->getId(),PDO::PARAM_INT);
      $request->bindValue(':nom', $perso->getNom(), PDO::PARAM_STR);
      $request->bindValue(':degats', $perso->getDegats(), PDO::PARAM_INT);
      $request->bindValue(':vie', $perso->getVie(), PDO::PARAM_INT);
      $request->bindValue(':experience', $perso->getExperience(), PDO::PARAM_INT);

    $request->execute();
  }
}

