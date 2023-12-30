<html>
    <body>
        <?php
            include "../../services/serviceMedecin.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $repoMedecin = new RepoMedecin();
                $medecin = $repoMedecin->getById($_POST['idMedecin']);
                $resultat = $repoMedecin->remMedecin($medecin);
                if ($resultat) {
                    echo "Medecin : ".$medecin->getNom()." ".$medecin->getPrenom()." supprimé";
                } else {
                    echo "Erreur dans la requête de supression ";
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
