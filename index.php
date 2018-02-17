<?php

function isExist($var){
	if (isset($var)){
	  echo $var;
	}
  }

  if(isset($_POST['submit'])){

	$options = array(
		'prenom' 		=> FILTER_SANITIZE_STRING,
		'nom' 			=> FILTER_SANITIZE_STRING,
		'email' 		=> FILTER_VALIDATE_EMAIL,
		'message' 		=> FILTER_SANITIZE_STRING,
		'genre' 		=> FILTER_SANITIZE_STRING,
		'problemes' 	=> FILTER_SANITIZE_STRING,
		'sav' 			=> FILTER_SANITIZE_STRING,
		'suivis' 		=> FILTER_SANITIZE_STRING,
		'captcha' 		=> FILTER_SANITIZE_NUMBER_INT);

	$result = filter_input_array(INPUT_POST, $options);
	$checkResult =[];	 

	$prenom = trim($_POST['prenom']);
	$nom = trim($_POST['nom']);
	$email = trim($_POST['email']);
	$pays = trim($_POST['pays']);
	$message = trim($_POST['message']);
	$genre = trim($_POST['genre']);
	$question1 = trim($_POST['problemes']);
	$question2 = trim($_POST['sav']);
	$question3 = trim($_POST['suivis']);
	
	$nombreErreur = 0; // Variable qui compte le nombre d'erreur

	if (!isset($_POST['prenom'])) {
		$nombreErreur++;
		$erreur1 = '<p>Il y a un problème avec la variable "prénom".</p>';
	  } else {
		if (empty($_POST['prenom'])) {
		  $nombreErreur++;
		  $erreur2 = "<p>Vous avez oublié d'entrer votre prénom.</p>";
		}
	}

	if (!isset($_POST['nom'])) {
		$nombreErreur++;
		$erreur3 = '<p>Il y a un problème avec la variable "nom".</p>';
	  } else {
		if (empty($_POST['nom'])) {
		  $nombreErreur++;
		  $erreur4 = "<p>Vous avez oublié d'entrer votre nom.</p>";
		}
	}

	// Définit toutes les erreurs possibles
	if (!isset($_POST['email'])) { // Si la variable "email" du formulaire n'existe pas (il y a un problème)
	  $nombreErreur++; // On incrémente la variable qui compte les erreurs
	  $erreur5 = '<p>Il y a un problème avec la variable "email".</p>';
	} else { // Sinon, cela signifie que la variable existe (c'est normal)
	  if (empty($_POST['email'])) { // Si la variable est vide
		$nombreErreur++; // On incrémente la variable qui compte les erreurs
		$erreur6 = '<p>Vous avez oublié de donner votre email.</p>';
	  } else {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		  $nombreErreur++; // On incrémente la variable qui compte les erreurs
		  $erreur7 = '<p>Cet email ne ressemble pas un email.</p>';
		}
	  }
	}

	if (!isset($_POST['pays'])) {
		$nombreErreur++;
		$erreur8 = '<p>Il y a un problème avec la variable "pays".</p>';
	  } else {
		if (empty($_POST['pays'])) {
		  $nombreErreur++;
		  $erreur9 = "<p>Vous avez oublié de sélectionner votre pays.</p>";
		}
	}

	if (!isset($_POST['message'])) {
	  $nombreErreur++;
	  $erreur10 = '<p>Il y a un problème avec la variable "message".</p>';
	} else {
	  if (empty($_POST['message'])) {
		$nombreErreur++;
		$erreur11 = '<p>Vous avez oublié de donner un message.</p>';
	  }
	}

	if (!isset($_POST['genre'])) {
		$nombreErreur++;
		$erreur12 = '<p>Vous avez oublié de spécifier votre sexe.</p>';
	} 

	if (!isset($_POST['captcha'])) {
	  $nombreErreur++;
	  $erreur13 = '<p>Il y a un problème avec la variable "captcha".</p>';
	} else {
	  if ($_POST['captcha']!=4) {
		$nombreErreur++;
		$erreur14 = '<p>Désolé, le captcha anti-spam est erroné.</p>';
	  }
	}

	if ($nombreErreur==0) {

	// Variables concernant l'email
	$destinataire = 'kevcharlier@gmail.com'; // Adresse email du webmaster
	$titremail = 'Titre du message'; // Titre de l'email
	$contenu = '<html><head><title>Titre du message</title></head><body>';
	$contenu .= '<p>Bonjour, vous avez reçu un message à partir de votre site web.</p>';
	$contenu .= '<p><strong>Nom</strong>: '.$nom.'</p>';
	$contenu .= '<p><strong>Prénom</strong>: '.$prenom.'</p>';
	$contenu .= '<p><strong>Genre</strong>: '.$genre.'</p>';
	$contenu .= '<p><strong>Pays</strong>: '.$pays.'</p>';
	$contenu .= '<p><strong>Email</strong>: '.$email.'</p>';
	$contenu .= '<p><strong>Message</strong>: '.$message.'</p>';
	$contenu .= '<p><strong>Sujet 1</strong>: '.$question1.'</p>';
	$contenu .= '<p><strong>Sujet 2</strong>: '.$question2.'</p>';
	$contenu .= '<p><strong>Sujet 3</strong>: '.$question3.'</p>';
	$contenu .= '</body></html>'; // Contenu du message de l'email

	// Pour envoyer un email HTML, l'en-tête Content-type doit être défini
	$headers = 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

	@mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
	header("Location: merci.php?prenom=$prenom");

	} else { // S'il y a un moins une erreur

	echo '<div style="border:1px solid #ff0000; padding:5px;">';
	echo '<p style="color:#ff0000;">Désolé, il y a eu '.$nombreErreur.' erreur(s). Voici le détail des erreurs:</p>';
	if (isset($erreur1)) echo '<p>'.$erreur1.'</p>';
	if (isset($erreur2)) echo '<p>'.$erreur2.'</p>';
	if (isset($erreur3)) echo '<p>'.$erreur3.'</p>';
	if (isset($erreur4)) echo '<p>'.$erreur4.'</p>';
	if (isset($erreur5)) echo '<p>'.$erreur5.'</p>';
	if (isset($erreur6)) echo '<p>'.$erreur6.'</p>';
	if (isset($erreur7)) echo '<p>'.$erreur7.'</p>';
	if (isset($erreur8)) echo '<p>'.$erreur8.'</p>';
	if (isset($erreur9)) echo '<p>'.$erreur9.'</p>';
	if (isset($erreur10)) echo '<p>'.$erreur10.'</p>';
	if (isset($erreur11)) echo '<p>'.$erreur11.'</p>';
	if (isset($erreur12)) echo '<p>'.$erreur12.'</p>';
	if (isset($erreur13)) echo '<p>'.$erreur13.'</p>';
	if (isset($erreur14)) echo '<p>'.$erreur14.'</p>';
	echo '</div>';
	}
  	}
	?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="mywebfont/stylesheet.css" type="text/css" charset="utf-8" />
		<title>Hackers Poulette</title>
	</head>
	<body>
		<div class="wrap">
			<div class="header">
				<h1>Hackers Poulette</h1>
				<h2>Bienvenue dans l'espace web réservé a la société <span>Hackers Poulette</span> (vente d'accessoires & kits pour Rasperri Pi).</h2>
			</div>
			<div class="logo">
				<p>
					<img src="images/hackers-poulette-logo.png" alt="hackers-poulette-logo">
				</p>
			</div>
			<div class="contact">
				<h3>Besoin d'aide ? Veuillez remplir ce formulaire de contact afin que nous puissions vous aider !</h3>
			</div>
			<div class="formulaire">
			<form action="index.php" method="POST" name="formulaire" id="formulaire">
					<p>
						<input placeholder="Prénom" <?php $value=$prenom; echo "value='$prenom'" ?> id="inputprenom" type="text" name="prenom"/>
					</p>
					<p>
						<input placeholder="Nom" <?php $value=$nom; echo "value='$nom'" ?> id="inputnom" type="text" name="nom">
					</p>
					<p>
						<input placeholder="E-mail" <?php $value=$email; echo "value='$email'" ?> id="inputemail" type="email" name="email"/>
					</p>
					<p>
							<select id="inputpays" name="pays" >
							<option value="">Sélectionner votre pays</option>
							<optgroup label="Afrique">
							<option value="afriqueDuSud">Afrique Du Sud</option>
							<option value="algerie">Algérie</option>
							<option value="angola">Angola</option>
							<option value="benin">Bénin</option>
							<option value="botswana">Botswana</option>
							<option value="burkina">Burkina</option>
							<option value="burundi">Burundi</option>
							<option value="cameroun">Cameroun</option>
							<option value="capVert">Cap-Vert</option>
							<option value="republiqueCentre-Africaine">République Centre-Africaine</option>
							<option value="comores">Comores</option>
							<option value="republiqueDemocratiqueDuCongo">République Démocratique Du Congo</option>
							<option value="congo">Congo</option>
							<option value="coteIvoire">Côte d'Ivoire</option>
							<option value="djibouti">Djibouti</option>
							<option value="egypte">Égypte</option>
							<option value="ethiopie">Éthiopie</option>
							<option value="erythrée">Érythrée</option>
							<option value="gabon">Gabon</option>
							<option value="gambie">Gambie</option>
							<option value="ghana">Ghana</option>
							<option value="guinee">Guinée</option>
							<option value="guinee-Bisseau">Guinée-Bisseau</option>
							<option value="guineeEquatoriale">Guinée Équatoriale</option>
							<option value="kenya">Kenya</option>
							<option value="lesotho">Lesotho</option>
							<option value="liberia">Liberia</option>
							<option value="libye">Libye</option>
							<option value="madagascar">Madagascar</option>
							<option value="malawi">Malawi</option>
							<option value="mali">Mali</option>
							<option value="maroc">Maroc</option>
							<option value="maurice">Maurice</option>
							<option value="mauritanie">Mauritanie</option>
							<option value="mozambique">Mozambique</option>
							<option value="namibie">Namibie</option>
							<option value="niger">Niger</option>
							<option value="nigeria">Nigeria</option>
							<option value="ouganda">Ouganda</option>
							<option value="rwanda">Rwanda</option>
							<option value="saoTomeEtPrincipe">Sao Tomé-et-Principe</option>
							<option value="senegal">Séngal</option>
							<option value="seychelles">Seychelles</option>
							<option value="sierra">Sierra</option>
							<option value="somalie">Somalie</option>
							<option value="soudan">Soudan</option>
							<option value="swaziland">Swaziland</option>
							<option value="tanzanie">Tanzanie</option>
							<option value="tchad">Tchad</option>
							<option value="togo">Togo</option>
							<option value="tunisie">Tunisie</option>
							<option value="zambie">Zambie</option>
							<option value="zimbabwe">Zimbabwe</option>
							</optgroup>
							<optgroup label="Amérique">
							<option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
							<option value="argentine">Argentine</option>
							<option value="bahamas">Bahamas</option>
							<option value="barbade">Barbade</option>
							<option value="belize">Belize</option>
							<option value="bolivie">Bolivie</option>
							<option value="bresil">Brésil</option>
							<option value="canada">Canada</option>
							<option value="chili">Chili</option>
							<option value="colombie">Colombie</option>
							<option value="costaRica">Costa Rica</option>
							<option value="cuba">Cuba</option>
							<option value="republiqueDominicaine">République Dominicaine</option>
							<option value="dominique">Dominique</option>
							<option value="equateur">Équateur</option>
							<option value="etatsUnis">États Unis</option>
							<option value="grenade">Grenade</option>
							<option value="guatemala">Guatemala</option>
							<option value="guyana">Guyana</option>
							<option value="haiti">Haïti</option>
							<option value="honduras">Honduras</option>
							<option value="jamaique">Jamaïque</option>
							<option value="mexique">Mexique</option>
							<option value="nicaragua">Nicaragua</option>
							<option value="panama">Panama</option>
							<option value="paraguay">Paraguay</option>
							<option value="perou">Pérou</option>
							<option value="saintCristopheEtNieves">Saint-Cristophe-et-Niévès</option>
							<option value="sainteLucie">Sainte-Lucie</option>
							<option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
							<option value="salvador">Salvador</option>
							<option value="suriname">Suriname</option>
							<option value="triniteEtTobago">Trinité-et-Tobago</option>
							<option value="uruguay">Uruguay</option>
							<option value="venezuela">Venezuela</option>
							</optgroup>
							<optgroup label="Asie">
							<option value="afghanistan">Afghanistan</option>
							<option value="arabieSaoudite">Arabie Saoudite</option>
							<option value="armenie">Arménie</option>
							<option value="azerbaidjan">Azerbaïdjan</option>
							<option value="bahrein">Bahreïn</option>
							<option value="bangladesh">Bangladesh</option>
							<option value="bhoutan">Bhoutan</option>
							<option value="birmanie">Birmanie</option>
							<option value="brunei">Brunéi</option>
							<option value="cambodge">Cambodge</option>
							<option value="chine">Chine</option>
							<option value="coreeDuSud">Corée Du Sud</option>
							<option value="coreeDuNord">Corée Du Nord</option>
							<option value="emiratsArabeUnis">Émirats Arabe Unis</option>
							<option value="georgie">Géorgie</option>
							<option value="inde">Inde</option>
							<option value="indonesie">Indonésie</option>
							<option value="iraq">Iraq</option>
							<option value="iran">Iran</option>
							<option value="israel">Israël</option>
							<option value="japon">Japon</option>
							<option value="jordanie">Jordanie</option>
							<option value="kazakhstan">Kazakhstan</option>
							<option value="kirghistan">Kirghistan</option>
							<option value="koweit">Koweït</option>
							<option value="laos">Laos</option>
							<option value="liban">Liban</option>
							<option value="malaisie">Malaisie</option>
							<option value="maldives">Maldives</option>
							<option value="mongolie">Mongolie</option>
							<option value="nepal">Népal</option>
							<option value="oman">Oman</option>
							<option value="ouzbekistan">Ouzbékistan</option>
							<option value="pakistan">Pakistan</option>
							<option value="philippines">Philippines</option>
							<option value="qatar">Qatar</option>
							<option value="singapour">Singapour</option>
							<option value="sriLanka">Sri Lanka</option>
							<option value="syrie">Syrie</option>
							<option value="tadjikistan">Tadjikistan</option>
							<option value="taiwan">Taïwan</option>
							<option value="thailande">Thaïlande</option>
							<option value="timorOriental">Timor oriental</option>
							<option value="turkmenistan">Turkménistan</option>
							<option value="turquie">Turquie</option>
							<option value="vietNam">Viêt Nam</option>
							<option value="yemen">Yemen</option>
							</optgroup>
							<optgroup label="Europe">
							<option value="allemagne">Allemagne</option>
							<option value="albanie">Albanie</option>
							<option value="andorre">Andorre</option>
							<option value="autriche">Autriche</option>
							<option value="bielorussie">Biélorussie</option>
							<option value="belgique">Belgique</option>
							<option value="bosnieHerzegovine">Bosnie-Herzégovine</option>
							<option value="bulgarie">Bulgarie</option>
							<option value="croatie">Croatie</option>
							<option value="danemark">Danemark</option>
							<option value="espagne">Espagne</option>
							<option value="estonie">Estonie</option>
							<option value="finlande">Finlande</option>
							<option value="france">France</option>
							<option value="grece">Grèce</option>
							<option value="hongrie">Hongrie</option>
							<option value="irlande">Irlande</option>
							<option value="islande">Islande</option>
							<option value="italie">Italie</option>
							<option value="lettonie">Lettonie</option>
							<option value="liechtenstein">Liechtenstein</option>
							<option value="lituanie">Lituanie</option>
							<option value="luxembourg">Luxembourg</option>
							<option value="exRepubliqueYougoslaveDeMacedoine">Ex-République Yougoslave de Macédoine</option>
							<option value="malte">Malte</option>
							<option value="moldavie">Moldavie</option>
							<option value="monaco">Monaco</option>
							<option value="norvege">Norvège</option>
							<option value="paysBas">Pays-Bas</option>
							<option value="pologne">Pologne</option>
							<option value="portugal">Portugal</option>
							<option value="roumanie">Roumanie</option>
							<option value="royaumeUni">Royaume-Uni</option>
							<option value="russie">Russie</option>
							<option value="saintMarin">Saint-Marin</option>
							<option value="serbieEtMontenegro">Serbie-et-Monténégro</option>
							<option value="slovaquie">Slovaquie</option>
							<option value="slovenie">Slovénie</option>
							<option value="suede">Suède</option>
							<option value="suisse">Suisse</option>
							<option value="republiqueTcheque">République Tchèque</option>
							<option value="ukraine">Ukraine</option>
							<option value="vatican">Vatican</option>
							</optgroup>
							<optgroup label="Océanie">
							<option value="australie">Australie</option>
							<option value="fidji">Fidji</option>
							<option value="kiribati">Kiribati</option>
							<option value="marshall">Marshall</option>
							<option value="micronesie">Micronésie</option>
							<option value="nauru">Nauru</option>
							<option value="nouvelleZelande">Nouvelle-Zélande</option>
							<option value="palaos">Palaos</option>
							<option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guinée</option>
							<option value="salomon">Salomon</option>
							<option value="samoa">Samoa</option>
							<option value="tonga">Tonga</option>
							<option value="tuvalu">Tuvalu</option>
							<option value="vanuatu">Vanuatu</option>
							</optgroup>
							</select></label>
					</p>
					<p>
						<textarea placeholder="Entrer votre message" for="inputmessage" type="text" name="message" rows="4" cols="50"><?php if(isset($message)) echo $message; ?></textarea>
					</p>
					<p>
					<?php $checked_H     = ($genre == 'H')     ? ' checked="checked"' : ''; $checked_F   = ($genre == 'F')   ? ' checked="checked"' : ''; ?>
	  				Quel est votre sexe ? :
					<label for="genre_m">Homme</label>
					<input type="radio" id="genre_m" name="genre" value="H" <?php echo($checked_H); ?> />
					<label for="genre_f">Femme</label>
					<input type="radio" id="genre_f" name="genre" value="F" <?php echo($checked_F); ?> />
					</p>
					<p>
						<label>Sujet :</label>
					</p>
	  				<ul>
						<li><input type="checkbox" id="question_problemes" name="problemes" value="problemes lors du montage" <?php echo ($_POST['problemes'] == "problemes lors du montage")?"checked='checked'":""; ?>/>Problèmes lors du montage</li>
						<li><input type="checkbox" id="question_sav" name="sav" value="SAV" <?php echo ($_POST['sav'] == "SAV")?"checked='checked'":""; ?> />SAV</li>
						<li><input type="checkbox" id="question_suivis" name="suivis" value="Suivis de livraison" <?php echo ($_POST['suivis'] == "Suivis de livraison")?"checked='checked'":""; ?> />Suivis de livraison</li>
					</ul>
					<p>
						<label for="inputcombien">Combien font 1+3 ? :</label>
						<input id="inputcombien" type="number" name="captcha"/>
					</p>
					<main class="wrapper">
					<div class="wrap-btns text-center">
					<button type="submit" name="submit" class="btn style" form="formulaire">Envoyer</button>
					</div>
					</main>
				</form>
			</div>
		</div>
	</body>
</html>
