<?php 
/**
 *
 * @author yalfonso
 * TODO: Tarea 36 - Crear el modelo para la tabla "deducciones"
 *
 */
class Deducciones extends Clsdatos { 

	private $id = 0; 
	private $paquetes_id = 0;
	private $valor = "";
	private $usuarios = "";
	private $fecha = "1900-01-01 00:00:00";
	
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
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
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
    public function getUsuarios()
    {
        return $this->usuarios;
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
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id)
    {
        $this->paquetes_id = $paquetes_id;
    }

    /**
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
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