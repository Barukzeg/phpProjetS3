<html>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="../../style/style.css">
    </head>
    <?php include "../header.php"; ?>
    <body>
        <h1>Usagers :</h1>
        <?php
            include "../../services/serviceUsager.php";
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
                    $ville = ucfirst($row->getLieuNaissance());
                    echo '<div class="result">'
                    .$row->getNom().' '
                    .$row->getPrenom().'<br>'
                    .'Sexe : '.$sexe.'<br>'
                    .'Adresse : '.$row->getAdresseComplete().' '.$row->getCodePostal().'<br>'
                    .'Date de naissance : '.$row->getDateNaissance()->format('d/m/Y').'<br>'
                    .'Ville de naissance : '.$ville.'<br>'
                    .'</div>';
                }
                echo "</div>";
            }catch (Exception $e){
                echo $e->getMessage();
            }
        ?>
        <div class="bouton-add">
            <form action="addUsager.php">
                <button>Ajouter un usager</button>
            </form>
        </div>
    </body>
</html>