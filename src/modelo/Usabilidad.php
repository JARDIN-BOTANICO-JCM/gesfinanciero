<?php
/**
 *
 * @author yalfonso
 *
 */
class Usabilidad extends Clsdatos {
    
    private $id = 0;
    private $usabilidadref_id = 0;
    private $valor = "";
    private $usuario = "";
    private $urlref = "";
    private $fecha = "1900-01-01 00:00:00";
    private $ip = "0.0.0.0";
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return number
     */
    public function getUsabilidadref_id()
    {
        return $this->usabilidadref_id;
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
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @return string
     */
    public function getUrlref()
    {
        return $this->urlref;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        date_default_timezone_set('America/Bogota');
        //return $this->fecha;
        return date('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $usabilidadref_id
     */
    public function setUsabilidadref_id($usabilidadref_id)
    {
        $this->usabilidadref_id = $usabilidadref_id;
    }

    /**
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @param string $urlref
     */
    public function setUrlref($urlref)
    {
        $this->urlref = $urlref;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    
}
?>