<?php 
/**
 *
 * @author yalfonso
 *
 */
class Reflista extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 
	private $label = "";
	private $paquetereqtipos_id = 0;
	private $descripcion = "";
	private $requerido = 0;
	private $grupo = "";
	

	/**
     * Obtiene el identificador del tipo de requisito del paquete.
     * @return number
     */
    public function getPaquetereqtipos_id()
    {
        return $this->paquetereqtipos_id;
    }

    /**
     * Obtiene la descripción del tipo de requisito del paquete.
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene si el requisito del paquete es requerido.
     * @return number
     */
    public function getRequerido()
    {
        return $this->requerido;
    }

    /**
     * Obtiene el grupo del requisito del paquete.
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Establece el identificador del tipo de requisito del paquete.
     * @param number $paquetereqtipos_id
     */
    public function setPaquetereqtipos_id($paquetereqtipos_id)
    {
        $this->paquetereqtipos_id = $paquetereqtipos_id;
    }

    /**
     * Establece la descripción del tipo de requisito del paquete.
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece si el requisito del paquete es requerido.
     * @param number $requerido
     */
    public function setRequerido($requerido)
    {
        $this->requerido = $requerido;
    }

    /**
     * Establece el grupo del requisito del paquete.
     * @param string $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Obtiene la etiqueta del requisito del paquete.
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Establece la etiqueta del requisito del paquete.
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    /**
     * Obtiene el identificador del requisito del paquete.
     * @return int
     */
    public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del requisito del paquete.
	 *
	 * @param int $vl Identificador del requisito.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
    /**
     * Obtiene el nombre del requisito del paquete.
     *
     * @return string Nombre del requisito.
     */
	public function getNombre (){ 
		return $this->nombre;
	} 
    /**
     * Establece el nombre del requisito del paquete.
     *
     * @param string $vl Nombre del requisito.
     */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>