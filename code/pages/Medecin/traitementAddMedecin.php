<html>
    <body>
        <?php
            include "../../services/serviceMedecin.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = ucfirst($_POST['nom']);
                $prenom = ucfirst($_POST['prenom']);
                $civilite = $_POST['civilite'];
                $medecin = new Medecin(1,$nom,$prenom,$civilite);
                $repoMedecin = new RepoMedecin();
                $resultat = $repoMedecin->addMedecin($medecin);
                if ($resultat) {
                    echo '<h2>Les données suivantes ont été enregistré :</h2>';
                    echo '<p><strong>Nom :</strong> '.$nom.'</p>';
                    echo '<p><strong>Prénom :</strong> '.$prenom.'</p>';
                    echo '<p><strong>Civilité :</strong> '.$civilite.'</p>';
                } else {
                    echo "Erreur dans la requête : d'ajout du medecin" ;
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
