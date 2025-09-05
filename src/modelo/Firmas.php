<?php 
/**
 *
 * @author yalfonso
 *
 */
class Firmas extends Clsdatos { 

	private $id = 0;
	private $pdfid = "";
	private $perfilusuarios_id = 0;
	private $firmante_id = 0;
	private $nombrefull = "";
	private $documento = "";
	private $tipodoc = "";
	private $fecha = "1900-01-01 00:00:00";
	private $mail = "";
	
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
    public function getPdfid()
    {
        return $this->pdfid;
    }

    /**
     * @return number
     */
    public function getPerfilusuarios_id()
    {
        return $this->perfilusuarios_id;
    }

    /**
     * @return number
     */
    public function getFirmante_id()
    {
        return $this->firmante_id;
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
    public function getDocumento()
    {
        return $this->documento;
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
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $pdfid
     */
    public function setPdfid($pdfid)
    {
        $this->pdfid = $pdfid;
    }

    /**
     * @param number $perfilusuarios_id
     */
    public function setPerfilusuarios_id($perfilusuarios_id)
    {
        $this->perfilusuarios_id = $perfilusuarios_id;
    }

    /**
     * @param number $firmante_id
     */
    public function setFirmante_id($firmante_id)
    {
        $this->firmante_id = $firmante_id;
    }

    /**
     * @param string $nombrefull
     */
    public function setNombrefull($nombrefull)
    {
        $this->nombrefull = $nombrefull;
    }

    /**
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * @param string $tipodoc
     */
    public function setTipodoc($tipodoc)
    {
        $this->tipodoc = $tipodoc;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
	
} 
?>