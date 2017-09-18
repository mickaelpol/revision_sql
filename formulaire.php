<?php 
include('page/lib/connection.php');


	//fonction qui verifie si les inputs sont bien remplis 
function testInputRemplis($fichier){
	if (empty($_POST[$fichier])) {
		return '<span class="text-danger"> le champ '.$fichier. ' est vide <br></span>';
	}
}


	//verification a la soumissions du formulaire
if (isset($_POST['valid'])) {
	$erreur = "";

	$errProduit = ' : ' .testInputRemplis('produit');
	$errPrix = ' : ' .testInputRemplis('prix');
	$errImg = ' : ' .testInputRemplis('image');

		//condition de la validation du formulaire

	if (empty($erreur)) {

		try {
			$bdd = new 
				//connection a la BDD
			PDO('mysql:host='.$serveur.';dbname='.$dbname.';charset=utf8', $user, $admin);
		} 
		catch (Exception $e) {
				//si erreur lance l'affichage de l'erreur et stoppe la suite
			die('Erreur: ' .$e->getMessage());
		}

		//preparation des valeurs a envoyer dans la base de données
		$produit = htmlspecialchars($_POST['produit']);
		$prix = htmlspecialchars($_POST['prix']);
		$image = htmlspecialchars($_POST['image']);

		//preparation de la requete 
		$sql = sprintf('INSERT INTO produit(pro_product_name, pro_price, pro_image) VALUES ("%s", "%s", "%s");', $produit, $prix, $image);

		//execution de la requetes et verification 
		if ($bdd->exec($sql) ==1) {
			$erreur = "<div class='container-fluid text-center'" . "<p><span class='text-success text-uppercase'> formulaire envoyé </span></p>" . "<br>" . "<div class='loader center-block marge-bot'></div>" . "</div>";
		}
		else {
			$erreur = "<div class='container-fluid text-center'" . "<p><span class='text-danger text-uppercase'> les informations que vous avez envoyé sont déjà dans la base de données </span></p>"."</div>";
		}
	}

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>formulaires</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
</head>
<body>

	<form action="formulaire.php" method="post">
		<label for="produit">Produit <?= isset($errProduit) ? $errProduit: "" ?></label> <br>
		<input name="produit" id="produit" type="text"> <br>

		<label for="prix">Prix <?= isset($errPrix) ? $errPrix: "" ?></label> <br>
		<input name="prix" id="prix" type="number"> <br>

		<label for="image">Image <?= isset($errImg) ? $errImg: "" ?></label> <br>
		<input name="image" id="image" type="text"> <br>

		<input name="valid" type="submit">
	</form>

	<?= isset($erreur) ? $erreur : "" ?> 

</body>
</html>
