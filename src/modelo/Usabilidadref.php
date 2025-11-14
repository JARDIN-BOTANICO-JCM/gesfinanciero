<?php 
/**
 *
 * @author yalfonso
 *
 */
class Usabilidadref extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 
	private $descr = "";

    /**
     * Obtiene la descripción.
     * @return string
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Establece la descripción.
     * @param string $descr
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    /**
     * Obtiene el identificador.
     * @return number id
     */
    public function getId (){ 
		return $this->id;
	} 

    /**
     * Establece el identificador del objeto.
     *
     * @param mixed $vl Nuevo valor del id.
     * @return void
     */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
    /**
     * Obtiene el nombre.
     * @return string nombre
     */
	public function getNombre (){ 
		return $this->nombre;
	} 
    /**
     * Establece el nombre.
     * @param string $vl
     */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	
} 
?>