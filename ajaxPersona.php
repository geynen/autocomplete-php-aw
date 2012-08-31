<?php
require("datos/cado.php");
$action = $_POST["action"];
if($action=="BuscaPersona"){
	$action = $_POST["action"];
	$nombres = utf8_decode($_POST["nombres"]);
	$div = $_POST["div"];
	
	$consulta=$cnx->query("SELECT Distinct persona.IdPersona, CONCAT(apellidos,' ',nombres) as Nombres, NroDoc FROM persona WHERE CONCAT(apellidos,' ',nombres) LIKE '%" . $nombres . "%' ");	
	
	echo "<table id='tablaPersona'><tr><th>N° Doc.</th><th>Apellidos y Nombres</th></tr>";
	while($registro=$consulta->fetchObject())
	{
	   $registros.= "<tr id='".$registro->IdPersona."' class='$estilo' onClick='mostrarPersona(".$registro->IdPersona.",&quot;".$div."&quot;)' style='cursor:pointer;'>";
	   $registros.= "<td>".$registro->NroDoc."</td>";
			   //LO SGTE PARA OBTENER LA PORSION DE TEXTO QUE COINCIDE Y CAMBIARLE DE ESTILO, $cadena2 -> está variable contiene el valor q coincide, al cual lo ubico en una etiqueta span para cambiarle de estilo.
				$posicion  = stripos($registro->Nombres, $nombres);
				if($posicion>-1){
					$cadena1 = substr($registro->Nombres, 0, $posicion);
					$cadena2 = substr($registro->Nombres, $posicion, strlen($nombres));
					$cadena3 = substr($registro->Nombres, ($posicion + strlen($nombres)));
					
					$dato = $cadena1.'<span>'.$cadena2.'</span>'.$cadena3;
					$registros.= "<td>".$dato."</td>";
				}else{
					$registros.= "<td>".$registro->Nombres."</td>";
					}
	   $registros.= "</tr>";
	}
	echo utf8_encode($registros);
	echo "</table>";
}
if($action=="mostrarPersona"){
	$action = $_POST["action"];
	$id = $_POST["id"];
	
	$consulta=$cnx->query("SELECT Distinct persona.IdPersona, CONCAT(apellidos,' ',nombres) as Nombres, NroDoc FROM persona WHERE IdPersona=".$id);	

	while($registro=$consulta->fetchObject())
	{
		echo "vNombres='".utf8_encode($registro->Nombres)."';";	  
	}
}
?>