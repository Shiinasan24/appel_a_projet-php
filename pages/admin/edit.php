<?php 
  include_once("environnement.php");


  // vars
  $projetID = $_GET["id"];
  $editImage = "default.png";


  // functions
  function displayedDateFormat($date) {
    $oldDate = $date;
    $displayDate = DateTime::createFromFormat("Y-m-d", $oldDate);
    $newDisplay = $displayDate -> format("d-m-Y");
    $formatedDisplayDate = str_replace("-", "/", $newDisplay);
    return $formatedDisplayDate;
  }

  function inputDateFormat($date) {
    $newDate = $date;
    $formatedInputDate = str_replace("/", "-", $newDate);
    $displayDate = DateTime::createFromFormat("d-m-Y", $formatedInputDate);
    $dbFormat = $displayDate -> format("Y-m-d");
    return $dbFormat;
  }
  
  
  // request
  // -- queries
  $rqProjet = $bdd -> query("SELECT *, projet.id AS projet_id FROM projet INNER JOIN type_offre ON type_id = type_offre.id WHERE projet.id = $projetID");
  $dataProjet = $rqProjet -> fetchAll(PDO::FETCH_OBJ);

  $rqTypeOffre = $bdd -> query("SELECT * FROM type_offre");
  $dataTypeOffre = $rqTypeOffre -> fetchAll(PDO::FETCH_OBJ);

  // -- prepares
  if(isset($_POST["editNom"]) AND isset($_POST["editType"]) AND isset($_POST["editDescr"]) AND isset($_POST["editExpiration"])) {
    $editNom = htmlentities($_POST["editNom"]);
    $editType = htmlentities($_POST["editType"]);
    $editDescr = htmlentities($_POST["editDescr"]);
    $expiration = htmlentities($_POST["editExpiration"]);
    $editExpiration = inputDateFormat($expiration);

    $rqUpdateProjet = $bdd -> prepare("UPDATE projet SET nom = ?, type_id = ?, description = ?, expiration = ?, image = ? WHERE id = ?");
    $rqUpdateProjet -> execute(array($editNom, $editType, $editDescr, $editExpiration, $editImage, $projetID));
    header("Location: panel.php?nav=offers&filter=expiration_asc&edit=1&success=1");
    exit();
  } 

?>

<?php foreach($dataProjet as $data) { ?>

  <form action="" method="post" class="wrapperForm">

    <article class="wrapperArticle">

      <div class="cells">
        <img src="assets/img/<?= $data -> image ?>" alt="Logo <?= $data -> image ?>">
      </div>

      <div class="cells">
        <input type="text" value="<?= $data -> nom ?>" name="editNom">
      </div>

      <div class="cells">
        <select name="editType" id="editType">
          <option value="<?= $data -> type_id ?>">> <?= $data -> nom_offre ?></option>
          <?php foreach($dataTypeOffre as $dataTypeOffer) { ?> 
            <?php if($dataTypeOffer -> nom_offre !== $data -> nom_offre) { ?>
              <option value="<?= $dataTypeOffer -> id ?>"><?= $dataTypeOffer -> nom_offre ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>

      <div class="cells">
        <textarea name="editDescr" id="" cols="30" rows="6"><?= $data -> description ?></textarea>
      </div>

      <div class="cells">
        <input type="text" value="<?= displayedDateFormat($data -> expiration) ?>" name="editExpiration">
      </div>

      <div class="cells">
        <button type="submit">Valider</button>
      </div>

    </article>

  </form>

<?php } ?> 