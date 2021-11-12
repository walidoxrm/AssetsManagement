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
<script src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" ></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>


<script>
    
    $(document).ready(function() {
    $('#example').DataTable( {
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 4 ],
            orderData: [ 4, 0 ]
        } ]
    } );
} );
    </script>
<include src="menu.html"></include>
<!-- <div data-include="menu.html"></div> -->

<?php include 'menu.html';?>
<!-- <div class="card">
  <div class="card-body">
<h1>Assets Management  Admin interface </h1>
</div></div> -->
<?php 
include('config.php');

    ?>
 
    


        <!-- <div class="conteneur"> -->

        
<?php 

if(!isset($_POST['choose'])){
    
    ?>


    <form action="" method="POST">
        <div class="container">
        <br/>
        <h2>Choix matériel pour affectation</h2>
    <table id="example" class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Marque</th>
                <th>Sous marque</th>
                <th>Référence</th>
                <th>Etat</th>
                <th>Disponibilité</th>
                <th>Chargeur</th>
            </tr>
        </thead>
        <tbody>
     
           
        <?php 
$query="Select * From assets where diponibilite >= 1";
$result = sqlsrv_query($conn, $query);

while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $type=$row['type'];
    $marque=$row['marque'];
    $sousMarque=$row['sousMarque'];
    $reference=$row['reference'];
    $etat=$row['etat'];
    $diponibilite=$row['diponibilite'];
    $chargeur=$row['chargeur'];

    $chargeur==1 ? $chargeur='Oui' : $chargeur='Non';

    //   $row['active'] == 1 ? $status='Activé' : $status='Désactivé';
    //   $status=='Désactivé' ? $action='Activer' : $action='Desactiver';
    //   $action == 'Activer' ? $yow='<tr bgcolor="#FF7F7F">' : $yow='<tr bgcolor="">';
    
    
    ?>
 
 <tr>
     <td> <input onchange="this.form.submit()" type="radio" name="choose" value="<?php echo $row['ID']?>" required>  <?php echo $row['ID']; ?> </td>
     
     <td><?php echo $type; ?> </td>
     <td><?php echo $marque; ?></td>
    <td>  <?php echo $sousMarque; ?></td>
    <td>  <?php echo $reference; ?></td>
    <td>  <?php echo $etat; ?></td>
    <td>  <?php echo $diponibilite; ?></td>
    <td>  <?php echo $chargeur; ?></td>
    
    
</tr>

<?php
}


?>

</tbody>
</table>
<!-- <input class="btn-success" type="submit" name="submit" value="Choisir"> -->
</div>
</form>


<?php 

}
if(isset($_POST['choose'])){
    $ID=$_POST['choose'];
    ?>
    <div class="container">
    <br/>
        <h2>Informations affectation</h2>
        <table  class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Marque</th>
                <th>Sous marque</th>
                <th>Référence</th>
                <th>Etat</th>
                <th>Disponibilité</th>
                <th>Chargeur</th>
            </tr>
        </thead>
        <tbody>
     
           
        <?php 
$query="Select * From assets where ID =$ID";
$result = sqlsrv_query($conn, $query);

while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $type=$row['type'];
    $marque=$row['marque'];
    $sousMarque=$row['sousMarque'];
    $reference=$row['reference'];
    $etat=$row['etat'];
    $diponibilite=$row['diponibilite'];
    $chargeur=$row['chargeur'];

    $chargeur==1 ? $chargeur='Oui' : $chargeur='Non';

    //   $row['active'] == 1 ? $status='Activé' : $status='Désactivé';
    //   $status=='Désactivé' ? $action='Activer' : $action='Desactiver';
    //   $action == 'Activer' ? $yow='<tr bgcolor="#FF7F7F">' : $yow='<tr bgcolor="">';
    
    
    ?>
 
 <tr>
  <td><?php echo $ID; ?> </td>
     <td><?php echo $type; ?> </td>
     <td><?php echo $marque; ?></td>
    <td>  <?php echo $sousMarque; ?></td>
    <td>  <?php echo $reference; ?></td>
    <td>  <?php echo $etat; ?></td>
    <td>  <?php echo $diponibilite; ?></td>
    <td>  <?php echo $chargeur; ?></td>
    
    
</tr>

<?php
}


?>

</tbody>
</table>
<!-- <h2>Informations pour affectation</h2> -->
<form action="modeledecharge.php" method="POST">
<div class="col-sm-3">
   <input type="hidden" name="choose" value="<?php echo $ID; ?>">
<label>Nom: *</label><input type="text" class="form-control inp" name="nom" required>
<label>Prénom: *</label> <input type="text" class="form-control inp" name="prenom" required>
<label>Profession: </label> <input type="text" class="form-control inp" name="profession">
<label>No tel: </label> <input type="text" class="form-control inp" name="tel">
<small>(*) required</small>
</div>
<br/>
<input class="btn-primary" type="submit" name="submit1" value="Affecter">
</div>
</form>

<?php } ?>
<!-- </div> -->

<!-- <input class="" type="submit" name="submit" value="Créer"> -->

</body>
</html>


<?php



// if(isset($_POST['submit1'])){
//     $ID=$_POST['choose'];
//     $nom=$_POST['nom'];
// $prenom=$_POST['prenom'];
// $profession=$_POST['profession'];
// $tel=$_POST['tel'];

//     $query="Select * From assets where diponibilite >= 1 and ID='".$ID."'";
//     $result = sqlsrv_query($conn, $query);

  
    
//     while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
//         $ref=$row['reference'];
//     }



//     $query="INSERT INTO affectations(reference,IdAsset,nom,prenom,profession,dateAffect) values ('".$ref."','".$ID."','".$nom."','".$prenom."','".$profession."',getdate())";
//     $result = sqlsrv_query($conn, $query);

//     $query1="UPDATE assets set affecte=1 , diponibilite=diponibilite-1 where ID='".$ID."'";
//     $result1 = sqlsrv_query($conn, $query1);

// }
?>