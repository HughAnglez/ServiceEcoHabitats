<?php
class Estados{
       public static function listar(){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM estados");
            $stmt->execute();

            $stmt->bindColumn("EST_ID", $EST_ID);
            $stmt->bindColumn("EST_NOMBRE", $EST_NOMBRE); 

            $lista = array();

            while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
                $modelo = array();
                $modelo["EST_ID"] = utf8_encode($EST_ID);
                $modelo["EST_NOMBRE"] = utf8_encode($EST_NOMBRE); 
                array_push($lista, $modelo);
            }
	return $lista;
        }

       public static function guardar($idestado,$nombreestado){
            $result = Conexion::conectar()->prepare("INSERT INTO estados (EST_ID, EST_NOMBRE) VALUES (:idestado, :nombreestado)");
            $result->bindParam(":idestado", $idestado, PDO::PARAM_STR);
            $result->bindParam(":nombreestado", $nombreestado, PDO::PARAM_STR); 
           
            return $result->execute();

        } 
        
        public static function editar($idestado,$nombreestado){
            $result = Conexion::conectar()->prepare("UPDATE estados set EST_NOMBRE = :nombreestado WHERE EST_ID = :idestado");
            $result->bindParam(":idestado", $idestado, PDO::PARAM_STR);
            $result->bindParam(":nombreestado", $nombreestado, PDO::PARAM_STR); 
            return $result->execute();
        }
        
        public static function eliminar($idestado){
            $result = Conexion::conectar()->prepare("DELETE FROM estados WHERE EST_ID = :idestado");
            $result->bindParam(":idestado", $idestado, PDO::PARAM_INT);
            return $result->execute();
        }
}
