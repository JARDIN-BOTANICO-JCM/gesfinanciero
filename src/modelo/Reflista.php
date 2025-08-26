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
     * @return number
     */
    public function getPaquetereqtipos_id()
    {
        return $this->paquetereqtipos_id;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return number
     */
    public function getRequerido()
    {
        return $this->requerido;
    }

    /**
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * @param number $paquetereqtipos_id
     */
    public function setPaquetereqtipos_id($paquetereqtipos_id)
    {
        $this->paquetereqtipos_id = $paquetereqtipos_id;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param number $requerido
     */
    public function setRequerido($requerido)
    {
        $this->requerido = $requerido;
    }

    /**
     * @param string $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getId (){ 
		return $this->id;
	} 
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	public function getNombre (){ 
		return $this->nombre;
	} 
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>