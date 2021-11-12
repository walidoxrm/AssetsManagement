<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<style>
.conteneur{
   display: flex;
}
.flex{
   flex-grow: 1;
}

.mydiv{
    margin-left:5%;
}

.mycont{
    width: 40%;
    padding-right: 5%;
    padding-left: 5%;
    /* margin-right: auto;
    margin-left: auto; */
}

.vertical { 
border-left: 4px solid black; 
height: 500px; 
display: inline-block;
} 
</style>

</head>

<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<include src="menu.html"></include>
<!-- <div data-include="menu.html"></div> -->

<?php include 'menu.html';?>
<!-- <div class="card">
  <div class="card-body">
<h1>Assets Management  Admin interface </h1>
</div></div> -->
<?php 
include('config.php');
$todo=$_GET['todo'];
if ($todo=='add') {
    ?>
 
    <form action="" method="POST">

<div class="card">
    <div class="card-body">
<h3 class="card-subtitle mb-2 text-muted">  Ajout de matériel</h3>
</div>
</div>
<div class="conteneur">
<div class="mycont">
<div class="col-sm-10">
   
<label>Type: </label> <select class="form-control inp" name="typeAsset"><option></option>
<?php
 $query="Select * From type where active=1";
 $result = sqlsrv_query($conn, $query);
 
 while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
      ?>
      <option value="<?php echo $row['libelle'] ;?>"><?php echo $row['libelle'] ;?></option>
<?php
} 
?>
</select>
<label>Marque: </label> <select class="form-control inp" name="marqueAsset"><option></option>
<?php
 $query="Select * From marque where active=1";
 $result = sqlsrv_query($conn, $query);
 
 while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
      ?>
      <option value="<?php echo $row['libelle'] ;?>"><?php echo $row['libelle'] ;?></option>
<?php
} 
?>
</select>
<label>Sous-marque: </label> <input class="form-control inp" type="text" name="sousMarqueAsset">
<label>Référence: </label> <input class="form-control inp" type="text" name="refAsset">
<label>Etat: </label><select class="form-control inp" name="etat"><option value="utilise">Utilisé</option><option value="neuf">Neuf</option></select>
<label>Stock diponible: </label> <input class="form-control inp" type="text" name="stockAsset">
<label>Chargeur: </label> <input class="" type="checkbox" name="chargeur">
<br />
<input class="btn-success" type="submit" name="submit" value="Ajouter">
</form>
<br />
<br />
</div>
</div>
<span class="vertical"></span>
<div class="mydiv">
<div class="card-body">
<h3 class="card-subtitle mb-2 text-muted">  Upload direct</h3>
</div>
<form enctype="multipart/form-data" action="" method="POST">
<label>Chargeur: </label> <input class="" type="file" name="assets">
<br/>
<small><a href="#"> télécharger modèle d'import</a></small>
<br/>
<br/>
<input class="btn-primary" type="submit" name="submitUpload" value="Importer">
</form>
</div>
</div>
<!-- <input class="" type="submit" name="submit" value="Créer"> -->

</body>
</html>


<?php
if (isset($_POST['submit'])) {
    include('config.php');
   
$typeAsset=$_POST['typeAsset'];
$marqueAsset=$_POST['marqueAsset'];
$sousMarqueAsset=$_POST['sousMarqueAsset'];
$refAsset=$_POST['refAsset'];
$etat=$_POST['etat'];
$stockAsset=$_POST['stockAsset'];
$chargeur=$_POST['chargeur'];

$chargeur ? $chargeur=1 : $chargeur=0 ;


    $query="INSERT INTO assets(type,marque,sousMarque,reference,etat,diponibilite,chargeur,affecte) values ('".$typeAsset."','".$marqueAsset."','".$sousMarqueAsset."','".$refAsset."','".$etat."','".$stockAsset."','".$chargeur."',0)";
    $result = sqlsrv_query($conn, $query);
    if($result){
        echo '<script language="javascript">';
        echo 'alert("Matériel ajouté avec succès !")';
        echo '</script>';
        }
}

if (isset($_POST['submitUpload'])) {
    include('config.php');




$repertoireDestination = dirname(__FILE__)."/";
 $nomDestination        = "assets.csv";
if (is_uploaded_file($_FILES["assets"]["tmp_name"])) {
    if (rename($_FILES["assets"]["tmp_name"],
                   $repertoireDestination.$nomDestination)) {   

define('CSV_PATH','C:\xampp\htdocs\assetsManage');
$csv_file = CSV_PATH . "/assets.csv"; 
$duplicata=[];
if (($handle = fopen($csv_file, "r")) !== FALSE) {
   fgetcsv($handle);   
   while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
          $col[$c] = $data[$c];
        }




$col0=$col[0];
$col1=$col[1];
$col2=$col[2];
$col3=$col[3];
$col4=$col[4];
$col5=$col[5];
$col6=$col[6];

 $query = "INSERT INTO assets(type,marque,sousMarque,reference,etat,diponibilite,chargeur,affecte) values ('".$col0."','".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."',0)"; 

 $params = array();
 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
 $stmt=sqlsrv_query($conn, $query, $params, $options ) ;
 
 
}
if( $stmt === false ) {
    //   die( print_r( sqlsrv_errors(), true));
    
   }else{
    echo '<script language="javascript">';
    echo 'alert("Assets importés avec succès !")';
    echo '</script>';
   }
// $rowsAffct=sqlsrv_rows_affected($stmt);
// echo $rowsAffct;

}}}}}
?>