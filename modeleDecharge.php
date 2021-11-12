<!DOCTYPE html>
<html lang="en">
<head>
<title>Décharge</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Style the body */
body {
  font-family: Arial;
  margin: 0;
}
#printBox {
        text-align: center;
        width: 500px;
        margin: auto;
    }

.Printbutton {
        display: inline-block;
        color: #fff;
        cursor: pointer;
        background-color: #3e87ec;
        padding: 20px;
        margin: 5px;
    }
    @media print {

.Printbutton {
    display: none;
}

thead.report-footer {
    display: table-header-group;
}

}
/* Header/Logo Title */
.header {
  /* padding: 0.2%; */
  margin-top:0%;
  height: 5%;
  width: 100%;
  text-align: center;
  /* background: #1abc9c; */
  /* background-image: '/logo.png'; */
  /* background-image: url("logo.png"); */
  color: white;
  font-size: 30px;
}

img {
  border: 0px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 95%;
}

/* Page Content */
.content {padding:20px;}
</style>
</head>
<body>
<div id="printBox">

<div class="Printbutton" onclick="myFunctionReturn()">
  Back</div>

<script>
function myFunction() {
    window.print();
}
function  myFunctionReturn() {
    // history.back(-1);
    // window.reload();   
    window.location.replace("affectation.php");
}
</script>
</div>



<!-- <img src="logo.png"  /> -->
    <!-- </div> !-->
   <?php
    include('config.php');
   
if(isset($_POST['submit1'])){
    $today=date("Y/m/d");
    $ID=$_POST['choose'];
    $nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$profession=$_POST['profession'];
$tel=$_POST['tel'];

    $query="Select * From assets where diponibilite >= 1 and ID='".$ID."'";
    $result = sqlsrv_query($conn, $query);

  
    
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $ref=$row['reference'];
        $etat=$row['etat'];
        $chargeur=$row['chargeur'];
        $type=$row['type']; 
        $marque=$row['marque'];
        $sousmarque=$row['sousMarque'];
    }


    // echo $ref;

    $query="INSERT INTO affectations(reference,IdAsset,nom,prenom,profession,dateAffect) values ('".$ref."','".$ID."','".$nom."','".$prenom."','".$profession."',getdate())";
    $result = sqlsrv_query($conn, $query);

    $query1="UPDATE assets set affecte=1 , diponibilite=diponibilite-1 where ID='".$ID."'";
    $result1 = sqlsrv_query($conn, $query1);


   ?>

<!-- <br/>
<br/>
<br/>
<br/>
<br/>
<br/> -->
<!-- <div class="header"> -->
  <!-- <h1>Header</h1> -->
  <!-- <p>My supercool header</p> -->
  <img src="logo.png"  />
<!-- </div> -->


<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-left:21.3pt;text-indent:-21.3pt;'><strong><span style='font-size:15px;font-family:"Verdana",sans-serif;'>&nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:center;'><strong><span style='font-size:15px;font-family:"Arial",sans-serif;'>D&eacute;partement Moyens G&eacute;n&eacute;raux</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><strong><span style='font-size:15px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><strong><span style='font-size:15px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Monsieur <?php echo $nom.' '.$prenom ?></span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Objet : D&eacute;charge&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Nous vous remettons ci-joint :&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<div style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'>
    <!-- <ul style="margin-bottom:0cm;list-style-type: undefined;margin-left:25.700000000000003px;"> -->
        <p style='margin-left:5%;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-family:"Arial",sans-serif;font-size:13px;'><?php
         $type=='PDA' ? $materiel='Téléphone Portable' : ($type=='PRINTER'|| $type=='Printer' ? $materiel='Imprimante'  : ($type=='NFC CARD' ? $materiel='Carte NFC':$materiel='')); 
        $type=='PDA' && isset($ref) ?   $refer='IMEI: ' : (($type=='PRINTER'|| $type=='Printer') && $ref!==''  ?  $refer='Référence: ' : ($type=='NFC CARD' && isset($ref)  ?  $refer=' ' :$refer='')); echo '- '.$materiel.'   '.$marque.' '.$sousmarque?>   en &eacute;tat&nbsp;</span><span style='font-family:"Arial",sans-serif;font-size:13px;'><?php echo $etat; ?></span><span style='font-family:"Arial",sans-serif;font-size:13px;'> <?php echo $refer ?> </span> <?php echo $ref; ?> <span style='font-family:"Arial",sans-serif;font-size:13px;'><?php $chargeur==1 ? $char='avec' :$char='sans' ;  if($type=='PDA'){echo $char.' chargeur' ;}  ?> &nbsp;</span><span style='font-family:"Arial",sans-serif;font-size:13px;'>.</span><span style='font-family:"Arial",sans-serif;font-size:13px;'>&nbsp;</span></p>
    <!-- </ul> -->
</div>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:3.0pt;margin-right:0cm;margin-bottom:3.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:3.0pt;margin-right:0cm;margin-bottom:3.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<!-- <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:3.0pt;margin-right:0cm;margin-bottom:3.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p> -->
<?php 
if($profession==''){?>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Nous tenons &agrave; vous informer que ce mat&eacute;riel et accessoires vous sont octroy&eacute;s dans le cadre de votre fonction actuelle.&nbsp;</span></p>

<?php }else{ ?>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Nous tenons &agrave; vous informer que ce mat&eacute;riel et accessoires vous sont octroy&eacute;s dans le cadre de votre fonction de <?php echo $profession;?>.&nbsp;</span></p>
<?php
}
?>

<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Celui-ci &eacute;tant toujours propri&eacute;t&eacute; de FGD, en cas de changement de fonction ou de d&eacute;mission, vous vous engagez &agrave; restituer au d&eacute;partement RH contre accus&eacute; de r&eacute;ception l&rsquo;ensemble du mat&eacute;riel.&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Aussi, les frais de casse ou de vol suite &agrave; une n&eacute;gligence seront &agrave; votre charge.</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<div style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;border-bottom:solid windowtext 1.0pt;padding:0cm 0cm 1.0pt 0cm;'>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Cordialement. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:right;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>Berrechid, le <?php echo $today  ?>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>D&eacute;partement Moyens G&eacute;n&eacute;raux &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
    <p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;border:none;padding:0cm;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
</div>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-top:6.0pt;'><strong><u><span style='font-size:13px;font-family:"Arial",sans-serif;'>Accus&eacute; de r&eacute;ception</span></u></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>Je soussign&eacute;<strong>&nbsp;MR <?php echo $nom.' '.$prenom ?>&nbsp;</strong>reconnais avoir re&ccedil;u les Equipements &amp; moyens susmentionn&eacute;s, et m&rsquo;engage &agrave; respecter les termes du pr&eacute;sent document.</span></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Berrechid, le <?php echo $today  ?></span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'><strong><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Signature :&nbsp;</span></strong></p>
<p style='margin:0cm;font-size:16px;font-family:"Times New Roman",serif;margin-left:247.8pt;'><span style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></p>


<?php



echo '<script language="javascript">';
echo 'alert("Affecté avec succès !");window.print();';
echo '</script>';


}
?>



</body>
</html>
