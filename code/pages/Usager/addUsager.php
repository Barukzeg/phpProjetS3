<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <body>
        <div>
            <h1>Saisie :</h1>
            <?php
                include "../../services/serviceUsager.php";
                $url = "/listeUsager.php";
                if (isset($_POST['envoie'])) {
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $civilite = $_POST['civilite'];
                    $adresse = $_POST['adresse'];
                    $codepostal = $_POST['codepostal'];
                    $date = $_POST['dateNaissance'];
                    $dateNaissance = new DateTime($date);
                    $villeNaissance = $_POST['villeNaissance'];
                    $numSecu = $_POST['numSecu'];
                    $usager = new Usager(1,$nom, $prenom, $civilite, 1,$adresse, $codepostal, $dateNaissance, $villeNaissance, $numSecu);
                    $repoUsager = new RepoUsager();
                    $resultat = $repoUsager->addUsager($usager);
                    if ($resultat) {
                        echo "Usager ajouté";
                    } else {
                        echo "Erreur dans la requête : " . $mysqlClient->error;
                    }
                }else if(isset($_POST['reset'])){
                    $url = "addUsager.php";
                }
                header("Location".$url)
            ?>
            <form action="addUsager.php" method="post">
            <!-- TODO voir pour les trucs apres la
                - int $idUsager
                - int $idReferant 
            -->
                <div class="title-input">
                    Nom : <input type="text" name="nom"><br>
                </div>
                <div>
                    Prenom :<input type="text" name="prenom"><br>
                </div>
                <div>
                    Civilité :<input type="text" name="civilite"><br>
                </div>
                <div>
                    Adresse :<input type="text" name="adresse"><br>
                </div>
                <div>
                    Code postal :<input type="text" name="codepostal"><br>
                </div>
                <div>
                    Date de naissance :<input type="date" name="dateNaissance"><br>
                </div>
                <div>
                    Ville de naissance :<input type="text" name="villeNaissance"><br>
                </div>
                <div>
                    Numero de sécurité sociale :<input type="text" name="numSecu"><br>
                </div>

                <div class="bouton-out">
                    <form action="">
                        <input type="reset" name="reset" value="Reset">
                    </form>
                    <form action="listeUsager.php">
                        <input type="submit" name="envoie" value="Envoyer">
                    </form>
                </div>
            </form>
        </div>
    </body>
</html>