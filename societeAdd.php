<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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
$todo=$_GET['todo'];

if ($todo=='add') {
    ?>
 
    <form action="" method="POST">

<div class="card">
    <div class="card-body">
<h3 class="card-subtitle mb-2 text-muted">  Ajout de société</h3>
</div>
</div>
<br/>
<div class="container">
<label>Société: </label> <input type="text" name="typeAsset">
<br />
<label>Activé: </label> <input type="checkbox" name="activeOrNot">
<br />
<input class="btn-success" type="submit" name="submit" value="Créer">
</div>
<!-- <input class="" type="submit" name="submit" value="Créer"> -->
</form>
</body>
</html>


<?php
if (isset($_POST['submit'])) {
    include('config.php');
    $typeToAdd=$_POST['typeAsset'];
    if (isset($_POST['activeOrNot'])) {
        $active=1;
    } else {
        $active=0;
    }


    $query="INSERT INTO societe(libelle,active) values ('".$typeToAdd."','".$active."')";
    $result = sqlsrv_query($conn, $query);
    if($result){
        echo '<script language="javascript">';
        echo 'alert("Société ajoutée avec succès !");history.back(0)';
        echo '</script>';
        }
}
}

elseif ($todo=='manage') {
    include('config.php');
    ?>

    <form action="" method="POST">
  
    <div class="card">
    <div class="card-body">
<h3 class="card-subtitle mb-2 text-muted"> Gestion de société</h3>
</div>
</div>
<div class="container">
<table class="table">
  <thead class="thead-dark">
    <tr>
    <th>ID</th>     
<th>Société</th>
<th>Status</th>


</tr>
</thead>
<?php 
$query="Select * From societe";
$result = sqlsrv_query($conn, $query);

while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
      $row['active'] == 1 ? $status='Activé' : $status='Désactivé';
      $status=='Désactivé' ? $action='Activer' : $action='Desactiver';
      $action == 'Activer' ? $yow='<tr bgcolor="#FF7F7F">' : $yow='<tr bgcolor="">';
    
      
?>
    <?php echo $yow; ?>
        <td>  <input type="radio" name="toDelete" value="<?php echo $row['ID']?>"> </td>
    <td><label><?php echo $row['libelle'] ?></label></td>
    <td> <label> <?php echo $status; ?></label></td>
    <!-- <td> </td> -->
    
</tr>

<?php
}

?>

</table>
</div>
<div class="container">
<input class="btn-primary" type="submit" name="Activer" value="Activer">

<input class="btn-danger"  type="submit" name="Desactiver" value="Désactiver">
</div>
</form>
</body>
</html>


<?php
if (isset($_POST['Desactiver'])) {
    include('config.php');

$todelete=$_POST['toDelete'];
    $query="UPDATE societe set active=0 where ID = '".$todelete."'";
    $result = sqlsrv_query($conn, $query);
    if($result){
    echo '<script language="javascript">';
    echo 'alert("Société désactivée avec succès !");history.back(0)';
    echo '</script>';
    }
}

if (isset($_POST['Activer'])) {
    include('config.php');
$todelete=$_POST['toDelete'];
    $query="UPDATE societe set active=1 where ID = '".$todelete."'";
    $result = sqlsrv_query($conn, $query);
    if($result){
        echo '<script language="javascript">';
        echo 'alert("Société activée avec succès !");history.back(0)';
        echo '</script>';
        }
}


}
?>

