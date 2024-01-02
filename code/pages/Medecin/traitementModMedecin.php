<html>
    <body>
        <?php
            include "../../services/serviceMedecin.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['idMedecin'];
                $nom = ucfirst($_POST['nom']);
                $prenom = ucfirst($_POST['prenom']);
                $civilite = $_POST['civilite'];
                $resultat = serviceMedecin::getService()->update($id, $nom, $prenom, $civilite);
                if ($resultat) {
                    echo '<h2>Les données suivantes ont été modifiées :</h2>';
                    echo '<p><strong>Nom :</strong> '.$nom.'</p>';
                    echo '<p><strong>Prénom :</strong> '.$prenom.'</p>';
                    echo '<p><strong>Civilité :</strong> '.$civilite.'</p>';
                } else {
                    echo "Erreur dans la requête : de modification du medecin" ;
                }
                echo '
                <div class="bouton-add">
                    <form action="listeMedecin.php">
                        <button>Retour à la liste des medecins</button>
                    </form>
                </div>';
            }
        ?>
    </body>
</html>
