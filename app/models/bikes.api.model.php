<?php
require_once 'app/models/model.php';

class BikesModel extends Model {

    public function getBikes($limit, $offset) {

        $query = $this->db->prepare("SELECT * FROM bicicletas LIMIT $limit OFFSET $offset");
        $query->execute();

        $bikes = $query->fetchAll(PDO::FETCH_OBJ); //pdo: agarro datos como arreglo

        return $bikes; //retorno datos para su luego uso
    }

    public function getBike($id) {

        $query = $this->db->prepare('SELECT * FROM bicicletas where id = ?');
        $query->execute([$id]);

        $bikes = $query->fetch(PDO::FETCH_OBJ);

        return $bikes;
    }

    function insertBike($brand, $year, $color, $type) {
        $query = $this->db->prepare("INSERT INTO `bicicletas` ( `marca`, `anio`, `color`, `id_tipos_fk`) VALUES ( ? , ? , ? , ?);");
        $query->execute([ $brand, $year, $color, $type]);

        return $this->db->lastInsertId();
    }


    function updateBike($brand, $year, $color,$type, $id) {
        $query = $this->db->prepare("UPDATE `bicicletas` SET `marca` = ?, `anio` = ?, `color` = ?, `id_tipos_fk` = ? WHERE `bicicletas`.`id` = ?;");
        $query->execute([$brand, $year, $color,$type, $id]);
    }


    function deleteBike($id) {
        $query = $this->db->prepare('DELETE FROM bicicletas WHERE id = ?');
        $query->execute([$id]);
    }

    function Upward() {  //ascendente

        $query = $this->db->prepare("SELECT * FROM bicicletas ORDER BY anio ASC");
        $query->execute();
        $bike = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $bike;
    }
    
    function Falling() {   //descendente

        $query = $this->db->prepare("SELECT * FROM bicicletas ORDER BY anio DESC");
        $query->execute();
        $bike = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $bike;
    }
    public function getFilteredBikes($color = null, $anio = null, $marca = null) { //filtrado
        $sql = "SELECT * FROM bicicletas WHERE 1";
        $params = [];

        if ($color) {
            $sql .= " AND color = :color";
            $params[':color'] = $color;
        }
        if ($anio) {
            $sql .= " AND anio = :anio";
            $params[':anio'] = $anio;
        }
        if ($marca) {
            $sql .= " AND marca = :marca";
            $params[':marca'] = $marca;
        }

        $query = $this->db->prepare($sql);
        $query->execute($params);
        $bikes = $query->fetchAll(PDO::FETCH_OBJ);
        return $bikes;
    }
}