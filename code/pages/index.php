<html>
    <!DOCTYPE HTML>
    <?php require_once "./Login/verif.php"; ?>
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
    </head>
    <?php include_once "header.php"; ?>
    <body>
        <div>
            <h1>Bienvenue sur votre outil de gestion de votre Cabinet Médical</h1>
        </div>
        <div class="boite-index">
            <div class="btn-index" id="index-left">
                <a href="/phpProjetS3/code/pages/Usager/listeUsager.php">
                    <img src="/phpProjetS3/code/image/iconUsager.png" alt="icon User">
                    <p>Liste des usagers</p>
                </a>
            </div>
            <div class="btn-index" id="index-right">
                <a href="/phpProjetS3/code/pages/Medecin/listeMedecin.php">
                    <img src="/phpProjetS3/code/image/iconMedecin.png" alt="icon Medecin">
                    <p>Liste des médecins</p>
                </a>
            </div>
            <div class="btn-index" id="index-left">
                <a href="/phpProjetS3/code/pages/RendezVous/listeRDV.php">
                    <img src="/phpProjetS3/code/image/iconRDV.png" alt="icon RDV">
                    <p>Liste des rendez-vous</p>
                </a>
            </div>
            <div class="btn-index" id="index-right">
                <a href="/phpProjetS3/code/pages/Stats/statistiques.php">
                    <img src="/phpProjetS3/code/image/iconStat.png" alt="icon Statistique">
                    <p>Statistiques</p>
                </a>
            </div>
            
        </div>
    </body>
</html>