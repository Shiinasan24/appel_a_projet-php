<?php 
    @include_once("environnement.php");
    // $user = $_SESSION["globalUser"];

    $request = $bdd -> query("SELECT * 
                              FROM projet 
                              INNER JOIN type_offre 
                              ON type_id = type_offre.id");

    $data = $request -> fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <title>Panel</title>
</head>
<body>

    <main>
        <aside class="header close">

            <div class="opener" id="js-opener"><i id="js-icon" class="fa-solid fa-arrow-right"></i></div>

            <?php include_once("pages/admin/nav-admin.php"); ?>
            
        </aside>
        
        <section class="main fullWidth">
            
            <div class="content">
                
                <?php if(isset($_GET["nav"])) : ?>
                    <?php 
                        $nav = $_GET["nav"];
                        if($nav === "accueil") {
                            include_once("pages/admin/accueil.php");
                        } elseif ($nav === "offers") {
                            include_once("pages/admin/offers.php");
                        }  
                    ?>
                <?php endif ?>

            </div>
        </section>
    </main>

    <script src="panel.js"></script>
</body>
</html>