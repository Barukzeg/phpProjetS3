<html>
    <head>
        <title>Liste des medecins</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/listeUsager.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Liste des medecins :</h1>
            <div class="bouton-add">
                <form action="addMedecin.php">
                    <button>Ajouter un medecin</button>
                </form>
            </div>
            <?php
                include_once "../../services/serviceMedecin.php";
                include_once "../../repository/repoMedecin.php";
                include_once "../../modele/medecin.php";

                try{
                    $resultat = serviceMedecin::getService()->getMedecinAlpha();
                    echo '<div class="affichageResult">';
                    foreach ($resultat as $row) {
                        switch($row->getCivilite()){
                            case 'M':
                                $sexe = 'Homme';
                                break;
                            case 'F':
                                $sexe = 'Femme';
                                break;
                            case 'A':
                                $sexe = 'Autre';
                                break;
                            default:
                                $sexe = 'Non renseigné';
                                break;
                        }
                        echo '
                        <div class="result">
                            <div class="info">'
                                .$row->getNom().' '
                                .$row->getPrenom().'<br>'
                                .'Sexe : '.$sexe.'
                            </div>
                            <div class="btn-container">
                                <form action="modMedecin.php" method="post">
                                    <input type="hidden" name="idMedecin" value="'.$row->getIdMedecin().'">
                                    <button type="submit">Modifier</button>
                                </form>
                                <form action="traitementDeleteMedecin.php" method="post">
                                    <input type="hidden" name="idMedecin" value="'.$row->getIdMedecin().'">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>';
                    }
                    echo "</div>";
                }catch (Exception $e){
                    echo $e->getMessage();
                }
            ?>
        </div>
    </body>
</html>