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
     * Obtiene el identificador del registro de administración de paquetes.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el identificador del paquete asociado al registro de administración.
     * @return number
     */
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
    }

    /**
     * Obtiene la razón del registro de administración de paquetes.
     * @return string
     */
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Obtiene el valor asociado al registro de administración de paquetes.
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Obtiene la fecha del registro de administración de paquetes.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene el usuario asociado al registro de administración de paquetes.
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Establece el identificador del registro de administración de paquetes.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el identificador del paquete asociado al registro de administración.
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id)
    {
        $this->paquetes_id = $paquetes_id;
    }

    /**
     * Establece la razón del registro de administración de paquetes.
     * @param string $razon
     */
    public function setRazon($razon)
    {
        $this->razon = $razon;
    }

    /**
     * Establece el valor asociado al registro de administración de paquetes.
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * Establece la fecha del registro de administración de paquetes.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece el usuario asociado al registro de administración de paquetes.
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

} 
?>