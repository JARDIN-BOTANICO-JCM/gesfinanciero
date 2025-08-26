<?php 
/**
 *
 * @author yalfonso
 *
 */
class Firmas extends Clsdatos { 

	private $id = 0; 
    private $pdfid = "";
    private $acudientes_id = 0;
    private $acudientes = "";
    private $documento = "";
    private $tipodoc = "";
    private $estudiantes_id = 0;
    private $estudiantes = "";
    private $est_documento = "";
    private $est_tipodoc = "";
    private $fecha = "1900-01-01 00:00:00";
    private $mail = "";
    
    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
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
    public function getPdfid()
    {
        return $this->pdfid;
    }

    /**
     * @return number
     */
    public function getAcudientes_id()
    {
        return $this->acudientes_id;
    }

    /**
     * @return string
     */
    public function getAcudientes()
    {
        return $this->acudientes;
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
     * @return number
     */
    public function getEstudiantes_id()
    {
        return $this->estudiantes_id;
    }

    /**
     * @return string
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }

    /**
     * @return string
     */
    public function getEst_documento()
    {
        return $this->est_documento;
    }

    /**
     * @return string
     */
    public function getEst_tipodoc()
    {
        return $this->est_tipodoc;
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
     * @param string $pdfid
     */
    public function setPdfid($pdfid)
    {
        $this->pdfid = $pdfid;
    }

    /**
     * @param number $acudientes_id
     */
    public function setAcudientes_id($acudientes_id)
    {
        $this->acudientes_id = $acudientes_id;
    }

    /**
     * @param string $acudientes
     */
    public function setAcudientes($acudientes)
    {
        $this->acudientes = $acudientes;
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
     * @param number $estudiantes_id
     */
    public function setEstudiantes_id($estudiantes_id)
    {
        $this->estudiantes_id = $estudiantes_id;
    }

    /**
     * @param string $estudiantes
     */
    public function setEstudiantes($estudiantes)
    {
        $this->estudiantes = $estudiantes;
    }

    /**
     * @param string $est_documento
     */
    public function setEst_documento($est_documento)
    {
        $this->est_documento = $est_documento;
    }

    /**
     * @param string $est_tipodoc
     */
    public function setEst_tipodoc($est_tipodoc)
    {
        $this->est_tipodoc = $est_tipodoc;
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