<?php
namespace src\sistema\Headerbar;

class Headerbar{

    /**
     * Dibuja el header (barra superior) de la aplicación.
     *
     * Obtiene información de la institución, logo y datos del usuario (desde sesión),
     * determina el avatar si existe en el repositorio y renderiza el HTML del
     * header con notificaciones y menú de usuario. No recibe parámetros y escribe
     * la salida directamente.
     *
     * @return void
     */
    public static function DibujarHeader( ){

        $inst = \OperacionesCtrl::institucion_Obtener();
        $instD = array();
        if ( sizeof( $inst ) > 0 ) {
            $instD = $inst[0];
        }
        
        $logoinst = \OperacionesCtrl::obtener_LogoCompany();
        
        $usu = null;
        if ( \Seguridad::isLogin() ) {
            $usu = $_SESSION["usu"];
        }
        $avatar = null;

        if ( strlen( trim($usu->getFoto()) ) > 0) {
            $avatar_path = dirname(dirname(dirname(dirname(__FILE__))));
            $avatartmp = $avatar_path . DIRECTORY_SEPARATOR . \Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR . $usu->getFoto();

            if ( file_exists( $avatartmp ) ) {
                $avatar = $usu->getFoto();
            }
        }

    ?>
<div class="header">
    <!-- navbar -->
    <nav class="navbar-default navbar navbar-expand-lg">
        <a id="nav-toggle" href="#">
            <i class="fa-solid fa-bars"></i>
        </a>
        <div class="ms-lg-3 d-none d-md-none d-lg-block">
        	<div class="d-flex align-items-center">
            	<img class="d-block mx-auto mb-0" src="<?php echo $logoinst; ?>?cch=<?php echo date('YmdHis') ?>" alt="" height="24" style="object-fit: cover;">
            	<?php if ( isset( $instD['nombre'] ) ) : ?>
            	<label class="ps-1">
                    <?php echo $instD['nombre']; ?>
                </label>
                <?php endif; ?>
            </div>

            <?php
            /*
            <!-- Form -->
            <form class="d-flex align-items-center">
                <span class="position-absolute ps-3 search-icon">
                        <i class="fe fe-search"></i>
                    </span>
                <input type="search" class="form-control form-control-sm ps-6" placeholder="Search Entire Dashboard">
            </form>
            */
            ?>
        </div>
        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <li class="dropdown stopevent">
            	<!-- 
                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 -->
                <a class="btn btn-light btn-icon rounded-circle text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownNotification">
                    <div>
                        <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                            <span class="h4 mb-0">Notificaciones</span>
                            <a href="# " class="text-muted">
                                <span class="align-middle">
                                        <i class="fe fe-settings me-1"></i>
                                    </span>
                            </a>
                        </div>
                        <!-- List group -->
                        <ul class="list-group list-group-flush" data-simplebar="init" style="max-height: 300px;">
                        	<div class="simplebar-wrapper" style="margin: 0px;">
                        		<div class="simplebar-height-auto-observer-wrapper">
                        			<div class="simplebar-height-auto-observer">
                        			</div>
                    			</div>
                    			<div class="simplebar-mask">
                    				<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    					<div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                    						<div id="msjssecs" class="simplebar-content" style="padding: 0px;">
                                                <!-- 
                                                <li class="list-group-item bg-light">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a class="text-body" href="#">
                                                            <div class="d-flex">
                                                                <img src="../../assets/images/avatar/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
                                                                <div class="ms-3">
                                                                    <h5 class="fw-bold mb-1">Kristin Watson:</h5>
                                                                    <p class="mb-3">
                                                                        Krisitn Watsan like your comment on course
                                                                        Javascript Introduction!
                                                                    </p>
                                                                    <span class="fs-6 text-muted">
                                                                        <span><span class="fe fe-thumbs-up text-success me-1"></span>2 hours ago,</span>
                                                                        <span class="ms-1">2:19 PM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-auto text-center me-2">
                                                            <a href="#" class="badge-dot bg-info" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mark as read">
                                                            </a>
                                                            <div>
                                                                <a href="#" class="bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Remove">
                                                                    <i class="fe fe-x text-muted"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                 -->
                        					</div>
                    					</div>
                					</div>
            					</div>
        						<div class="simplebar-placeholder" style="width: auto; height: 583px;">
        						</div>
    						</div>
    						<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
    							<div class="simplebar-scrollbar" style="width: 0px; display: none;">
								</div>
							</div>
							<div class="simplebar-track simplebar-vertical" style="visibility: visible;">
								<div class="simplebar-scrollbar" style="height: 154px; transform: translate3d(0px, 0px, 0px); display: block;">
								</div>
							</div>
						</ul>
                        <div class="border-top px-3 pt-3 pb-0">
                            <a href="../../pages/notification-history.html" class="text-link fw-semi-bold">Ver todas las notifcaciones</a>
                        </div>
                    </div>
                </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <?php if( !is_null( $avatar ) ) : ?>
                        <img alt="avatar" src="./repo/avatar/<?php echo $avatar; ?>" class="rounded-circle" style="object-fit: cover;">
                        <?php else: ?>
                        <img alt="avatar" src="./temas/img/logo_no_institu_v2.png" class="rounded-circle" style="object-fit: cover;">
                        <?php endif; ?>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <div class="dropdown-item">
                        <div class="d-flex">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                <?php if( !is_null( $avatar ) ) : ?>
                                <img alt="avatar" src="./repo/avatar/<?php echo $avatar; ?>" class="rounded-circle" style="object-fit: cover;">
                                <?php else: ?>
                                <img alt="avatar" src="./temas/img/logo_no_institu_v2.png" class="rounded-circle" style="object-fit: cover;">
                                <?php endif; ?>
                            </div>
                            <div class="ms-3 lh-1">
                                <h5 class="mb-1"><?php echo $usu->getNombres() . ' ' . $usu->getApellidos(); ?></h5>
                                <p class="mb-0 text-muted"><?php echo $usu->getMail(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                        <li class="dropdown-submenu dropstart-lg">
                            <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                              <i class="fe fe-circle me-2"></i> Status
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <span class="badge-dot bg-success me-2"></span> Online
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <span class="badge-dot bg-secondary me-2"></span> Offline
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <span class="badge-dot bg-warning me-2"></span> Away
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <span class="badge-dot bg-danger me-2"></span> Busy
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-item" href="./index.php?pageid=modelos/Perfil.phtml">
                              <i class="fe fe-user me-2"></i> Perfil
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                        <li>
                            <a onclick="cerrarSesion();" class="dropdown-item" href="#">
                              <i class="fe fe-power me-2"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>
    <?php

    }
    
    /**
     * Dibuja la barra de encabezado de la página principal.
     *
     * Método estático que renderiza el HTML/CSS necesario para el header del home.
     *
     * @return void
     */
    public static function DibujarHeaderHome(){
        $inst = \OperacionesCtrl::institucion_Obtener();
        $instD = array();
        if ( sizeof( $inst ) > 0 ) {
            $instD = $inst[0];
        }
        
        $logoinst = \OperacionesCtrl::obtener_LogoCompany();
        ?>
<div class="header">
    <!-- navbar -->
    <nav class="navbar-default navbar navbar-expand-lg">
        <a id="nav-toggle" href="#">
            <i class="fa-solid fa-bars"></i>
        </a>
        <div class="ms-lg-3 d-none d-md-none d-lg-block">
        	<div class="d-flex align-items-center">
            	<img class="d-block mx-auto mb-0" src="<?php echo $logoinst; ?>?cch=<?php echo date('YmdHis') ?>" alt="" height="24" style="object-fit: cover;">
            	<?php if ( isset( $instD['nombre'] ) ) : ?>
            	<label class="ps-1">
                    <?php echo $instD['nombre'] ; ?>
                </label>
                <?php endif; ?>
            </div>
        </div>
        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <li class="dropdown stopevent">
                <a class="btn btn-light btn-icon rounded-circle text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownNotification">
                    <div>
                        <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                            <span class="h4 mb-0">Notificaciones</span>
                        	<a href="# " class="text-muted">
                            	<span class="align-middle">
                                    <i class="fe fe-settings me-1"></i>
                                </span>
                        	</a>
                        </div>
                        
                        <!-- List group -->
						<ul class="list-group list-group-flush" data-simplebar="init" style="max-height: 300px;">
                        	<div class="simplebar-wrapper" style="margin: 0px;">
                        		<div class="simplebar-height-auto-observer-wrapper">
                        			<div class="simplebar-height-auto-observer">
                        			</div>
                    			</div>
                				<div class="simplebar-mask">
            						<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
            							<div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
            								<div id="msjssecs" class="simplebar-content" style="padding: 0px;">
            								</div>
                        				</div>
                    				</div>
                				</div>
                			
                    			<div class="simplebar-placeholder" style="width: auto; height: 583px;">
                    			</div>
                			</div>
                			
                			<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                				<div class="simplebar-scrollbar" style="width: 0px; display: none;">
                				</div>
            				</div>
            				
            				<div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            					<div class="simplebar-scrollbar" style="height: 154px; transform: translate3d(0px, 0px, 0px); display: block;">
            					</div>
        					</div>
						</ul>
                        <div class="border-top px-3 pt-3 pb-0">
                            <a href="home.php?pageid=home/vwhome/Notificationhistory.phtml" class="text-link fw-semi-bold">
                                    Ver todas las notifcaciones
                                </a>
                        </div>
                    </div>
                </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="./temas/img/logo_no_institu_v2.png" class="rounded-circle" style="object-fit: cover;">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <div class="dropdown-item">
                        <div class="d-flex">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                <img alt="avatar" src="./temas/img/logo_no_institu_v2.png" class="rounded-circle" style="object-fit: cover;">
                            </div>
                            <div class="ms-3 lh-1">
                                <h5 class="mb-1" id="GBL_MAIN_FULLNAME">${NOMBRES APELLIDOS}</h5>
                                <p class="mb-0 text-muted" id="GBL_MAIN_EMAIL" >${EMAIL}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                        <li>
                            <a onclick="home.navLogout();" class="dropdown-item" href="#">
                              <i class="fe fe-power me-2"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>
    <?php
    }

}
?>