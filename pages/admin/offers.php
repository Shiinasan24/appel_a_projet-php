<?php 
    include_once("environnement.php");

    // requests
    // -- queries
    $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet INNER JOIN type_offre ON type_id = type_offre.id");
    $rqFilters = $bdd -> query("SELECT nom_offre FROM type_offre");
    
    // fetches
    $dataFilters = $rqFilters -> fetchAll(PDO::FETCH_OBJ);
    
    // variables
    $url = "panel.php?nav=offers&filter=expiration_asc";
    $editImage = "default.png";

    
    if(isset($_GET["nav"])) {
        $getNav = htmlentities($_GET["nav"]);
    } else {
        header("Location: panel.php?nav=offers");
    }

    if(isset($_GET["edit"])) {
        $getEdit = htmlentities($_GET["edit"]);
    } else {
        $getEdit = 0;
    }

    if(isset($_GET["id"])) {
        $getID = htmlentities($_GET["id"]);
    } else {
        $getID = "";
    }
    

    if(isset($_GET["filter"]) AND !empty($_GET["filter"])) {
        $getFilter = htmlentities($_GET["filter"]);

        if($getFilter === "name_asc") {
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY nom ASC");
        } elseif($getFilter === "name_desc") {
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY nom DESC");
            
        } elseif($getFilter === "type_asc") {
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY nom_offre ASC");
        } elseif($getFilter === "type_desc") {
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY nom_offre DESC");

        } elseif($getFilter === "expiration_asc") {
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY expiration ASC");
        } elseif($getFilter === "expiration_desc") {
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY expiration DESC");

        } else {
            $getFilter = "name_asc";
            $request = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet
                                      INNER JOIN type_offre 
                                      ON type_id = type_offre.id 
                                      ORDER BY nom ASC");
        }
        
    } else {
        $getFilter = "expiration_asc";
    }

    $data = $request -> fetchAll(PDO::FETCH_OBJ);

?>

<section>

    <?php if($getEdit == 1) { ?>
        <a href="panel.php?nav=<?= $getNav ?>&filter=<?= $getFilter ?>&edit=0">Annuler</a>
    <?php } else { ?>        
        <a href="panel.php?nav=<?= $getNav ?>&filter=<?= $getFilter ?>&edit=1">Modifier</a>
    <?php } ?>

    <?php if(isset($_GET["success"])) { ?>
        <?php $success = htmlentities($_GET["success"]); ?>
        <div>
            <?php if($success === "1") { ?>
                <span class='success'>Modifications enregistrées avec succès</span>
            <?php } ?>
        </div>
    <?php } ?>

</section>

<section class="sectionTable">

    <!-- THEAD -->
    <div class="wrapperTable">

        <!-- IMAGE -->
        <div class="cells">
            <span class="th">Image</span>
        </div>

        <!-- NOM -->
        <div class="cells">
            <?php if($getFilter === "name_asc") { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=name_desc&edit=<?= $getEdit ?>" class='btnFilter'>Nom <i class='fa-solid fa-arrow-down-a-z'></i></a>

            <?php } elseif($getFilter === "name_desc") { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=name_asc&edit=<?= $getEdit ?>" class='btnFilter'>Nom <i class='fa-solid fa-arrow-down-z-a'></i></a>

            <?php } else { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=name_asc&edit=<?= $getEdit ?>" class='btnFilter'>Nom <i class='fa-solid fa-arrow-down-a-z'></i></a>

            <?php } ?>  
        </div>

        <!-- TYPE -->
        <div class="cells">
            <?php if($getFilter === "type_asc") { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=type_desc&edit=<?= $getEdit ?>" class='btnFilter'>Type <i class='fa-solid fa-arrow-down-a-z'></i></a>

            <?php } elseif($getFilter === "type_desc") { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=type_asc&edit=<?= $getEdit ?>" class='btnFilter'>Type <i class='fa-solid fa-arrow-down-z-a'></i></a>

            <?php } else { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=type_asc&edit=<?= $getEdit ?>" class='btnFilter'>Type <i class='fa-solid fa-arrow-down-a-z'></i></a>

            <?php } ?>  
        </div>

        <!-- DESCRIPTION -->
        <div class="cells">
            <span class="th">Description</span>
        </div>

        <!-- EXPIRATION -->
        <div class="cells">
            <?php if($getFilter === "expiration_asc") { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=expiration_desc&edit=<?= $getEdit ?>" class='btnFilter'>Expiration <i class='fa-solid fa-arrow-down-1-9'></i></a>

            <?php } elseif($getFilter === "expiration_desc") { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=expiration_asc&edit=<?= $getEdit ?>" class='btnFilter'>Expiration <i class='fa-solid fa-arrow-down-9-1'></i></a>

            <?php } else { ?>
                <a href="panel.php?nav=<?= $getNav ?>&filter=expiration_asc&edit=<?= $getEdit ?>" class='btnFilter'>Expiration <i class='fa-solid fa-arrow-down-1-9'></i></a>

            <?php } ?>  
        </div>

        <?php if(isset($_GET["edit"]) AND $getEdit === "1") { ?>
            
            <div class="cells">
                <span>Modifier</span>
            </div>

        <?php } ?>
    </div>

    <!-- TABLE CONTENT -->
    <?php foreach($data as $tableContent) : ?>
        <?php 
            $oldDate = $tableContent -> expiration;
            $dateTime = DateTime::createFromFormat("Y-m-d", $oldDate);
            $newDate = $dateTime -> format("d-m-Y");
            $date = str_replace("-", "/", $newDate);
        ?>

        <?php if(!isset($_GET["id"])) { ?>
            <article class="wrapperTable">
                <div class="cells">
                    <img src="assets/img/<?= $tableContent -> image ?>" alt="Logo <?= $tableContent -> nom_offre ?>">
                </div>
                <div class="cells">
                    <span><?= $tableContent -> nom ?></span>
                </div>
                <div class="cells">
                    <span><?= $tableContent -> nom_offre ?></span>
                </div>
                <div class="cells">
                    <span><?= $tableContent -> description ?></span>
                </div>
                <div class="cells">
                    <span><?= $date ?></span>
                </div>
                <?php if($getEdit === "1") { ?>
                    <div class="cells">
                        <a href="panel.php?nav=<?= $getNav ?>&filter=<?= $getFilter ?>&edit=<?= $getEdit ?>&id=<?= $tableContent -> projet_id ?>">Modifier</a>
                    </div>
                <?php } ?>
            </article>
        <?php } ?>

    <?php endforeach ?> 
    
    <?php if(isset($_GET["id"])) { ?>

        <div class="wrapperTable">
            <?php include_once("edit.php"); ?>
        </div>

    <?php } ?>

</section>
