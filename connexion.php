<?php 
    include_once("environnement.php");

    if(isset($_POST["username"])) {
        $_SESSION["globalUser"] = $_POST["username"];
    }

    $rqUsers = $bdd -> query("SELECT * FROM user");
    $dataUser = $rqUsers -> fetch();

    if(isset($_POST["username"]) AND $_POST["password"]) {
        $username = htmlentities($_POST["username"]);
        $password = htmlentities($_POST["password"]);

        if($username == $dataUser["username"] AND $password == $dataUser["password"]) {
            // Connexion réussie
            header("Location: connexion.php?login=1");
        } else {
            // Connexion échouée
            header("Location: connexion.php?login=10");
        }
    }

?>


<div class="wrapperForm">

    <h3>Connexion</h3>
    
    <form action="connexion.php" method="post" class="form">
        
        <div class="contentWrapper">
            <label for="username">Entrez votre nom d'utilisateur</label>
            <input type="text" name="username" id="username">
        </div>

        <div class="contentWrapper">
            <label for="password">Entrez votre mot de passe</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit" class="btnSubmit">Se connecter</button>

    </form>
    
</div>
