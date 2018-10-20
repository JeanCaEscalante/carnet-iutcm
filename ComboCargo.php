<?php

include('ConfigBdd.php');

$idTipoCarg = $_POST['idTipoCarg'];

    $cargo ="Select * From cargo where idTipoCarg = '$idTipoCarg'";
    $result=mysql_query($cargo);
    while($row = mysql_fetch_array($result)) {

             echo "<option value='".$row['CodCargo']."'>".$row['Cargo']."</option>";

    }
?>