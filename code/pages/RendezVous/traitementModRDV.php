<html>
    <body>
        <?php
            include "../../services/serviceUsager.php";
            include "../../services/serviceMedecin.php";
            include "../../services/serviceRendezVous.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $NidC = $_POST['usager'];
                $NidM = $_POST['medecin'];
                $NdateEtHeure = DateTime::createFromFormat('Y-m-d H:i', $_POST['dateRDV'] . ' ' . $_POST['heureRDV']);
                $dureeMinutes = $_POST['dureeRDV'];
                $resultat = serviceRendezVous::getService()->update($_POST['idC'], $_POST['idM'], $_POST['DateEtHeure'], $NidC, $NidM, $NdateEtHeure, $dureeMinutes);
                if ($resultat) {
                    echo '<h2>Les données suivantes ont été modifiées :</h2>';
                    echo '<p><strong>Usager :</strong> '.serviceUsager::get($idC)->getNom().' '.serviceUsager::get($idC)->getPrenom().'</p>';
                    echo '<p><strong>Médecin :</strong> '.serviceMedecin::get($idM)->getNom().' '.serviceMedecin::get($idM)->getPrenom().'</p>';
                    echo '<p><strong>Date :</strong> '.$dateEtHeure->format('Y-m-d').'</p>';
                    echo '<p><strong>Heure :</strong> '.$dateEtHeure->format('H:i').'</p>';
                    echo '<p><strong>Durée :</strong> '.$dureeMinutes.' min</p>';
                } else {
                    echo "Erreur dans la requête : de modification d'un rendez vous" ;
                }
                echo '
                <div class="bouton-add">
                    <form action="listeRDV.php">
                        <button>Retour à la liste des rdv</button>
                    </form>
                </div>';
            }
        ?>
    </body>
</html>
