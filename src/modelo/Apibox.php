<?php 
/**
 *
 * @author yalfonso
 *
 */
class Apibox extends Clsdatos { 

	private $id = 0; 
	private $usuarios_id = 0;
	private $publica = "";
	private $privada = "";
	private $activo = 0;
	private $fecha = "1900-01-01 00:00:00";
	
    /**
     * @return string
     */
    public function getPrivada()
    {
        return $this->privada;
    }

    /**
     * @param string $privada
     */
    public function setPrivada($privada)
    {
        $this->privada = $privada;
    }

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
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * @return string
     */
    public function getPublica()
    {
        return $this->publica;
    }

    /**
     * @return number
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

    /**
     * @param string $publica
     */
    public function setPublica($publica)
    {
        $this->publica = $publica;
    }

    /**
     * @param number $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
	
} 
?>