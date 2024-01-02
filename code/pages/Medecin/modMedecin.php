<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/addUsager.css"/>
    <?php
        include_once "../../services/serviceMedecin.php";
        $medecin = serviceMedecin::getService()->get($_POST['idMedecin']);
    ?>
    <body>
        <div>
            <form action="traitementModMedecin.php" method="post">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $medecin->getNom(); ?>" required>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $medecin->getPrenom(); ?>" required>

                <label for="civilite">Civilité :</label>
                <select id="civilite" name="civilite" value="<?php echo $medecin->getCivilite(); ?>" required>
                    <option value="M">M</option>
                    <option value="F">Mme</option>
                    <option value="Autre">Autre/Ne se prononce pas</option>
                </select>

                <input type="hidden" name="idMedecin" value="<?php echo $medecin->getIdMedecin(); ?>">
                
                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Réinitialiser</button>
                    <button type="button" onclick="history.back()">Retour</button>
                </div>
            </form>
        </div>
    </body>
</html>