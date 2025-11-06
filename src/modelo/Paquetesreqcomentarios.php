<?php 
/**
 *
 * @author yalfonso
 */
class Paquetesreqcomentarios extends Clsdatos { 

	private $id = 0;
	// TODO: Tarea 55 - Agregar el campo usuarios_id en la tabla paquetesreqcomentarios y el modelo Paquetesreqcomentarios
	private $usuarios_id = 0;
	private $usuarios = "";
	private $valor = "";
	private $fecha = "";
	private $paquetesrequ_id = 0;
	// TODO: Tarea 43 - Modificar el modelo de la tabla paquetesreqcomentarios para agregar la nueva columna
	private $paquetesreqcomentariosestados_id = 1;
	// TODO: Tarea 44 - Agregar los campos "lector" y "lectorfecha" a la tabla paquetesreqcomentarios
	private $empleados_id = 0;
	private $empleados = "";
	private $empleadosfecha = "1900-01-01 00:00:00";
	
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
    public function getPaquetesrequ_id()
    {
        return $this->paquetesrequ_id;
    }

    /**
     * @return number
     */
    public function getPaquetesreqcomentariosestados_id()
    {
        return $this->paquetesreqcomentariosestados_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $usuario
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
     * @param number $paquetesrequ_id
     */
    public function setPaquetesrequ_id($paquetesrequ_id)
    {
        $this->paquetesrequ_id = $paquetesrequ_id;
    }

    /**
     * @param number $paquetesreqcomentariosestados_id
     */
    public function setPaquetesreqcomentariosestados_id($paquetesreqcomentariosestados_id)
    {
        $this->paquetesreqcomentariosestados_id = $paquetesreqcomentariosestados_id;
    }

	
} 
?>