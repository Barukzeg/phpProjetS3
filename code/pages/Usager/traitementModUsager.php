<html>
    <body>
        <?php
            include_once "../../services/serviceUsager.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['idUsager'];
                $nom = ucfirst($_POST['nom']);
                $prenom = ucfirst($_POST['prenom']);
                $civilite = $_POST['civilite'];
                $medecinRef = $_POST['medecinRef']; 
                if ($medecinRef == 'null') {
                    $medecinRef = null;
                }
                $adresse = $_POST['adresse'];
                $codepostal = $_POST['codepostal'];
                $date = $_POST['dateNaissance'];
                $dateNaissance = new DateTime($date);
                $villeNaissance = ucfirst($_POST['villeNaissance']);
                $numSecu = $_POST['numSecu'];
                $resultat = serviceUsager::getService()->update($id, $nom, $prenom, $civilite, $medecinRef, $adresse, $codepostal, $dateNaissance, $villeNaissance, $numSecu);
                if ($resultat) {
                    echo '<h2>Les données suivantes ont été modifiées :</h2>';
                    echo '<p><strong>Nom :</strong> '.$nom.'</p>';
                    echo '<p><strong>Prénom :</strong> '.$prenom.'</p>';
                    echo '<p><strong>Civilité :</strong> '.$civilite.'</p>';
                    echo '<p><strong>Adresse :</strong> '.$adresse.'</p>';
                    echo '<p><strong>Code postal :</strong> '.$codepostal.'</p>';
                    echo '<p><strong>Date de naissance :</strong> '.$date.'</p>';
                    echo '<p><strong>Ville de naissance :</strong> '.$villeNaissance.'</p>';
                    echo '<p><strong>Numéro de sécurité sociale :</strong> '.$numSecu.'</p>';
                } else {
                    echo "Erreur dans la requête : de modification de l'usager" ;
                }
                echo '
                <div class="bouton-add">
                    <form action="listeUsager.php">
                        <button>Retour à la liste des usagers</button>
                    </form>
                </div>';
            }
        ?>
    </body>
</html>
