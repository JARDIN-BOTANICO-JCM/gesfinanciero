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
     * Obtiene el identificador de la dependencia.
     * @return number
     */
    public function getDependencias_id()
    {
        return $this->dependencias_id;
    }

    /**
     * Establece el identificador de la dependencia.
     * @param number $dependencias_id
     */
    public function setDependencias_id($dependencias_id)
    {
        $this->dependencias_id = $dependencias_id;
    }

    /**
     * Obtiene el identificador del empleado.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el identificador del tipo de documento.
     * @return number
     */
    public function getTipodoc_id()
    {
        return $this->tipodoc_id;
    }

    /**
     * Obtiene el número de documento.
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Obtiene el identificador del lugar de expedición de la cédula.
     * @return number
     */
    public function getLugarescedula_id()
    {
        return $this->lugarescedula_id;
    }

    /**
     * Obtiene los nombres del empleado.
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Obtiene los apellidos del empleado.
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Obtiene el correo electrónico del empleado.
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Obtiene la fecha de nacimiento del empleado.
     * @return string
     */
    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    /**
     * Obtiene el identificador del género del empleado.
     * @return number
     */
    public function getGeneros_id()
    {
        return $this->generos_id;
    }

    /**
     * Obtiene el identificador del lugar del empleado.
     * @return number
     */
    public function getLugares_id()
    {
        return $this->lugares_id;
    }

    /**
     *  Obtiene el grupo sanguíneo del empleado.
     * @return string
     */
    public function getGruposanguineo()
    {
        return $this->gruposanguineo;
    }

    /**
     * Obtiene el código del empleado.
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Obtiene el nombre de usuario del empleado.
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Obtiene la clave del empleado.
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Obtiene la foto del empleado.
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Obtiene la dirección del empleado.
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Obtiene el barrio del empleado.
     * @return string
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Obtiene el identificador del lugar local del empleado.
     * @return number
     */
    public function getLoc_lugares_id()
    {
        return $this->loc_lugares_id;
    }

    /**
     * Obtiene el identificador del cargo del empleado.
     * @return number
     */
    public function getCargos_id()
    {
        return $this->cargos_id;
    }

    /**
     * Obtiene el identificador del título del empleado.
     * @return number
     */
    public function getTitulos_id()
    {
        return $this->titulos_id;
    }

    /**
     * Obtiene la fecha de creación del empleado.
     * @return string
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Obtiene el identificador del perfil del empleado.
     * @return number
     */
    public function getPerfil_id()
    {
        return $this->perfil_id;
    }

    /**
     * Obtiene el identificador del estado del empleado.
     * @return number
     */
    public function getEstado_id()
    {
        return $this->estado_id;
    }

    /**
     * Obtiene la EPS del empleado.
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Obtiene la ARS del empleado.
     * @return string
     */
    public function getArs()
    {
        return $this->ars;
    }

    /**
     * Obtiene el oficio del empleado.
     * @return string
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * Obtiene el salario mensual del empleado.
     * @return number
     */
    public function getSalariomes()
    {
        return $this->salariomes;
    }

    /**
     * Obtiene la fecha de inicio del contrato del empleado.
     * @return string
     */
    public function getContratoini()
    {
        return $this->contratoini;
    }

    /**
     * Obtiene la fecha de fin del contrato del empleado.
     * @return string
     */
    public function getContratofin()
    {
        return $this->contratofin;
    }

    /**
     * Obtiene el identificador del empleado.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el identificador del tipo de documento.
     * @param number $tipodoc_id
     */
    public function setTipodoc_id($tipodoc_id)
    {
        $this->tipodoc_id = $tipodoc_id;
    }

    /**
     * Establece el número de documento.
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * Establece el identificador del lugar de expedición de la cédula.
     * @param number $lugarescedula_id
     */
    public function setLugarescedula_id($lugarescedula_id)
    {
        $this->lugarescedula_id = $lugarescedula_id;
    }

    /**
     * Establece los nombres del empleado.
     * @param string $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * Establece los apellidos del empleado.
     * @param string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * Establece el correo electrónico del empleado.
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Establece la fecha de nacimiento del empleado.
     * @param string $nacimiento
     */
    public function setNacimiento($nacimiento)
    {
        $this->nacimiento = $nacimiento;
    }

    /**
     * Establece el identificador del género del empleado.
     * @param number $generos_id
     */
    public function setGeneros_id($generos_id)
    {
        $this->generos_id = $generos_id;
    }

    /**
     * Establece el identificador del lugar del empleado.
     * @param number $lugares_id
     */
    public function setLugares_id($lugares_id)
    {
        $this->lugares_id = $lugares_id;
    }

    /**
     * Establece el grupo sanguíneo del empleado.
     * @param string $gruposanguineo
     */
    public function setGruposanguineo($gruposanguineo)
    {
        $this->gruposanguineo = $gruposanguineo;
    }

    /**
     * Establece el código del empleado.
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Establece el usuario del empleado.
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Establece la clave del empleado.
     * @param string $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * Establece la foto del empleado.
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * Establece la dirección del empleado.
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Establece el barrio del empleado.
     * @param string $barrio
     */
    public function setBarrio($barrio)
    {
        $this->barrio = $barrio;
    }

    /**
     * Establece el identificador del lugar local del empleado.
     * @param number $loc_lugares_id
     */
    public function setLoc_lugares_id($loc_lugares_id)
    {
        $this->loc_lugares_id = $loc_lugares_id;
    }

    /**
     * Establece el identificador del cargo del empleado.
     * @param number $cargos_id
     */
    public function setCargos_id($cargos_id)
    {
        $this->cargos_id = $cargos_id;
    }

    /**
     * Establece el identificador del título del empleado.
     * @param number $titulos_id
     */
    public function setTitulos_id($titulos_id)
    {
        $this->titulos_id = $titulos_id;
    }

    /**
     * Establece la fecha de creación del empleado.
     * @param string $creado
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;
    }

    /**
     * Establece el identificador del perfil del empleado.
     * @param number $perfil_id
     */
    public function setPerfil_id($perfil_id)
    {
        $this->perfil_id = $perfil_id;
    }

    /**
     * Establece el identificador del estado del empleado.
     * @param number $estado_id
     */
    public function setEstado_id($estado_id)
    {
        $this->estado_id = $estado_id;
    }

    /**
     * Establece la EPS del empleado.
     * @param string $eps
     */
    public function setEps($eps)
    {
        $this->eps = $eps;
    }

    /**
     * Establece la ARS del empleado.
     * @param string $ars
     */
    public function setArs($ars)
    {
        $this->ars = $ars;
    }

    /**
     * Establece el oficio del empleado.
     * @param string $oficio
     */
    public function setOficio($oficio)
    {
        $this->oficio = $oficio;
    }

    /**
     * Establece el salario mensual del empleado.
     * @param number $salariomes
     */
    public function setSalariomes($salariomes)
    {
        $this->salariomes = $salariomes;
    }

    /**
     * Establece la fecha de inicio del contrato del empleado.
     * @param string $contratoini
     */
    public function setContratoini($contratoini)
    {
        $this->contratoini = $contratoini;
    }

    /**
     * Establece la fecha de fin del contrato del empleado.
     * @param string $contratofin
     */
    public function setContratofin($contratofin)
    {
        $this->contratofin = $contratofin;
    }

} 
?>