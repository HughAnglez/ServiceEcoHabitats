<?php 
class Patrimonios {
     public static function listarPorCategoria($lucategoria){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM lugares WHERE LU_CATEGORIA =:lucategoria ");     
            $stmt->bindParam(":lucategoria", $lucategoria, PDO::PARAM_STR);
            $stmt->execute();          
             
            $stmt->bindColumn("LU_ID",$LU_ID);
            $stmt->bindColumn("LU_NOMBRE",$LU_NOMBRE);
            $stmt->bindColumn("LU_CATEGORIA",$LU_CATEGORIA);
            $stmt->bindColumn("LU_SUBCATEGORIA",$LU_SUBCATEGORIA);
            $stmt->bindColumn("LU_LONG",$LU_LONGITUD);
            $stmt->bindColumn("LU_LAT",$LU_LATITUD);
            $stmt->bindColumn("LU_MUN",$LU_MUNICIPIO);
            $stmt->bindColumn("LU_SINTESIS",$LU_SINTESIS);
            $stmt->bindColumn("LU_CLIMA",$LU_CLIMA);
            $stmt->bindColumn("LU_PRECIPITACION",$LU_PRECIPITACION);
            $stmt->bindColumn("LU_TEMPERATURA",$LU_TEMPERATURA);
            $stmt->bindColumn("LU_USO",$LU_USO);
            $stmt->bindColumn("LU_LINK",$LU_LINK);
            $stmt->bindColumn("LU_IMAGEN",$LU_IMAGEN); 

            $lista = array();

            while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
                $modelo = array();
                $modelo["LU_ID"] = $LU_ID;
                $modelo["LU_NOMBRE"] = $LU_NOMBRE;
                $modelo["LU_CATEGORIA"] = $LU_CATEGORIA;
                $modelo["LU_SUBCATEGORIA"] = $LU_SUBCATEGORIA;
                $modelo["LU_LON"] = $LU_LONGITUD;
                $modelo["LU_LAT"] = $LU_LATITUD;
                $modelo["LU_MUN"] = $LU_MUNICIPIO;
                $modelo["LU_SINTESIS"] = $LU_SINTESIS;
                $modelo["LU_CLIMA"] = $LU_CLIMA;
                $modelo["LU_PRECIPITACION"] = $LU_PRECIPITACION;
                $modelo["LU_TEMPERATURA"] = $LU_TEMPERATURA;
                $modelo["LU_USO"] = $LU_USO;
                $modelo["LU_LINK"] = $LU_LINK;
                $modelo["LU_IMAGEN"] = $LU_IMAGEN; 
                array_push($lista, $modelo);
            }
	return $lista;
        }
}
