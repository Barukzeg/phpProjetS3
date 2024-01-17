<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <title>Ajout RDV</title>
    </head>
    <?php require_once "../Login/verif.php"; ?>
    <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleForm.css"/>
    <body>
        <div class="centered-container">
            <form action="addRDVSuite.php" method="post">
                <label for="usager">Usager :</label>
                <select id="usager" name="usager" required>
                    <?php
                        include_once "../../services/serviceUsager.php";
                        $usagers = serviceUsager::getService()->getUsagerAlpha();
                        foreach ($usagers as $usager) {
                            echo "<option value='".$usager->getIdUsager()."'>".$usager->getNom()." ".$usager->getPrenom()."</option>";
                        }
                    ?>
                </select>
                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Réinitialiser</button>
                    <button type="button" onclick="history.back()">Retour</button>
                </div>
            </form>
        </div>
    </body>
</html>