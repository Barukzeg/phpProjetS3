<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <title>Ajout Medecin</title>
    </head>
    <?php require_once "../Login/verif.php"; ?>
    <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleForm.css"/>
    <body>
        <div class="centered-container">
            <form action="traitementAddMedecin.php" method="post">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="civilite">Civilité :</label>
                <select id="civilite" name="civilite" required>
                    <option value="M">M</option>
                    <option value="F">Mme</option>
                    <option value="Autre">Autre/Ne se prononce pas</option>
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