<?php
/**
 *
 * @author yalfonso
 *
*/

class Usuarios extends Clsdatos {
	private $id = 0;
	private $tipodoc_id = 1;
	private $documento = '';
	private $lugarescedula_id = 1;
	private $nombres = '';
	private $apellidos = '';
	private $mail = '';
	private $nacimiento = '1900-01-01';
	private $generos_id = 1;
	private $lugares_id = 1;
	private $gruposanguineo = '';
	private $codigo = '';
	private $usuario = '';
	private $clave = '';
	private $foto = '';
	private $direccion = '';
	private $barrio = '';
	private $loc_lugares_id = 1;
	private $cargos_id = 1;
	private $titulos_id = 1;
	private $creado = '1900-01-01';
	private $perfil_id = 1;
	private $estado_id = 1;
	
	private $eps = "";
	private $ars = "";
	
	private $oficio = "";
	private $salariomes = 0;
	private $contratoini = "1900-01-01 00:00:00";
	private $contratofin = "1900-01-01 00:00:00";
	
    /**
     * Obtiene el identificador del usuario.
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
     * Obtiene el número de documento del usuario.
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
     * Obtiene los nombres del usuario.
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Obtiene los apellidos del usuario.
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Obtiene el correo electrónico del usuario.
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Obtiene la fecha de nacimiento del usuario.
     * @return string
     */
    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    /**
     * Obtiene el identificador del género del usuario.
     * @return number
     */
    public function getGeneros_id()
    {
        return $this->generos_id;
    }

    /**
     * Obtiene el identificador del lugar del usuario.
     * @return number
     */
    public function getLugares_id()
    {
        return $this->lugares_id;
    }

    /**
     * Obtiene el grupo sanguíneo del usuario.
     * @return string
     */
    public function getGruposanguineo()
    {
        return $this->gruposanguineo;
    }

    /**
     * Obtiene el código del usuario.
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Obtiene el nombre de usuario.
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Obtiene la clave del usuario.
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Obtiene la foto del usuario.
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Obtiene la dirección del usuario.
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Obtiene el barrio del usuario.
     * @return string
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Obtiene el identificador del lugar local del usuario.
     * @return number
     */
    public function getLoc_lugares_id()
    {
        return $this->loc_lugares_id;
    }

    /**
     * Obtiene el identificador del cargo del usuario.
     * @return number
     */
    public function getCargos_id()
    {
        return $this->cargos_id;
    }

    /**
     * Obtiene el identificador del título del usuario.
     * @return number
     */
    public function getTitulos_id()
    {
        return $this->titulos_id;
    }

    /**
     * Obtiene la fecha de creación del usuario.
     * @return string
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Obtiene el identificador del perfil del usuario.
     * @return number
     */
    public function getPerfil_id()
    {
        return $this->perfil_id;
    }

    /**
     * Obtiene el identificador del estado del usuario.
     * @return number
     */
    public function getEstado_id()
    {
        return $this->estado_id;
    }

    /**
     * Obtiene la EPS del usuario.
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Obtiene la ARS del usuario.
     * @return string
     */
    public function getArs()
    {
        return $this->ars;
    }

    /**
     * Obtiene el oficio del usuario.
     * @return string
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * Obtiene el salario mensual del usuario.
     * @return number
     */
    public function getSalariomes()
    {
        return $this->salariomes;
    }

    /**
     * Obtiene la fecha de inicio del contrato del usuario.
     * @return string
     */
    public function getContratoini()
    {
        return $this->contratoini;
    }

    /**
     * Obtiene la fecha de fin del contrato del usuario.
     * @return string
     */
    public function getContratofin()
    {
        return $this->contratofin;
    }

    /**
     * Establece el identificador del usuario.
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
     * Establece el identificador del lugar de cédula.
     * @param number $lugarescedula_id
     */
    public function setLugarescedula_id($lugarescedula_id)
    {
        $this->lugarescedula_id = $lugarescedula_id;
    }

    /**
     * Establece los nombres del usuario.
     * @param string $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * Establece los apellidos del usuario.
     * @param string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * Establece el correo electrónico del usuario.
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Establece la fecha de nacimiento del usuario.
     * @param string $nacimiento
     */
    public function setNacimiento($nacimiento)
    {
        $this->nacimiento = $nacimiento;
    }

    /**
     * Establece el identificador del género del usuario.
     * @param number $generos_id
     */
    public function setGeneros_id($generos_id)
    {
        $this->generos_id = $generos_id;
    }

    /**
     * Establece el identificador del lugar del usuario.
     * @param number $lugares_id
     */
    public function setLugares_id($lugares_id)
    {
        $this->lugares_id = $lugares_id;
    }

    /**
     * Establece el grupo sanguíneo del usuario.
     * @param string $gruposanguineo
     */
    public function setGruposanguineo($gruposanguineo)
    {
        $this->gruposanguineo = $gruposanguineo;
    }

    /**
     * Establece el código del usuario.
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Establece el nombre de usuario.
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Establece la clave del usuario.
     * @param string $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * Establece la foto del usuario.
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * Establece la dirección del usuario.
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Establece el barrio del usuario.
     * @param string $barrio
     */
    public function setBarrio($barrio)
    {
        $this->barrio = $barrio;
    }

    /**
     * Establece el identificador del lugar local del usuario.
     * @param number $loc_lugares_id
     */
    public function setLoc_lugares_id($loc_lugares_id)
    {
        $this->loc_lugares_id = $loc_lugares_id;
    }

    /**
     * Establece el identificador del cargo del usuario.
     * @param number $cargos_id
     */
    public function setCargos_id($cargos_id)
    {
        $this->cargos_id = $cargos_id;
    }

    /**
     * Establece el identificador del título del usuario.
     * @param number $titulos_id
     */
    public function setTitulos_id($titulos_id)
    {
        $this->titulos_id = $titulos_id;
    }

    /**
     * Establece la fecha de creación del usuario.
     * @param string $creado
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;
    }

    /**
     * Establece el identificador del perfil del usuario.
     * @param number $perfil_id
     */
    public function setPerfil_id($perfil_id)
    {
        $this->perfil_id = $perfil_id;
    }

    /**
     * Establece el identificador del estado del usuario.
     * @param number $estado_id
     */
    public function setEstado_id($estado_id)
    {
        $this->estado_id = $estado_id;
    }

    /**
     * Establece la EPS del usuario.
     * @param string $eps
     */
    public function setEps($eps)
    {
        $this->eps = $eps;
    }

    /**
     * Establece la ARS del usuario.
     * @param string $ars
     */
    public function setArs($ars)
    {
        $this->ars = $ars;
    }

    /**
     * Establece el oficio del usuario.
     * @param string $oficio
     */
    public function setOficio($oficio)
    {
        $this->oficio = $oficio;
    }

    /**
     * Establece el salario mensual del usuario.
     * @param number $salariomes
     */
    public function setSalariomes($salariomes)
    {
        $this->salariomes = $salariomes;
    }

    /**
     * Establece la fecha de inicio del contrato del usuario.
     * @param string $contratoini
     */
    public function setContratoini($contratoini)
    {
        $this->contratoini = $contratoini;
    }

    /**
     * Establece la fecha de fin del contrato del usuario.
     * @param string $contratofin
     */
    public function setContratofin($contratofin)
    {
        $this->contratofin = $contratofin;
    }
	
}

?>