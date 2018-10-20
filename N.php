<?php

// Your code here!

echo FormatoNombre("Jean Carlos");
echo FormatoNombre("Escalante Lara");

function FormatoNombre($nombre){

  $longitud = 0;
  $numUPCpar = array();
  $numUPCimpar = array();
  $long = array();
  $elementos = "";

  $elementos = explode(" ", $nombre);

//saco el numero de elementos
$longitud = count($elementos);
 
//Recorro todos los elementos
for($i=0; $i<$longitud; $i++){
  
      //saco el valor de cada elemento
  if ($i % 2 == 1){

      $long[] = substr($elementos[$i],0,1).".";

  }else if ($i % 2 == 0) {
       $numUPCpar[] = $elementos[$i]." ";
  }
  
}
 return $numUPCpar[0]." ".$long[0]." ";

}



?>