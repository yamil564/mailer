<?php
class Mysql extends Conexion
{
    //put your code here
    private $conexion;
    private $strquery;
    private $arrvalues;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function insert_data(string $query, array $arrvalues)
    {
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        $insert = $this->conexion->prepare($this->strquery);
        $resinsert = $insert->execute($this->arrvalues);
        if ($resinsert) {
            return $this->conexion->lastInsertId();
        }
        return 0;
    }

    public function select_data(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function select_all_data(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        return $result->fetchall(PDO::FETCH_ASSOC);
    }

    public function update_data(string $query, array $arrvalues)
    {
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        $update = $this->conexion->prepare($this->strquery);
        $update->execute($this->arrvalues);
        return $update;
    }

    public function delete_data(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        return $result->execute();
    }
}
