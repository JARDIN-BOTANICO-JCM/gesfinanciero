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
     * @return string
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * @param string $descr
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;
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