<?php 
/**
 *
 * @author yalfonso
 *
 */
class Sincronizacion extends Clsdatos { 

	private $id = 0; 
	private $tabla = "";
	private $idref = 0; 
	private $archivo = "";
	private $gestor = "";
	private $usuarios = "";
	private $fecha = "1900-01-01 00";
	private $sincronizacionestados_id = 0;
	private $mensaje = "";
	
    /**
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
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
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * @return number
     */
    public function getIdref()
    {
        return $this->idref;
    }

    /**
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * @return string
     */
    public function getGestor()
    {
        return $this->gestor;
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
     * @return number
     */
    public function getSincronizacionestados_id()
    {
        return $this->sincronizacionestados_id;
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
     * @param string $tabla
     */
    public function setTabla($tabla): self
    {
        $this->tabla = $tabla;
        
        return $this;
    }

    /**
     * @param number $idref
     */
    public function setIdref($idref): self
    {
        $this->idref = $idref;
        
        return $this;
    }

    /**
     * @param string $archivo
     */
    public function setArchivo($archivo): self
    {
        $this->archivo = $archivo;
        
        return $this;
    }

    /**
     * @param string $gestor
     */
    public function setGestor($gestor): self
    {
        $this->gestor = $gestor;
        
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
     * @param string $fecha
     */
    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;
        
        return $this;
    }

    /**
     * @param number $sincronizacionestados_id
     */
    public function setSincronizacionestados_id($sincronizacionestados_id): self
    {
        $this->sincronizacionestados_id = $sincronizacionestados_id;
        
        return $this;
    }
 
} 
?>