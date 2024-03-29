<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <title>Ajout Usager</title>
    </head>
    <?php require_once "../Login/verif.php"; ?>
    <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleForm.css"/>
    <body>
        <div class="centered-container">
            <form action="traitementAddUsager.php" method="post">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="civilite">Civilité :</label>
                <select id="civilite" name="civilite" required>
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option value="X">Autre/Ne se prononce pas</option>
                </select>

                <label for="medecinRef">Medecin référent</label>
                <select id="medecinRef" name="medecinRef" required>
                    <option value="null">Pas de medecin référent</option>
                    <?php
                        include_once "../../services/serviceMedecin.php";
                        $medecins = serviceMedecin::getService()->getMedecinAlpha();
                        foreach ($medecins as $medecin) {
                            echo "<option value='".$medecin->getIdMedecin()."'>".$medecin->getNom()." ".$medecin->getPrenom()."</option>";
                        }
                    ?>
                </select>

                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>

                <label for="codepostal">Code postal :</label>
                <input type="text" id="codepostal" name="codepostal" required>

                <label for="dateNaissance">Date de naissance :</label>
                <input type="date" id="dateNaissance" name="dateNaissance" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" required>

                <label for="villeNaissance">Ville de naissance :</label>
                <input type="text" id="villeNaissance" name="villeNaissance" required>

                <label for="numSecu">Numéro de sécurité sociale :</label>
                <input type="text" id="numSecu" name="numSecu" pattern="\d{15}" required>

                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Réinitialiser</button>
                    <button type="button" onclick="history.back()">Retour</button>
                </div>
            </form>
        </div>
    </body>
</html>