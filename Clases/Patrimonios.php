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
            $stmt->bindColumn("LU_LONGITUD",$LU_LONGITUD);
            $stmt->bindColumn("LU_LATITUD",$LU_LATITUD);
            $stmt->bindColumn("LU_MUNICIPIO",$LU_MUNICIPIO);
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
                $modelo["LU_ID"] = utf8_encode($LU_ID);
                $modelo["LU_NOMBRE"] = utf8_encode($LU_NOMBRE);
                $modelo["LU_CATEGORIA"] = utf8_encode($LU_CATEGORIA);
                $modelo["LU_SUBCATEGORIA"] = utf8_encode($LU_SUBCATEGORIA);
                $modelo["LU_LONGITUD"] = utf8_encode($LU_LONGITUD);
                $modelo["LU_LATITUD"] = utf8_encode($LU_LATITUD);
                $modelo["LU_MUNICIPIO"] = utf8_encode($LU_MUNICIPIO);
                $modelo["LU_SINTESIS"] = utf8_encode($LU_SINTESIS);
                $modelo["LU_CLIMA"] = utf8_encode($LU_CLIMA);
                $modelo["LU_PRECIPITACION"] = utf8_encode($LU_PRECIPITACION);
                $modelo["LU_TEMPERATURA"] = utf8_encode($LU_TEMPERATURA);
                $modelo["LU_USO"] = utf8_encode($LU_USO);
                $modelo["LU_LINK"] = utf8_encode($LU_LINK);
                $modelo["LU_IMAGEN"] = utf8_encode($LU_IMAGEN); 
                array_push($lista, $modelo);
            }
	return $lista;
        }
}
