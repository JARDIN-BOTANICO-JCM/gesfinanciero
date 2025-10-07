<?php 
/**
 *
 * @author yalfonso
 *
 */
class Paquetesadminreg extends Clsdatos { 

    public const CREACION_TERCERO = "Registro confirmación creación tercero";
	private $id = 0; 
    private $paquetes_id = 0;
    private $razon = ""; // Registro confirmación creación tercero ERP”, “Solicitud de algo al usuario”',
    private $valor = ""; // Debe tener un registro JSON con los valores de algún formulario
    private $fecha = "1900-01-01 00:00:00";
    private $usuarios = "";
   
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
    public function getRazon()
    {
        return $this->razon;
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
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
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
     * @param string $razon
     */
    public function setRazon($razon)
    {
        $this->razon = $razon;
    }

    /**
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

} 
?>