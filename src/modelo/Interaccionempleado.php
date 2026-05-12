<?php 
/**
 *
 * @author yalfonso
 *
 */
class Interaccionempleado extends Clsdatos { 

	private $id = 0; 
	private $paquetes_id = 0;
	private $mensaje = "";
	private $respuesta = "";
	private $adjuntos = "";
	private $fechaempleado = "1900-01-01 00:00:00";
	private $usuarios = "";
	private $usuarios_id = 0;
	private $fecha = "1900-01-01 00:00:00";
	private $interaccionempleadoestados_id = 1;
	private $interaccionempleadoestadoslabel_id = 1;
	
    /**
     * @return number
     */
    public function getInteraccionempleadoestadoslabel_id()
    {
        return $this->interaccionempleadoestadoslabel_id;
    }

    /**
     * @param number $interaccionempleadoestadoslabel_id
     */
    public function setInteraccionempleadoestadoslabel_id($interaccionempleadoestadoslabel_id): self
    {
        $this->interaccionempleadoestadoslabel_id = $interaccionempleadoestadoslabel_id;
        
        return $this;
    }

    /**
     * @return number
     */
    public function getInteraccionempleadoestados_id()
    {
        return $this->interaccionempleadoestados_id;
    }

    /**
     * @param number $interaccionempleadoestados_id
     */
    public function setInteraccionempleadoestados_id($interaccionempleadoestados_id): self
    {
        $this->interaccionempleadoestados_id = $interaccionempleadoestados_id;
        
        return $this;
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
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
    }

    /**
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @return string
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }

    /**
     * @return string
     */
    public function getFechaempleado()
    {
        return $this->fechaempleado;
    }

    /**
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
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
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param number $id
     */
    public function setId($id): self
    {
        $this->id = $id;
        
        return $this;
    }

    /**
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id): self
    {
        $this->paquetes_id = $paquetes_id;
        
        return $this;
    }

    /**
     * @param string $mensaje
     */
    public function setMensaje($mensaje): self
    {
        $this->mensaje = $mensaje;
        
        return $this;
    }

    /**
     * @param string $respuesta
     */
    public function setRespuesta($respuesta): self
    {
        $this->respuesta = $respuesta;
        
        return $this;
    }

    /**
     * @param string $adjuntos
     */
    public function setAdjuntos($adjuntos): self
    {
        $this->adjuntos = $adjuntos;
        
        return $this;
    }

    /**
     * @param string $fechaempleado
     */
    public function setFechaempleado($fechaempleado): self
    {
        $this->fechaempleado = $fechaempleado;
        
        return $this;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios): self
    {
        $this->usuarios = $usuarios;
        
        return $this;
    }

    /**
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id): self
    {
        $this->usuarios_id = $usuarios_id;
        
        return $this;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;
        
        return $this;
    }

} 
?>