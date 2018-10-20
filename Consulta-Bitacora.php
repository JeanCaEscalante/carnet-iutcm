<?php
include('ConfigBdd.php');



	$sql = ("select * from bitacora");
				$busqueda=mysql_query($sql); 
				echo "<table>";
																		
									echo "<tr>";  
									echo "<th>id</th>"; 
									echo "<th>Cedula</th>";
									echo "<th>Nombres</th>";
									echo "<th>Usuario</th>";
									echo "<th>Modificado</th>";
									echo "<th>Accion</th>";
									echo "<th>Tabla</th>";    
									echo "</tr>"; 

						while ($row = mysql_fetch_array($busqueda)){
																		    
									echo "<tr>";
									echo "<td>".$row["id"]."</td>";
									echo "<td>".$row["Cedula"]."</td>";
									echo "<td>".$row["Nombres"]."</td>";
									echo "<td>".$row["Usuario"]."</td>";
									echo "<td>".$row["Modificado"]."</td>";
									echo "<td>".$row["Accion"]."</td>";
									echo "<td>".$row["Tabla"]."</td>";
									echo "</tr>";   
								}
																		
				echo "</table>"; 	
 ?>