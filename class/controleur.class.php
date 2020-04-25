<?php
class controleur {

	private $vpdo;
	private $db;
	public function __construct() {
		$this->vpdo = new mypdo ();
		$this->db = $this->vpdo->connexion;
	}
	public function __get($propriete) {
		switch ($propriete) {
			case 'vpdo' :
			{
				return $this->vpdo;
				break;
			}
			case 'db' :
			{

				return $this->db;
				break;
			}
		}
	}
	public function retourne_article($title)
	{

		$retour='<section>';
		$result = $this->vpdo->liste_article($title);
		if ($result != false) {
			while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
				// parcourir chaque ligne sélectionnée
			{

				$retour = $retour . '<div class="card text-white bg-dark m-2" ><div class="card-body">
				<article>
					<h3 class="card-title">'.$row->h3.'</h3>
					<h6 class="card-subtitle mb-2 text-muted">'.$row->prenom.' '.$row->nom.' '.$row->date_redaction.'</h6>
					<div class="content HideContent">
					    <p class="card-text">'.$row->corps.'</p>
					</div> 
					<button type="button" class="btn btn-success showhide">+</button>
				</article>
				</div></div>';
			}
			$retour = $retour .'</section>';
			return $retour;
		}
	}
	public function retourne_tableau_departement()
	{

		$retour='<section><div class ="table-responsive">
<table id="mogue" class="table table-striped table-bordered" cellspacing="0">
<thead>
   <tr>
   <th>Code département</th>
		<th>Département</th>
		<th>Région</th>
   
</tr></thead>';
		$result = $this->vpdo->liste_dep();
		if ($result != false) {
			while ($row = $result->fetch(PDO::FETCH_OBJ)) // parcourir chaque ligne sélectionnée
			{

				$retour = $retour . '

<tr>
        <td>' . $row->departement_code . '</td>
        <td>' . $row->departement_nom . '</td>
        <td>' . $row->libel . '</td>
    </tr>';
			}
		}
		$retour = $retour . '</table></div></section>';
			return $retour;

	}

	public function retourne_flexbox($p)
	{

		$retour = '<div class="card text-white bg-dark m-2 card-body flexbox " >';
		$result = $this->vpdo->liste_flexbox() ;
		if ($result != false) {
			while ($row = $result->fetch(PDO::FETCH_OBJ)) {
				$retour = $retour . '
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 container .grid-container ">
		<div class="hovereffect">
		<img src="'.$p.'/image/france/IMAGES_RES/'.$row->image.'" alt="/image/erreur-404.png" class="">
			
				<div class="overlay">
					<div>'.$row->titre.'</div>
					<div class="text" >'.$row->texte.'</div>
				</div>
		</div>
		</div>';
			}
			$retour = $retour .'</div>';
			return $retour;
		}
	}
	/*public function retourne_galerie($chemin)
	{
		$retour = '<div class="d-flex flex-row flex-wrap justify-content-center " >';
		$result = $this->vpdo->liste_galerie();
		if ($result != false) {
			while ($row = $result->fetch(PDO::FETCH_OBJ)) {
				$retour = $retour . '
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 container .grid-container">
        <div class="hovereffect">
        <img src="'.$chemin.'/image/france/IMAGESRES/'.$row->image.'" alt="/image/erreur-404.png" class="image">
            
                <div class="overlay">
                    <div>'.$row->titre.'</div>
                    <div class="text" >'.$row->texte.'</div>
                </div>
        </div>
    </div>';
			}
			$retour = $retour .'</div>';
			return $retour;
		}
		/*$retour='<div class="galerie">
					<img src="'.$chemin.'/image/france/IMAGESRES/Bassin arcahon.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Bassin-dArcachon.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Bonifacio.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/camargue.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/camargue1.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/carcassonne.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/chateau-de-chambord.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/chateau-de-chenonceau.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Cirque-de-gavarnie.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Gorges-du-Tarn.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/gravures-rupestres-vallee-des-merveilles-region-mont-bego.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Mont-saint-michel.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Mont-Saint-Michel_vu_du_ciel.jpg.jpg" alt="alt">
					<img src="'.$chemin.'/image/france/IMAGESRES/Orgues_ille_sur_tet.jpg.jpg" alt="alt">
					</div>';
			return $retour;

	}*/
	public function retourne_galerie($chemin)
	{

		$retour = '<div class="container-fluid bg-dark m-2">
		<div class="d-flex flex-row flex-wrap justify-content-center">';
		$result = $this->vpdo->liste_galerie() ;
		if ($result != false) {
			while ($row = $result->fetch(PDO::FETCH_OBJ)) {
				$retour = $retour . '
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 container .grid-container ">
        <div class="hovereffect d-flex flex-column">
        	<img src="'.$chemin.'/image/france/IMAGESRES/'.$row->image.'" alt="/image/erreur-404.png" class="img-fluid">
            
                <div class="overlay">
                	<div class="text d-flex justify-content-center">
                    	<h5>'.$row->titre.'</h5>
                	</div>
                </div>
        </div>
    </div>';
			}
			$retour = $retour .'</div>';
			return $retour;
		}
	}




	public function genererMDP ($longueur = 8){
		// initialiser la variable $mdp
		$mdp = "";

		// Définir tout les caractères possibles dans le mot de passe,
		// Il est possible de rajouter des voyelles ou bien des caractères spéciaux
		$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ&#@$*!";

		// obtenir le nombre de caractères dans la chaîne précédente
		// cette valeur sera utilisé plus tard
		$longueurMax = strlen($possible);

		if ($longueur > $longueurMax) {
			$longueur = $longueurMax;
		}

		// initialiser le compteur
		$i = 0;

		// ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
		while ($i < $longueur) {
			// prendre un caractère aléatoire
			$caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);

			// vérifier si le caractère est déjà utilisé dans $mdp
			if (!strstr($mdp, $caractere)) {
				// Si non, ajouter le caractère à $mdp et augmenter le compteur
				$mdp .= $caractere;
				$i++;
			}
		}

		// retourner le résultat final
		return $mdp;
	}
	public function retourne_formulaire_login() {
		$retour = '
		<div class="modal fade" id="myModal" role="dialog" style="color:#000;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
        				<h4 class="modal-title"><span class="fas fa-lock"></span> Formulaire de connexion</h4>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hd();">
          					<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
					<div class="modal-body">
						<form role="form" id="login" method="post">
							<div class="form-group">
								<label for="id"><span class="fas fa-user"></span> Identifiant</label>
								<input type="text" class="form-control" id="id" name="id" placeholder="Identifiant">
							</div>
							<div class="form-group">
								<label for="mp"><span class="fas fa-eye"></span> Mot de passe</label>
								<input type="password" class="form-control" id="mp" name="mp" placeholder="Mot de passe">
							</div>
							<div class="form-group">
								<label class="radio-inline"><input type="radio" name="rblogin" id="rbj" value="rbj">Journaliste</label>
								<label class="radio-inline"><input type="radio" name="rblogin" id="rbr" value="rbr">Rédacteur en chef</label>
								<label class="radio-inline"><input type="radio" name="rblogin" id="rba" value="rba">Administrateur</label>
							</div>
							<button type="submit" class="btn btn-success btn-block" class="submit"><span class="fas fa-power-off"></span> Login</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button"  class="btn btn-danger btn-default pull-left" data-dismiss="modal" onclick="hd();"><span class="fas fa-times"></span> Cancel</button>
					</div>
				</div>
			</div>
		</div>';

		return $retour;
	}

	public function retourne_modal_message()
	{
		$retour='
		<div class="modal fade" id="ModalRetour" role="dialog" style="color:#000;">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
        				<h4 class="modal-title"><span class="fas fa-info-circle"></span> INFORMATIONS</h4>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hd();">
          					<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
		       		<div class="modal-body">
						<div class="alert alert-info">
							<p></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="hdModalRetour();">Close</button>
					</div>
				</div>
			</div>
		</div>
		';
		return $retour;
	}	

	public function dating()
	{
		date_default_timezone_set('Europe/Lisbon');
		$date = date('m/d/Y h:i:s a', time());
		return $date;
	}

}

?>
