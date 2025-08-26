<?php
/**
 *
 * @author yalfonso
 *
 */
class Paquetesrequ extends Clsdatos { 
    private $id = 0;
    private $ref = "";
    private $valor = "";
    private $descripcion = "";
    private $paquetesreqestados_id = 0;
    private $paquetereqtipos_id = 0;
    private $paquetes_id = 0;
    private $flujositems_id = 0;
    private $valorgestor = ""; // aqui actualiza la ruta del documento que entrega el gestor documental
    
    private $fecha = '1900-01-01 00:00:00';
    private $fechamod = '1900-01-01 00:00:00';
    private $usuariomodifica = '';
    private $perfilmodifica = '';
    
    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return string
     */
    public function getFechamod()
    {
        return $this->fechamod;
    }

    /**
     * @return string
     */
    public function getUsuariomodifica()
    {
        return $this->usuariomodifica;
    }

    /**
     * @return string
     */
    public function getPerfilmodifica()
    {
        return $this->perfilmodifica;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $fechamod
     */
    public function setFechamod($fechamod)
    {
        $this->fechamod = $fechamod;
    }

    /**
     * @param string $usuariomodifica
     */
    public function setUsuariomodifica($usuariomodifica)
    {
        $this->usuariomodifica = $usuariomodifica;
    }

    /**
     * @param string $perfilmodifica
     */
    public function setPerfilmodifica($perfilmodifica)
    {
        $this->perfilmodifica = $perfilmodifica;
    }

    /**
     * @return string
     */
    public function getValorgestor()
    {
        return $this->valorgestor;
    }

    /**
     * @param string $valorgestor
     */
    public function setValorgestor($valorgestor)
    {
        $this->valorgestor = $valorgestor;
    }

    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return number
     */
    public function getPaquetesreqestados_id()
    {
        return $this->paquetesreqestados_id;
    }

    /**
     * @return number
     */
    public function getPaquetereqtipos_id()
    {
        return $this->paquetereqtipos_id;
    }

    /**
     * @return number
     */
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
    }

    /**
     * @return number
     */
    public function getFlujositems_id()
    {
        return $this->flujositems_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param number $paquetesreqestados_id
     */
    public function setPaquetesreqestados_id($paquetesreqestados_id)
    {
        $this->paquetesreqestados_id = $paquetesreqestados_id;
    }

    /**
     * @param number $paquetereqtipos_id
     */
    public function setPaquetereqtipos_id($paquetereqtipos_id)
    {
        $this->paquetereqtipos_id = $paquetereqtipos_id;
    }

    /**
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id)
    {
        $this->paquetes_id = $paquetes_id;
    }

    /**
     * @param number $flujositems_id
     */
    public function setFlujositems_id($flujositems_id)
    {
        $this->flujositems_id = $flujositems_id;
    }

}

?>