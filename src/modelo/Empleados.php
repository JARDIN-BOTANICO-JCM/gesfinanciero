<?php 
/**
 *
 * @author yalfonso
 *
 */
class Empleados extends Clsdatos { 

	private $id = 0; 
	private $tipodoc_id = 0; 
	private $documento = ""; 
	private $lugarescedula_id = 0; 
	private $nombres = ""; 
	private $apellidos = ""; 
	private $mail = ""; 
	private $nacimiento = ""; 
	private $generos_id = 0; 
	private $lugares_id = 0; 
	private $gruposanguineo = ""; 
	private $codigo = ""; 
	private $usuario = ""; 
	private $clave = ""; 
	private $foto = ""; 
	private $direccion = ""; 
	private $barrio = ""; 
	private $loc_lugares_id = 0; 
	private $cargos_id = 0; 
	private $titulos_id = 0; 
	private $creado = ""; 
	private $perfil_id = 0; 
	private $estado_id = 0; 
	
	private $eps = "";
	private $ars = "";
	
	private $oficio = '';
	private $salariomes = 0;
	private $contratoini = '1900-01-01 00:00:00';
	private $contratofin = '1900-01-01 00:00:00';
	
	private $dependencias_id = 0;
	
    /**
     * @return number
     */
    public function getDependencias_id()
    {
        return $this->dependencias_id;
    }

    /**
     * @param number $dependencias_id
     */
    public function setDependencias_id($dependencias_id)
    {
        $this->dependencias_id = $dependencias_id;
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
    public function getTipodoc_id()
    {
        return $this->tipodoc_id;
    }

    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @return number
     */
    public function getLugarescedula_id()
    {
        return $this->lugarescedula_id;
    }

    /**
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return string
     */
    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    /**
     * @return number
     */
    public function getGeneros_id()
    {
        return $this->generos_id;
    }

    /**
     * @return number
     */
    public function getLugares_id()
    {
        return $this->lugares_id;
    }

    /**
     * @return string
     */
    public function getGruposanguineo()
    {
        return $this->gruposanguineo;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return string
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * @return number
     */
    public function getLoc_lugares_id()
    {
        return $this->loc_lugares_id;
    }

    /**
     * @return number
     */
    public function getCargos_id()
    {
        return $this->cargos_id;
    }

    /**
     * @return number
     */
    public function getTitulos_id()
    {
        return $this->titulos_id;
    }

    /**
     * @return string
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * @return number
     */
    public function getPerfil_id()
    {
        return $this->perfil_id;
    }

    /**
     * @return number
     */
    public function getEstado_id()
    {
        return $this->estado_id;
    }

    /**
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * @return string
     */
    public function getArs()
    {
        return $this->ars;
    }

    /**
     * @return string
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * @return number
     */
    public function getSalariomes()
    {
        return $this->salariomes;
    }

    /**
     * @return string
     */
    public function getContratoini()
    {
        return $this->contratoini;
    }

    /**
     * @return string
     */
    public function getContratofin()
    {
        return $this->contratofin;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $tipodoc_id
     */
    public function setTipodoc_id($tipodoc_id)
    {
        $this->tipodoc_id = $tipodoc_id;
    }

    /**
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * @param number $lugarescedula_id
     */
    public function setLugarescedula_id($lugarescedula_id)
    {
        $this->lugarescedula_id = $lugarescedula_id;
    }

    /**
     * @param string $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param string $nacimiento
     */
    public function setNacimiento($nacimiento)
    {
        $this->nacimiento = $nacimiento;
    }

    /**
     * @param number $generos_id
     */
    public function setGeneros_id($generos_id)
    {
        $this->generos_id = $generos_id;
    }

    /**
     * @param number $lugares_id
     */
    public function setLugares_id($lugares_id)
    {
        $this->lugares_id = $lugares_id;
    }

    /**
     * @param string $gruposanguineo
     */
    public function setGruposanguineo($gruposanguineo)
    {
        $this->gruposanguineo = $gruposanguineo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @param string $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @param string $barrio
     */
    public function setBarrio($barrio)
    {
        $this->barrio = $barrio;
    }

    /**
     * @param number $loc_lugares_id
     */
    public function setLoc_lugares_id($loc_lugares_id)
    {
        $this->loc_lugares_id = $loc_lugares_id;
    }

    /**
     * @param number $cargos_id
     */
    public function setCargos_id($cargos_id)
    {
        $this->cargos_id = $cargos_id;
    }

    /**
     * @param number $titulos_id
     */
    public function setTitulos_id($titulos_id)
    {
        $this->titulos_id = $titulos_id;
    }

    /**
     * @param string $creado
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;
    }

    /**
     * @param number $perfil_id
     */
    public function setPerfil_id($perfil_id)
    {
        $this->perfil_id = $perfil_id;
    }

    /**
     * @param number $estado_id
     */
    public function setEstado_id($estado_id)
    {
        $this->estado_id = $estado_id;
    }

    /**
     * @param string $eps
     */
    public function setEps($eps)
    {
        $this->eps = $eps;
    }

    /**
     * @param string $ars
     */
    public function setArs($ars)
    {
        $this->ars = $ars;
    }

    /**
     * @param string $oficio
     */
    public function setOficio($oficio)
    {
        $this->oficio = $oficio;
    }

    /**
     * @param number $salariomes
     */
    public function setSalariomes($salariomes)
    {
        $this->salariomes = $salariomes;
    }

    /**
     * @param string $contratoini
     */
    public function setContratoini($contratoini)
    {
        $this->contratoini = $contratoini;
    }

    /**
     * @param string $contratofin
     */
    public function setContratofin($contratofin)
    {
        $this->contratofin = $contratofin;
    }

} 
?>