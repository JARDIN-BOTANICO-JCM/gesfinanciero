<?php 
/**
 *
 * @author yalfonso
 *
 */
class Firmaslog extends Clsdatos { 

	private $id = 0; 
	private $firmas_id = 0;
	private $firmasestados_id = 0;
	private $ip = "";
	private $pdfurl = "";
	private $pdfruta = "";
	private $pdfhash = "";
	private $paginas = 0;
	private $fecha = "1900-01-01 00:00:00";
	private $perfilusuarios_id = 0;
	private $nombrefull = "";
	private $tipodoc = "";
	private $documento = "";
	
    /**
     * @return number
     */
    public function getPerfilusuarios_id()
    {
        return $this->perfilusuarios_id;
    }

    /**
     * @return string
     */
    public function getNombrefull()
    {
        return $this->nombrefull;
    }

    /**
     * @return string
     */
    public function getTipodoc()
    {
        return $this->tipodoc;
    }

    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param number $perfilusuarios_id
     */
    public function setPerfilusuarios_id($perfilusuarios_id)
    {
        $this->perfilusuarios_id = $perfilusuarios_id;
    }

    /**
     * @param string $nombrefull
     */
    public function setNombrefull($nombrefull)
    {
        $this->nombrefull = $nombrefull;
    }

    /**
     * @param string $tipodoc
     */
    public function setTipodoc($tipodoc)
    {
        $this->tipodoc = $tipodoc;
    }

    /**
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * @return string
     */
    public function getPdfurl()
    {
        return $this->pdfurl;
    }

    /**
     * @param string $pdfurl
     */
    public function setPdfurl($pdfurl)
    {
        $this->pdfurl = $pdfurl;
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
    public function getFirmas_id()
    {
        return $this->firmas_id;
    }

    /**
     * @return number
     */
    public function getFirmasestados_id()
    {
        return $this->firmasestados_id;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getPdfruta()
    {
        return $this->pdfruta;
    }

    /**
     * @return string
     */
    public function getPdfhash()
    {
        return $this->pdfhash;
    }

    /**
     * @return number
     */
    public function getPaginas()
    {
        return $this->paginas;
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $firmas_id
     */
    public function setFirmas_id($firmas_id)
    {
        $this->firmas_id = $firmas_id;
    }

    /**
     * @param number $firmasestados_id
     */
    public function setFirmasestados_id($firmasestados_id)
    {
        $this->firmasestados_id = $firmasestados_id;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @param string $pdfruta
     */
    public function setPdfruta($pdfruta)
    {
        $this->pdfruta = $pdfruta;
    }

    /**
     * @param string $pdfhash
     */
    public function setPdfhash($pdfhash)
    {
        $this->pdfhash = $pdfhash;
    }

    /**
     * @param number $paginas
     */
    public function setPaginas($paginas)
    {
        $this->paginas = $paginas;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

} 
?>