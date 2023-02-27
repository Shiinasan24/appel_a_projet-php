<?php 
    include_once("environnement.php");
    
    $request = $bdd -> query("SELECT *, projet.id AS projet_id, projet.nom AS projet_nom 
                              FROM projet
                              LEFT JOIN type_offre
                              ON type_id = type_offre.id
                              ORDER BY expiration");
    $data = $request -> fetchAll();

    
    if(isset($_GET["id"])) {
        $cardID = $_GET["id"];
        $rqFiltered = $bdd -> query("SELECT * 
                                   FROM projet 
                                   INNER JOIN type_offre 
                                   ON type_id = type_offre.id
                                   WHERE type_id= $cardID");

        $dataFiltered = $rqFiltered -> fetchAll(PDO::FETCH_OBJ);

    }
    
    $rqType = $bdd -> query("SELECT * FROM type_offre");
    $typeData = $rqType -> fetchAll(PDO::FETCH_OBJ);

    $rqBtns = $bdd -> query("SELECT DISTINCT type_offre.nom_offre, type_offre.id FROM type_offre INNER JOIN projet ON type_offre.id = projet.type_id ORDER BY type_offre.id");
    $rqData = $rqBtns -> fetchAll(PDO::FETCH_OBJ);    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Appel d'offres</title>
</head>

<body>

    <header class="header">

        <?php @include_once("nav.php"); ?>
        
        <!-- sidebar -->
            <aside class="wrapperPos">
    
                <div class="loginModal">
                    <?php @include_once("connexion.php"); ?>
                </div>
        
            </aside>

    </header>

    
    <main>
        
        <!-- SECTION PROJET FILTRE -->
        <section class="filterSection">

            <h1>TITRE DE LA PAGE</h1>

            <div class="form">
                
                <h2 id="filterTitle">Filtrer les résultats selon la Tech :</h2>
                
                <!-- FORMULAIRE DE FILTRAGE -->
                <form action="index.php" method="get">

                    <div class="buttons">

                        <!-- Boucle qui créer les boutons de filtrage selon le nombre de type d'offre de la BDD -->
                        <?php foreach($rqData as $type) : ?>
                            
                            <a href="?id=<?= $type -> id ?>" class="filterBtn" name="<?= $type -> nom_offre ?>"><?= $type -> nom_offre ?></a>

                        <?php endforeach; ?>

                    </div>

                    <!-- Si un ID est set, affiche un bouton de reset des filtres (non présent par défaut) -->
                    <?php if(isset($_GET["id"])) : ?>

                        <div class="resetWrapper">
                            <a href="index.php" class="resetBtn">Réinitialiser</a>
                        </div>

                    <?php endif ?>
                </form>

                <!-- AFFICHAGE DES RESULTATS FILTRE -->
                <div>

                    <!-- Si un ID est set, génére les cartes qui correspondent au filtre et génère un style différent selon si l'ID est set ou pas -->
                    <?php if(isset($_GET["id"])) : ?>

                        <?php
                            if(!isset($_GET["id"])) {
                                $wrapper = "wrapper";
                                $card = "card";
                                $cardImage = "cardImage";
                                $cardBtn = "cardBtn";
                            } else {
                                $wrapper = "wrapperFilter";
                                $card = "cardFilter";
                                $cardImage = "cardImageFilter";
                                $cardBtn = "cardBtnFilter";
                            }
                        ?>

                        <div class="<?= $wrapper ?>">

                            <?php foreach($dataFiltered as $item) : ?>

                                <article class="<?= $card ?>"> 
    
                                    <div class="<?= $cardImage ?>">
                                        <img src="assets/img/<?= $item -> image ?>" alt="Logo <?= $item -> nom ?>">
                                    </div>          

                                    <div class="cardContent">
                                        <h4 class="cardTitle">Titre de l'appel à projet</h4>

                                        <div class="spans">
                                            <span class="cardOfferType"><span class="blueText"><em>Type d'offre : </em></span><?= $item -> nom_offre ?></span>
                                            <span class="cardExpiration"><span class="blueText"><em>Date d'expiration : </em></span><?= $item -> expiration ?></span>
                                        </div>

                                        <p class="cardDescription"><span class="blueText"><em>Description : </em></span><?= $item -> description ?></p>

                                        <button type="submit" class="<?= $cardBtn ?>">Consulter l'offre</button>
                                    </div>
                                </article>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section>

        <!-- SECTION TOUS LES APPELS A PROJET -->
        <section>

            <h2 class="underlined">Tous les appels à projet</h2>

            <?php foreach($data as $card) : ?>

                <div class="wrapper">

                    <div class="card"> 

                        <div class="cardImage">
                            <img src="assets/img/<?= $card["image"] ?>" alt="Logo <?= $card["nom"] ?>">
                        </div>        

                        <div class="cardContent">
                            <h4 class="cardTitle">Titre de l'appel à projet</h4>

                            <div class="spans">
                                <span class="cardOfferType"><span class="blueText"><em>Type d'offre : </em></span><?= $card["nom_offre"] ?></span>
                                <span class="cardExpiration"><span class="blueText"><em>Date d'expiration : </em></span><?= $card["expiration"] ?></span>
                            </div>

                            <p class="cardDescription"><span class="blueText"><em>Description : </em></span><?= $card["description"] ?></p>
                            
                            <button type="submit" class="cardBtn">Consulter l'offre</button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
    </main>
</body>
</html>