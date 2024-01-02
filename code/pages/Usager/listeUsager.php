<html>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/listeUsager.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Liste des usagers :</h1>
            <div class="bouton-add">
                <form action="addUsager.php">
                    <button>Ajouter un usager</button>
                </form>
            </div>
            <?php
                include_once "../../services/serviceUsager.php";
                include_once "../../services/serviceMedecin.php";
                include_once "../../modele/Usager.php";

                try{
                    $resultat = serviceUsager::getService()->getUsagerAlpha();
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
                                .'Sexe : '.$sexe.'<br>'
                                .'Adresse : '.$row->getAdresseComplete().' '.$row->getCodePostal().'<br>'
                                .'Date de naissance : '.$row->getDateNaissance()->format('d/m/Y').'<br>'
                                .'Ville de naissance : '.$row->getLieuNaissance().'<br>'
                                .'Numéro de sécurité sociale : '.$row->getNumSecuriteSociale().'<br>';
                                $medecin = serviceMedecin::getService()->get($row->getidReferent());
                                echo 'Médecin référent : '.$medecin->getNom().' '.$medecin->getPrenom().'
                            </div>
                            <div class="btn-container">
                                <form action="modUsager.php" method="post">
                                    <input type="hidden" name="idUsager" value="'.$row->getIdUsager().'">
                                    <button type="submit">Modifier</button>
                                </form>
                                <form action="traitementDeleteUsager.php" method="post">
                                    <input type="hidden" name="idUsager" value="'.$row->getIdUsager().'">
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