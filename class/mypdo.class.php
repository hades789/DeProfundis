<?php
class mypdo extends PDO{

    private $PARAM_hote='localhost'; // le chemin vers le serveur
    private $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
    private $PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
    private $PARAM_nom_bd='tourisme_france';
    private $connexion;
    public function __construct() {
    	try {
    		
    		$this->connexion = new PDO('mysql:host='.$this->PARAM_hote.';dbname='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    		//echo '<script>alert ("ok connex");</script>)';echo $this->PARAM_nom_bd;
    	}
    	catch (PDOException $e)
    	{
    		echo 'hote: '.$this->PARAM_hote.' '.$_SERVER['DOCUMENT_ROOT'].'<br />';
    		echo 'Erreur : '.$e->getMessage().'<br />';
    		echo 'N° : '.$e->getCode();
    		$this->connexion=false;
    		//echo '<script>alert ("pbs acces bdd");</script>)';
    	}
    }
    public function __get($propriete) {
    	switch ($propriete) {
    		case 'connexion' :
    			{
    				return $this->connexion;
    				break;
    			}
    	}
    }
    
    public function liste_article($title)
    {

		$requete='select a.h3,a.corps, s.prenom, s.nom, a.date_redaction, a.num_ordre from article a,page p, salarie s where a.page=p.id and p.title="'.$title.'"and s.id=a.salarie and CURRENT_DATE BETWEEN date_deb and date_fin or date_fin IS NULL  and a.publie=1 group by a.num_ordre asc;';
    	//$requete='select a.h3,a.corps, a.date_redaction, s.nom, s.prenom, g.intitule from article a,page p,salarie s,grade g where a.page=p.id and s.grade=g.id and a.publie=1 and a.date_deb<current_date and a.date_fin>current_date and s.id=a.salarie and p.title="'.$title.'";';
        $result=$this->connexion ->query($requete);
    	if ($result)
    
    	{
  		
    			return ($result);
   		}
    	return null;
    }

	public function liste_flexbox()
	{
		$requete=' select image,titre,texte from highlight';
		$result=$this->connexion ->query($requete);
		if ($result)

		{

			return ($result);
		}
		return $this->PARAM_nom_bd;
	}
    public function liste_dep()
    {
    
    	$requete='SELECT departement_code,departement_nom,libel FROM departement,region,departement_region WHERE departement_code= code_dep and code_reg=code order by departement_code;';
    
    	$result=$this->connexion ->query($requete);
    	if ($result)
    
    	{
    
    		return ($result);
    	}
    	return null;
    }
	public function liste_galerie()
	{

		$requete='SELECT image,titre,texte FROM highlight';

		$result=$this->connexion ->query($requete);
		if ($result)

		{

			return ($result);
		}
		return $this->PARAM_nom_bd;
	}
    
}
?>
