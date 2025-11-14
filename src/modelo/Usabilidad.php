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
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el identificador de referencia de usabilidad.
     * @return number
     */
    public function getUsabilidadref_id()
    {
        return $this->usabilidadref_id;
    }

    /**
     * Obtiene el valor.
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Obtiene el usuario.
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Obtiene la URL de referencia.
     * @return string
     */
    public function getUrlref()
    {
        return $this->urlref;
    }

    /**
     * Obtiene la fecha.
     * @return string
     */
    public function getFecha()
    {
        date_default_timezone_set('America/Bogota');
        //return $this->fecha;
        return date('Y-m-d H:i:s');
    }

    /**
     * Obtiene la IP.
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Establece el identificador.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el identificador de referencia de usabilidad.
     * @param number $usabilidadref_id
     */
    public function setUsabilidadref_id($usabilidadref_id)
    {
        $this->usabilidadref_id = $usabilidadref_id;
    }

    /**
     * Establece el valor.
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * Establece el usuario.
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Establece la URL de referencia.
     * @param string $urlref
     */
    public function setUrlref($urlref)
    {
        $this->urlref = $urlref;
    }

    /**
     * Establece la fecha.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece la IP.
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    
}
?>