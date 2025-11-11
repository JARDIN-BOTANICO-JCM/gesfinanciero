<?php 
/**
 *
 * @author yalfonso
 */
class Firmascomentarios extends Clsdatos { 
	private $id = 0;
	private $usuarios_id = 0;
	private $usuarios = "";
	private $valor = "";
	private $fecha = "1900-01-01 00:00:00";
	private $paquetes_id = 0;
	private $firmas_id = 0;
	private $empleados_id = 0;
	private $empleados = "";
	private $empleadosfecha = "1900-01-01 00:00:00";
	private $firmascomentariosestados_id = 1;
	
    /**
     * @return number
     */
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
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
    public function getUsuarios()
    {
        return $this->usuarios;
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
     * @return number
     */
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
    }

    /**
     * @return number
     */
    public function getFirmas_id()
    {
        return $this->firmas_id;
    }

    /**
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * @return string
     */
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * @return string
     */
    public function getEmpleadosfecha()
    {
        return $this->empleadosfecha;
    }

    /**
     * @return number
     */
    public function getFirmascomentariosestados_id()
    {
        return $this->firmascomentariosestados_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
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
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id)
    {
        $this->paquetes_id = $paquetes_id;
    }

    /**
     * @param number $firmas_id
     */
    public function setFirmas_id($firmas_id)
    {
        $this->firmas_id = $firmas_id;
    }

    /**
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * @param string $empleados
     */
    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;
    }

    /**
     * @param string $empleadosfecha
     */
    public function setEmpleadosfecha($empleadosfecha)
    {
        $this->empleadosfecha = $empleadosfecha;
    }

    /**
     * @param number $firmascomentariosestados_id
     */
    public function setFirmascomentariosestados_id($firmascomentariosestados_id)
    {
        $this->firmascomentariosestados_id = $firmascomentariosestados_id;
    }

} 
?>