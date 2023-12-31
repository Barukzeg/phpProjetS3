<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/addUsager.css"/>
    <body>
        <div>
            <form action="traitementAddUsager.php" method="post">
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

                <label for="medecinRef">Medecin référent</label>
                <select id="medecinRef" name="medecinRef" required>
                    <option value="non">Pas de medecin référent</option>
                    <?php
                        include "../../repository/repoMedecin.php";
                        $medecins = RepoMedecin::getAll();
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
                <input type="date" id="dateNaissance" name="dateNaissance" required>

                <label for="villeNaissance">Ville de naissance :</label>
                <input type="text" id="villeNaissance" name="villeNaissance" required>

                <label for="numSecu">Numéro de sécurité sociale :</label>
                <input type="text" id="numSecu" name="numSecu" required>

                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Vider</button>
                </div>
            </form>
        </div>
    </body>
</html>