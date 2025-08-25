<?php
namespace src\sistema\Menubar;
use Seguridad;
use src\sistema\Menubar\MenubarEntity;
use src\sistema\Menubar\MenubarGrupo;

include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'MenubarGrupo.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'MenubarEntity.php';

class Menubar {

    private $menuCollection = array();
    private $breadCrum = array();

    // Dashboard
    const DASHBOARD_PRINCIPAL = 101;
    
    // Entidad
    const ENTIDAD_CONFIG = 201;
    const ENTIDAD_CARGAS = 202;
    const ENTIDAD_FLUJOS = 203;
    const ENTIDAD_REQCFG = 204;
    const ENTIDAD_FORMULARIOS = 205;
    const ENTIDAD_CONTRATISTAS = 206;
    
    // Actividades
    const ACTIVIDADES_MIACTIVIDADES = 301;
    
    // Sistema
    const SISTEMA_USUARIOS = 801;
    const SISTEMA_MIESPACIO = 802;
    const SISTEMA_PREFERENCIAS = 803;
    const SISTEMA_PERFIL = 804;
    const SISTEMA_EMAILCFG = 805;
    const SISTEMA_TPLSEDITOR = 806;

    public function __construct(){
        // constructor
    }
    
    public function menu1(){
        
        $usu = null;
        if ( Seguridad::isLogin() ) {
            $usu = $_SESSION["usu"];
        }
        
        $meG = new MenubarGrupo('dashboard','Dashboard','<i class="nav-icon fe fe-home me-2"></i>');
        
        $m1 = new MenubarEntity();
        $m1->setId( self::DASHBOARD_PRINCIPAL );
        $m1->setNombre('Principal');
        $m1->setSlug( $meG->getCodigo() . '-principal');
        $m1->setGrupo( $meG );
        $m1->setUrl('./index.php?pageid=Workspace.phtml');
        $this->agregar( $m1 );
        
        $meG = new MenubarGrupo('entidad','Entidad','<i class="nav-icon fe fe-book me-2"></i>');
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO || 
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ) 
        {
            
            $m1 = new MenubarEntity();
            $m1->setId( self::ENTIDAD_CONFIG );
            $m1->setNombre('Configuraci&oacute;n');
            $m1->setSlug( $meG->getCodigo() . '-configuracion');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Config.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }

        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::ENTIDAD_CARGAS );
            $m1->setNombre('Carga datos');
            $m1->setSlug( $meG->getCodigo() . '-cargadatos');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Cargadatos.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::ENTIDAD_FLUJOS );
            $m1->setNombre('Flujos');
            $m1->setSlug( $meG->getCodigo() . '-flujos');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Flujos.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::ENTIDAD_REQCFG );
            $m1->setNombre('Requerimientos');
            $m1->setSlug( $meG->getCodigo() . '-requerimientos');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Requerimientos.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::ENTIDAD_FORMULARIOS );
            $m1->setNombre('Formularios');
            $m1->setSlug( $meG->getCodigo() . '-formularios');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Formularios.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        // Todos tienen acceso
        $m1 = new MenubarEntity();
        $m1->setId( self::ENTIDAD_CONTRATISTAS );
        $m1->setNombre('Contratistas');
        $m1->setSlug( $meG->getCodigo() . '-contratistas');
        $m1->setGrupo( $meG );
        $m1->setUrl('./index.php?pageid=modelos/Contratistas.phtml');
        $m1->setVisible(true);
        $this->agregar( $m1 );
        
        $meG = new MenubarGrupo('actividades','Actividades','<i class="nav-icon fe fe-file me-2"></i>');
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISORADMIN )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::ACTIVIDADES_MIACTIVIDADES );
            $m1->setNombre('Mis actividades');
            $m1->setSlug( $meG->getCodigo() . '-misactividades');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Misactividades.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        $meG = new MenubarGrupo('sistema','Sistema','<i class="nav-icon fe fe-settings me-2"></i>');
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISORADMIN )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::SISTEMA_USUARIOS );
            $m1->setNombre('Usuarios');
            $m1->setSlug( $meG->getCodigo() . '-adminusuarios');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Usuarios.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISORADMIN )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::SISTEMA_MIESPACIO );
            $m1->setNombre('Almacenamiento');
            $m1->setSlug( $meG->getCodigo() . '-miespacio');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Miespacio.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }

        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISORADMIN )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::SISTEMA_PREFERENCIAS );
            $m1->setNombre('Preferencias');
            $m1->setSlug( $meG->getCodigo() . '-preferencias');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Preferencias.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }

        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISORADMIN)
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::SISTEMA_PERFIL );
            $m1->setNombre('Perfil');
            $m1->setSlug( $meG->getCodigo() . '-perfil');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Perfil.phtml');
            $m1->setVisible(false);
            $this->agregar( $m1 );
        }
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR )
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::SISTEMA_EMAILCFG );
            $m1->setNombre('SMTP');
            $m1->setSlug( $meG->getCodigo() . '-emailconfig');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Emailconfig.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        
        if ( $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPER_USUARIO ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_ADMINISTRADOR ||
            $usu->getPerfil_id() == \IndexCtrl::PERFILES_SUPERVISORADMIN)
        {
            $m1 = new MenubarEntity();
            $m1->setId( self::SISTEMA_TPLSEDITOR );
            $m1->setNombre('Editor de plantillas');
            $m1->setSlug( $meG->getCodigo() . '-tpleditor');
            $m1->setGrupo( $meG );
            $m1->setUrl('./index.php?pageid=modelos/Templates.phtml');
            $m1->setVisible(true);
            $this->agregar( $m1 );
        }
        

	}

    private function agregar( MenubarEntity $mb ){
        $id = $mb->getGrupo()->getCodigo();
        $this->menuCollection[ $id ]['grp'] = $mb->getGrupo();
        $this->menuCollection[ $id ]['o'][] = $mb ;
    }

    private function listarMenu( $pageid, $d = array() ){
        $col = $this->menuCollection;
        $html = array();

        $primero = true;
        
        $navitemTop = "";
        if ( isset( $d['navitemTop'] ) ) {
            $navitemTop = $d['navitemTop'];
        }

        foreach ( $col as $k => $v ) {
            $grp = $v['grp'];
            $o = $v['o'];

            $mostrar = "";
            $activo = "";

            $htmlitem = array();
            // Primero creamos los items para saber si seleccionaron alguno
            foreach ( $o as $vM ) {
                if ( is_null( $pageid ) ) {
                    if ( $primero ) {
                        $mostrar = 'show';
                        $activo = 'active';
                    }
                }else{
                    if ( trim(strtolower( $pageid )) == trim(strtolower($vM->getUrlPageId())) ) {
                        $mostrar = 'show';
                        $activo = 'active';
                        $this->breadCrum['id'] = $vM->getId() ;
                        $this->breadCrum['l2'] = $vM->getNombre();
                        $this->breadCrum['l1'] = $grp->getNombre();
                    }
                }

                if ($vM->getVisible()) {
                    $htmlitem[] = '             <li class="nav-item "> ';
                    $htmlitem[] = '                 <a id="' . $vM->getId() . '" data-name="' . $vM->getSlug() . '" class="nav-link ' . $activo . '" href="' . $vM->getUrl() . '">' . $vM->getIcono() . " " . $vM->getNombre() . '</a> ';
                    $htmlitem[] = '             </li> ';
                }

                $primero = false;
                $activo = "";
            }

            $html[] = '<li class="nav-item"> ';
            $html[] = ' <a class="nav-link " href="#" data-bs-toggle="collapse" data-bs-target="#' . $k . '" aria-expanded="false" aria-controls="' . $k . '" style="' . $navitemTop . '">';
            $html[] = trim( '         ' . $grp->getIcono() . ' ' . $grp->getNombre() );
            $html[] = ' </a> ';
            $html[] = ' <div id="'. $k .'" class="collapse ' . $mostrar . '" data-bs-parent="#sideNavbar"> ';
            $html[] = '     <ul class="nav flex-column"> ';

            $html[] = implode('',$htmlitem);

            $html[] = '     </ul > ';
            $html[] = ' </div > ';
            $html[] = '</li> ';
        }

        return implode("\n",$html);
    }

    /**
     * Get the value of breadCrum
     */ 
    public function getBreadCrum()
    {
        return $this->breadCrum;
    }

    /**
     * Set the value of breadCrum
     *
     * @return  self
     */ 
    public function setBreadCrum($breadCrum)
    {
        $this->breadCrum = $breadCrum;

        return $this;
    }

    public static function DibujarMenu( ){
        $m = new Menubar( );
        $m->menu1( );

        $pageid = null;
        if ( isset( $_REQUEST['pageid'] ) ) {
            $pageid = $_REQUEST['pageid'];
        }

?>
<nav class="navbar-vertical navbar navbar-dark bg-dark">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="./index.php">
            <img src="./temas/img/Acappdemy_r_text_logo.png" alt="" height="64">
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <?php echo $m->listarMenu( $pageid ); ?>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Documentation</div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="../../docs/index.html">
                    <i class="nav-icon fe fe-clipboard me-2"></i> Documentation
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="../../docs/changelog.html">
                    <i class="nav-icon fe fe-git-pull-request me-2"></i> Changelog
                    <span class="badge bg-primary ms-2">1.0.0</span>
                </a>
            </li>
        </ul>

        <!-- Card -->
        <div class="card bg-dark-primary shadow-none text-center mx-4 my-8">
            <div class="card-body py-2">
                <img src="./temas/favicon/favicon_120x120.png" alt="" height="92" />
                <div class="mt-0">
                    <h5 class="text-white">Nuevapp</h5>
                    <small class="d-block mb-3 text-muted">&copy; 2025</small>
                </div>
            </div>
        </div>

    </div>
</nav>
        <?php

        return $m->getBreadCrum();
    }
    
    // Home
    const HOME_DASHBOARD_PRINCIPAL = 101;
    
    // Tareas
    const HOME_ACTVITIES_DOCUMENTOS = 201;
    
    // Sistema
    const HOME_SISTEMA_PERFIL = 301;
    const HOME_SISTEMA_PREFERENCIAS = 302;
    const HOME_SISTEMA_COMUNICACIONESALL = 303;
    
    public function menu2(){
        
        $meG = new MenubarGrupo('dashboard','Dashboard','<i class="nav-icon fe fe-home me-2"></i>');
        
        $m1 = new MenubarEntity();
        $m1->setId( self::HOME_DASHBOARD_PRINCIPAL );
        $m1->setNombre('Principal');
        $m1->setSlug( $meG->getCodigo() . '-home-main');
        $m1->setGrupo( $meG );
        $m1->setUrl('home.php?pageid=home/Main.phtml');
        $this->agregar( $m1 );
        
        $meG = new MenubarGrupo('dependientes','Actividades','<i class="nav-icon fe fe-users me-2"></i>');
        
        $m1 = new MenubarEntity();
        $m1->setId( self::HOME_ACTVITIES_DOCUMENTOS );
        $m1->setNombre('Solicitudes');
        $m1->setSlug( $meG->getCodigo() . '-home-documentos');
        $m1->setGrupo( $meG );
        $m1->setUrl('home.php?pageid=home/vwhome/Documentos.phtml');
        $this->agregar( $m1 );
        
        $meG = new MenubarGrupo('sistema','Sistema','<i class="nav-icon fe fe-layers me-2"></i>');
        
        $m1 = new MenubarEntity();
        $m1->setId( self::HOME_SISTEMA_PERFIL );
        $m1->setNombre('Perfil');
        $m1->setSlug( $meG->getCodigo() . '-home-perfil');
        $m1->setGrupo( $meG );
        $m1->setUrl('home.php?pageid=home/vwhome/Perfil.phtml');
        $this->agregar( $m1 );
        
    }
    
    public static function DibujarMenuHome( ){
        $m = new Menubar( );
        $m->menu2( );
        
        $pageid = null;
        if ( isset( $_REQUEST['pageid'] ) ) {
            $pageid = $_REQUEST['pageid'];
        }
        
        ?>
<nav class="navbar-vertical navbar navbar-dark bg-dark" style="background-color: #cc5b0a !important;">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="home.php?pageid=home/Main.phtml">
            <img src="./temas/img/Acappdemy_r_text_logo.png" alt="" height="64">
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <?php echo $m->listarMenu( $pageid, array('navitemTop' => 'color: #e1bb9e;') ); ?>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider" style="border: 0;border-top: 1px solid rgb(211 113 54);margin-bottom: 1rem;margin-top: 1rem;"></div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading" style="color: #ffb471;">Documentation</div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="../../docs/index.html" style="color: #c29a7d;">
                    <i class="nav-icon fe fe-clipboard me-2"></i> Documentation
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="../../docs/changelog.html" style="color: #c29a7d;">
                    <i class="nav-icon fe fe-git-pull-request me-2"></i> Changelog
                    <span class="badge ms-2" style="background-color: rgba(253,253,253,0.13) !important;" >1.0.0</span>
                </a>
            </li>
        </ul>

        <!-- Card -->
        <div class="card bg-dark-primary shadow-none text-center mx-4 my-8" style="background-color: rgba(253,253,253,0.13) !important;" >
            <div class="card-body py-2">
                <img src="./temas/favicon/favicon_120x120.png" alt="" height="92" />
                <div class="mt-0">
                    <h5 class="text-white">Nuevapp</h5>
                    <small class="d-block mb-3 " style="color: #c8b4a5;">&copy; 2025</small>
                </div>
            </div>
        </div>

    </div>
</nav>
        <?php

        return $m->getBreadCrum();
    }

}

?>