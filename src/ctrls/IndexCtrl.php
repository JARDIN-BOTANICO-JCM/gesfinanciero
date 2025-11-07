<?php
class IndexCtrl extends Pagina {
    const CHARS_TO = 'utf-8';   // Codificacion a convertir
    const CHARS_FR = 'utf-8';      // Codificacion fuente
    
    // Config Uploadfiles
    const CONFIG_UPLOAD_DEF = 10;
    
    const GENERAL_CAMPOS_VISIBLE = 0;
    const GENERAL_CAMPOS_OCULTO = 1;
    const GENERAL_CAMPOS_INACTIVO = 2;
    
    const PERFILES_SUPER_USUARIO = 1;
    const PERFILES_ADMINISTRADOR = 2;
    const PERFILES_SUPERVISOR = 3;
    const PERFILES_CONTRATISTA = 4;
    const PERFILES_ACUDIENTE = 5;
    const PERFILES_FINANCIERO = 6;
    const PERFILES_SUPERVISORADMIN = 7;
    const PERFILES_PROVEEDOR = 8;
    const PERFILES_RUTA = 9;
    
    // IDs Usabilidad
    const WEB_USR_LGN_OK = 'WEB_USR_LGN_OK';
    const WEB_USR_TRK_VW = 'WEB_USR_TRK_VW';
    const WEB_LGN_VISITA_APP = 'WEB_LGN_VISITA_APP';
    const WEB_USR_ACU_LGN_OK = 'WEB_USR_ACU_LGN_OK';
    const WEB_USR_CARGA_ARCHIVOS = 'WEB_USR_CARGA_ARCHIVOS';
    // Mensajes Usabilidad
    const USABILIDAD_MSJ_LOGINOK = 'ingreso login correcto';
    
    // Codigos de error
    const ERR_COD_SIN_PRIVILEGIOS = 520; // No tiene permisos suficientes
    const ERR_COD_USUARIO_NO_EXISTE_BY_ID = 521; // El id del usuario no existe
    const ERR_COD_ENVIO_MAIL_FALLIDO = 522; // Error enviando el correo
    const ERR_COD_CAMBIO_CLAVE_FALLIDO = 523; // Error al cambiar clave
    const ERR_COD_CAMPO_OBLIGATORIO = 524; // Falta campo obligatorio
    const ERR_COD_COMUNICACIONES_SIN_DESTINATARIO = 525; // No agrego destinatarios al mensaje
    const ERR_COD_COMUNICACIONES_AGREGANDO = 526; // No agrego destinatarios al mensaje
    const ERR_COD_COMUNICACIONES_OBTENER_LISTA_POR_ENVIAR = 527; // No agrego destinatarios al mensaje
    const ERR_COD_AGENDA_AGREGAR = 528; // No agrego destinatarios al mensaje
    const ERR_COD_SESION_INACTIVA = 529; // Sesion cerrada por inactividad
    const ERR_COD_MSJ_ERR_COMUN = 530; // Errores comunes al insertar
    const ERR_COD_EST_CLAVE_NO_MODIFICADA = 531; // La clave del Empleado no fue modificada
    const ERR_COD_CORREO_FAIL = 532; // No fue posible enviar el correo
    const ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS = 533; // El usuario existe pero sin datos
    const ERR_COD_ACUDIENTE_HIJOS_ACTIVOS = 534; // Acudiente sin hijos activos
    const ERR_COD_USUARIO_O_CLAVE_INVALIDA = 535; // Usuario o clave invalida
    const ERR_COD_PLANTILLA_NO_SALVADA = 536; // Plantilla no guardada
    const ERR_COD_REGISTRO_EXISTENTE = 537; // Registro existente con los mismos datos
    const ERR_COD_ACTUALIZACION_SQL = 538; // Error actualizando datos en sentencia SQL
    const ERR_COD_ELIMINACION_SQL = 538; // Error eliminando datos en sentencia SQL
    const ERR_COD_RESPUESTA_SQL_VACIA = 539; // Respuesta vacia
    
	const SIN_PRIVILEGIOS = "No tiene los permisos suficientes para crear usuarios.";
	const USUARIO_NO_AUTENTICADO = "Para esta operaci&oacute;n es obligatorio estar autenticado.";

	const TIEMPO_AJAX_LDN = "1000";


	const API_LNK_DESCARGAR_ALUMNOS = 'API_LNK_DESCARGAR_ALUMNOS';
	const API_LNK_DESCARGAR_PDF = 'API_LNK_DESCARGAR_PDF';
	const API_LNK_VISTA_PDF_PROC = 'API_LNK_VISTA_PDF_PROC';
	const API_LNK_DESCARGAR_CERTIFICADOS = 'API_LNK_DESCARGAR_CERTIFICADOS';
	const API_SESSION_ACTIVA = 'API_SESSION_ACTIVA';
	const API_AgregarConfigCorp = 'API_AgregarConfigCorp';
	const API_IniciarLoginAsOtro = 'API_IniciarLoginAsOtro';
	const API_LoginSystemAjax = 'API_LoginSystemAjax';


	// Listas principales INI
	const API_ObtenerLugares = 'API_ObtenerLugares';
	const API_ObtenerTutores = 'API_ObtenerTutores';
	// Listas principales FIN

	// Sistema General INI
	const API_TamanoUsoGet = 'API_TamanoUsoGet';
	const API_RecuperarSisClave = 'API_RecuperarSisClave';
	// Sistema General FIN

	// Institucion INI
	const API_InstitucionAdd = 'API_InstitucionAdd';
	const API_InstitucionLogo = 'API_InstitucionLogo';
	// Institucion FIN

	// Empleados INI 
	const API_EmpleadosAdd = 'API_EmpleadosAdd';
	const API_EmpleadosMod = 'API_EmpleadosMod';
	const API_EmpleadosRm = 'API_EmpleadosRm';
	const API_EmpleadosActivar = 'API_EmpleadosActivar';
	const API_EmpleadosHelperGet = 'API_EmpleadosHelperGet';
	const API_EmpleadosGet = 'API_EmpleadosGet';
	const API_EmpleadosHomeHelperGet = 'API_EmpleadosHomeHelperGet';
	const API_EmpleadosGetAjax = 'API_EmpleadosGetAjax';
	const API_EmpleadosHelperAdd = 'API_EmpleadosHelperAdd';
	const API_EmpleadosHelperOffAuthAdd = 'API_EmpleadosHelperOffAuthAdd';
	const API_EmpleadosGetAnexos = 'API_EmpleadosGetAnexos';
	const API_EmpleadosClaveAsignadaAdminManual = 'API_EmpleadosClaveAsignadaAdminManual';
	const API_EmpleadosClaveAsignadaAdmin = 'API_EmpleadosClaveAsignadaAdmin';
	// Empleados FIN

	// Usuarios INI
	const API_UsuariosAdd = 'API_UsuariosAdd';
	const API_UsuariosHelperMod = 'API_UsuariosHelperMod';
	const API_UsuariosMod = 'API_UsuariosMod';
	const API_UsuariosRm = 'API_UsuariosRm';
	const API_UsuariosHelperGet = 'API_UsuariosHelperGet';
	const API_UsuariosGet = 'API_UsuariosGet';
	const API_UsuariosGetAjax = 'API_UsuariosGetAjax';
	const API_AdminHelperAdd = 'API_AdminHelperAdd';
	const API_UsuariosMiniAdd = 'API_UsuariosMiniAdd';
	const API_UsuariosClaveAsignadaAdmin = 'API_UsuariosClaveAsignadaAdmin';
	const API_UsuariosClaveAsignadaAdminManual = 'API_UsuariosClaveAsignadaAdminManual';

	// Cargadatos.phtml INI
	const API_Cargadatos_Upload = 'API_Cargadatos_Upload';
	const API_Bogdata_Consultar = 'API_Bogdata_Consultar';
	// Cargadatos.phtml FIN

	// Usuarios FIN

	// Codigoactiva INI
	const API_CodigoactivaGet = 'API_CodigoactivaGet';
	const API_CodigoactivaAdd = 'API_CodigoactivaAdd';
	const API_CodigoactivaJson64Add = 'API_CodigoactivaJson64Add';
	// Codigoactiva FIN

	// Contrasena INI
	const API_Contrasena = 'API_Contrasena';
	// Contrasena FIN

	// Anyolectivo INI
	const API_AnyolectivoAdd = 'API_AnyolectivoAdd';
	// Anyolectivo FIN

	// Fotos de perfil INI
	const API_UpFotoPerfiles = 'API_UpFotoPerfiles';
	// Fotos de perfil FIN

	// Plantillas INI
	const API_plantillasAdd = 'API_plantillasAdd';
	const API_plantillasNew = 'API_plantillasNew';
	const API_plantillasDel = 'API_plantillasDel';
	const API_plantillasMixAdd = 'API_plantillasMixAdd';
	const API_plantillasMixGet = 'API_plantillasMixGet';
	const API_plantillasMixSend = 'API_plantillasMixSend';
	const API_plantillasMixVariablesHelperGet = 'API_plantillasMixVariablesHelperGet';
	// Plantillas FIN

	// Firmas INI
	const API_FirmasGet = 'API_FirmasGet';
	const API_FirmasPreviaGet = 'API_FirmasPreviaGet';
	const API_FirmasAgregarConfigCorp_Add = 'API_FirmasAgregarConfigCorp_Add';
	const API_FirmasAgregarConfigCorp_Get = 'API_FirmasAgregarConfigCorp_Get';
	
	const API_FirmasproHelperAdd = 'API_FirmasproHelperAdd';
	const API_FirmasproAdminP12Add = 'API_FirmasproAdminP12Add';
	// Firmas FIN
	
	// Firmaslog INI
	const API_FirmaslogHelperEvent = 'API_FirmaslogHelperEvent';
	// Firmaslog FIN
	
	// ApiBox INI
	const API_ApiboxGet = 'API_ApiboxGet';
	// ApiBox FIN
	
	// Deducciones INI
	const API_DeduccionesHelperAdd = 'API_DeduccionesHelperAdd';
	// Deducciones FIN
	
	// Deducciones Virtual INI
	const API_DeduccionesVirtualAdd = 'API_DeduccionesVirtualAdd';
	const API_DeduccionesVirtualGet = 'API_DeduccionesVirtualGet';
	const API_DeduccionesVirtualGetAjax = 'API_DeduccionesVirtualGetAjax';
	const API_DeduccionesVirtualDel = 'API_DeduccionesVirtualDel';
	// Deducciones Virtual FIN

	// requerimientos INI
	const API_RequerimientostplsGetAjax = 'API_RequerimientostplsGetAjax';
	const API_RequerimientosHelperAdd = 'API_RequerimientosHelperAdd';
	// requerimientos FIN

	// requerimientostplsitems INI
	const API_RequerimientostplsitemsHelperGet = 'API_RequerimientostplsitemsHelperGet';
	// requerimientostplsitems FIN

	// Flujos INI
	const API_FlujosHelperAdd = 'API_FlujosHelperAdd';
	const API_FlujosHelperEstadoMod = 'API_FlujosHelperEstadoMod';
	const API_FlujosGetAjax = 'API_FlujosGetAjax';
	// Flujos FIN

	// Flujositems INI
	const API_FlujositemsPrincipalHelperGet = 'API_FlujositemsPrincipalHelperGet';
	const API_FlujositemsGet = 'API_FlujositemsGet';
	const API_FlujositemsHelperGet = 'API_FlujositemsHelperGet';
	const API_FlujositemsHelperDel = 'API_FlujositemsHelperDel';
	
	const API_FlujositemsRevDtGet = 'API_FlujositemsRevDtGet';
	// Flujositems FIN

	// Paquetes INI
	const API_PaquetesGetAjax = 'API_PaquetesGetAjax';
	const API_PaquetesHelperGetAjax = 'API_PaquetesHelperGetAjax';
	const API_PaquetesHelperMoveReview = 'API_PaquetesHelperMoveReview';
	const API_PaquetesHelperMoveAdmin = 'API_PaquetesHelperMoveAdmin';
	// Paquetes FIN

	// Paquetesrequ INI
	const API_PaquetesrequHelperAdd = 'API_PaquetesrequHelperAdd';
	// Paquetesrequ FIN
	
	// Paquetesreqcomentarios INI
	const API_PaquetesreqcomentariosHelperGet = 'API_PaquetesreqcomentariosHelperGet';
	const API_PaquetesreqcomentariosHelperAdd = 'API_PaquetesreqcomentariosHelperAdd';
	const API_PaquetesreqcomentariosHelperDel = 'API_PaquetesreqcomentariosHelperDel';
	// Paquetesreqcomentarios FIN
	
	// Apoyos INI
	/*
	 * @yalfonso
	 * TODO: Tarea 67 - Agregar constantes para enrutar procedimientos front - back para la Apoyo supervisor
	 */
	const API_ApoyosGet = 'API_ApoyosGet';
	const API_ApooyosHelperAdd = 'API_ApooyosHelperAdd';
	const API_ApoyosDel = 'API_ApoyosDel';
	// Apoyos FIN

	// Reflista INI
	const API_ReflistaGet = 'API_ReflistaGet';
	// Reflista FIN

	// Formularios INI
	const API_FormulariosGetAjax = 'API_FormulariosGetAjax';
	const API_FormulariosHelperDel = 'API_FormulariosHelperDel';
	const API_FormulariosHelperAdd = 'API_FormulariosHelperAdd';
	const API_FormulariosGet = 'API_FormulariosGet';
	// Formularios FIN

	// empleadosdetallescontrato INI
	/*
	 * @vnavarro
	 * TODO: tarea 5
	 * Debemos declarar la constante que enruta a la funcion que crearemos en el controlador principal
	 * 1. el nombre de esta constante debe ser API_empleadosdetallescontrato_Helper_Add = "API_empleadosdetallescontrato_Helper_Add"
	 * 2. el nombre de esta constante debe ser API_empleadosdetallescontrato_Get = "API_empleadosdetallescontrato_Get"
	 */
	const API_empleadosdetallescontrato_Helper_Add = 'API_empleadosdetallescontrato_Helper_Add';
	const API_empleadosdetallescontrato_Get = 'API_empleadosdetallescontrato_Get';
	// empleadosdetallescontrato FIN

	// HomeCtrls INI
	// --Version2
	const API_PaquetesHomeHelperAdd = 'API_PaquetesHomeHelperAdd';

	const API_PaquetesAdminReg_Helper_Add = 'API_PaquetesAdminReg_Helper_Add';

	// --Version1
	const API_Home_RecuperaUsuario = 'API_Home_RecuperaUsuario';
	const API_Home_SolicitarTkn = 'API_Home_SolicitarTkn';
	const API_Home_Login = 'API_Home_Login';
	const API_Home_LoginAs = 'API_Home_LoginAs';
	const API_MiPerfilHomeGet = 'API_MiPerfilHomeGet';
	const API_Home_AlumnoPassAdd = 'API_Home_AlumnoPassAdd';
	const API_ContrasenaHome = 'API_ContrasenaHome';

	const API_Home_Empleado_Registro = 'API_Home_Empleado_Registro';
	// HomeCtrls FIN

	// Mascaras descarga
	const MASK_FLD_REPO_ANEXOS = 'MASK_FLD_REPO_ANEXOS';
	const MASK_FLD_REPO_PROCESOS = 'MASK_FLD_REPO_PROCESOS';
	
	public function __construct(){
	    // Here se centralizan todas las operaciones de envio de datos: POST, GET, REQUEST
	    //Singleton::_modelos();
	    
	    if(!isset($_SESSION)){ session_start(); }	    
	    if (isset( $_SESSION["usu"] )) {
	        $_usu_tmp = $_SESSION["usu"];
	        if( $_usu_tmp->getEstado_id() > 1){
	            Seguridad::logout();
	            echo "<script type=\"text/javascript\">alert(\"Usuario inactivo, bloqueado o eliminado\"); location.href='./index.php';</script>";
	            die("");
	        }
	    }
	    
	    // Api REST
	    if ( isset( $_SERVER['PATH_INFO'] ) ){
	        
	        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
	        $this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
	        
	        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
	        $this->renderCtrl($url_baseCtrls . "Rest.php");
	        
	        Rest::handler();
	        
	        die("");
	    }
	    
	    // Controlar accesos de usuarios
	    if( isset( $_POST["ajax"] ) ){
	        if( !($_POST["ajax"] == md5( self::API_IniciarLoginAsOtro )) ){
	            if ( isset( $_SESSION["url"] ) ) {
	                if ( trim(strtolower( $_SESSION["url"] )) != trim(strtolower( Utiles::getBaseUrl())) ) {
	                    Seguridad::logout();
	                    echo "<script type=\"text/javascript\">location.href='./index.php';</script>";
	                    die("");
	                }
	            }
	            
	        }
	    }
	    
	    if( isset($_REQUEST["ajaxl"]) ){
	        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
	        $this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
	        
	        if ( $_REQUEST["ajaxl"] == md5( self::API_LNK_DESCARGAR_ALUMNOS ) ) {
	            try{
	                $ok = OperacionesCtrl::Empleados_Download_Obtener( $_REQUEST );
	            }catch (Exception $ex){
	                $er = array("err" => $ex->getMessage());
	                echo json_encode($er);
	            }
	            
	            $flnm = date( "YmdHis" ) . ".csv";
	            header('Content-Type: text/csv');
	            header('Content-Disposition: attachment; filename="' . $flnm . '";');
	            echo $ok;
	            
	            die("");
	        }
	        
	        if ( $_REQUEST["ajaxl"] == md5( self::API_LNK_DESCARGAR_PDF ) ) {
	            try{
	                $ok = OperacionesCtrl::crearUrlMask( $_REQUEST, self::MASK_FLD_REPO_ANEXOS );
	            }catch (Exception $ex){
	                $er = array("err" => $ex->getMessage());
	                echo json_encode($er);
	            }
	            die("");
	        }
	        if ( $_REQUEST["ajaxl"] == md5( self::API_LNK_VISTA_PDF_PROC ) ) {
	            try{
	                $ok = OperacionesCtrl::crearUrlMask( $_REQUEST, self::MASK_FLD_REPO_PROCESOS );
	            }catch (Exception $ex){
	                $er = array("err" => $ex->getMessage());
	                echo json_encode($er);
	            }
	            die("");
	        }
	        
	        if ( $_REQUEST["ajaxl"] == md5( self::API_SESSION_ACTIVA ) ) {
	            if (isset( $_SESSION["usu"] )) {
	                echo json_encode(['active' => true]);
	            }
	            else{
	                echo json_encode(['active' => false]);
	            }
	            die("");
	        }
    	    
	    }
	    
		if( isset( $_POST ) ){
		    $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
		    $this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");		    
		    
			// Agregar campos comunes
			if (isset($_POST["ajax"])) {
				if (!isset($_SESSION)) {
					session_start();
				}

				if ($_POST["ajax"] == md5(self::API_AgregarConfigCorp)) {
					try {
						$ok = OperacionesCtrl::EscribirConfig($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				if ($_POST["ajax"] == md5(self::API_IniciarLoginAsOtro)) {
					$usuarios = new Usuarios();
					$strf = "where id = " . $_POST["as"] . "";
					$objRes = $usuarios->readInfo("*", $strf);

					if (sizeof($objRes) > 0) {
						unset($_SESSION["usu"]);
						unset($_SESSION["url"]);
						session_destroy();

						if (!$_SESSION) {
							@session_start();
						}
						$_SESSION["usu"] = $objRes[0];
						$_SESSION["url"] = Utiles::getBaseUrl();
					}

					header('location: ./index.php');
				}
				if ($_POST['ajax'] == md5(self::API_LoginSystemAjax)) {
					try {
						$ok = OperacionesCtrl::AutenticaUsuarioSisAjaxB64($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				// Listas principales INI
				if ($_POST["ajax"] == md5(self::API_ObtenerLugares)) {
					try {
						$ok = OperacionesCtrl::lugares_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_ObtenerTutores)) {
					try {
						$ok = OperacionesCtrl::usuarios_Obtener(array('perfil_id' => array('2', '3')));
						echo json_encode(array("ok" => $ok));
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Listas principales FIN

				// Sistema General INI
				if ($_POST["ajax"] == md5(self::API_TamanoUsoGet)) {
					try {
						$ok = OperacionesCtrl::sistema_Tamano_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				if ($_POST["ajax"] == md5(self::API_RecuperarSisClave)) {
					try {
						$ok = OperacionesCtrl::sistema_recuperarClave_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Sistema General FIN

				// Institucion INI
				if ($_POST["ajax"] == md5(self::API_InstitucionAdd)) {
					try {
						$ok = OperacionesCtrl::institucion_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_InstitucionLogo)) {
					try {
						$ok = OperacionesCtrl::institucion_AgregarLogo($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Institucion FIN

				// Empleados INI
				if ($_POST["ajax"] == md5(self::API_EmpleadosAdd)) {
					try {
						$ok = OperacionesCtrl::Empleados_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosMod)) {
					try {
						$ok = OperacionesCtrl::Empleados_Helper_Modificar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosRm)) {
					try {
						$ok = OperacionesCtrl::Empleados_Eliminar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosActivar)) {
					try {
						$ok = OperacionesCtrl::Empleados_Activar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosHelperGet)) {
					try {
						$ok = OperacionesCtrl::Empleados_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosGet)) {
					try {
						$ok = OperacionesCtrl::Empleados_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosHomeHelperGet)) {
					try {
						$ok = OperacionesCtrl::Empleados_Home_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosGetAjax)) {
					try {
						$ok = OperacionesCtrl::Empleados_ObtenerAjax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosHelperAdd)) {
					try {
						$ok = OperacionesCtrl::mnguserAdd_Helper($_POST, OperacionesCtrl::USUARIOS_PERFIL_EMPLEADOS);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosHelperOffAuthAdd)) {
					try {
						OperacionesCtrl::authRequOff();
						$ok = OperacionesCtrl::mnguserAdd_Helper($_POST, OperacionesCtrl::USUARIOS_PERFIL_EMPLEADOS);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosGetAnexos)) {
					try {
						OperacionesCtrl::authRequOff();
						$ok = OperacionesCtrl::Empleados_ObtenerFilesAjax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosClaveAsignadaAdminManual)) {
					try {
						$ok = OperacionesCtrl::Empleados_NuevaClaveAjax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_EmpleadosClaveAsignadaAdmin)) {
					try {
						$ok = OperacionesCtrl::Empleados_NuevaClaveAjax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Empleados FIN

				// Usuarios INI
				if ($_POST["ajax"] == md5(self::API_UsuariosAdd)) {
					try {
						$ok = OperacionesCtrl::usuarios_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosHelperMod)) {
					try {
						$ok = OperacionesCtrl::usuarios_Helper_Modificar($_POST, OperacionesCtrl::USUARIOS_HELPER_MODIFICAR);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosMod)) {
					try {
						$ok = OperacionesCtrl::usuarios_Modificar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosRm)) {
					try {
						$ok = OperacionesCtrl::usuarios_Eliminar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosHelperGet)) {
					try {
						$ok = OperacionesCtrl::usuarios_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosGet)) {
					try {
						$ok = OperacionesCtrl::usuarios_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosGetAjax)) {
					try {
						$ok = OperacionesCtrl::usuarios_ObtenerAjax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_AdminHelperAdd)) {
					try {
						$ok = OperacionesCtrl::mnguserAdd_Helper($_POST, OperacionesCtrl::USUARIOS_PERFIL_ADMINISTRADOR);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosMiniAdd)) {
					try {
						$ok = OperacionesCtrl::usuarios_Helper_AgregarMini($_POST, OperacionesCtrl::USUARIOS_PERFIL_PROVEEDOR);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosClaveAsignadaAdmin)) {
					try {
						$ok = OperacionesCtrl::usuarios_NuevaClaveAjax($_POST, OperacionesCtrl::USUARIOS_PERFIL_SUPERVISOR);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_UsuariosClaveAsignadaAdminManual)) {
					try {
						$ok = OperacionesCtrl::usuarios_NuevaClaveAjax($_POST, OperacionesCtrl::USUARIOS_PERFIL_SUPERVISOR);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				// Cargadatos.phtml INI
				if ($_POST["ajax"] == md5(self::API_Cargadatos_Upload)) {
					try {
						$ok = OperacionesCtrl::usuarios_CargaDatos_Upload($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Cargadatos.phtml FIN

				// Usuarios FIN

				// Codigoactiva INI
				if ($_POST["ajax"] == md5(self::API_CodigoactivaGet)) {
					try {
						$ok = OperacionesCtrl::codigoactiva_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_CodigoactivaAdd)) {
					try {
						$ok = OperacionesCtrl::codigoactiva_Add($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_CodigoactivaJson64Add)) {
					try {
						$ok = OperacionesCtrl::codigoactivaHelperJson64_Add($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Codigoactiva FIN

				// Contrasena INI
				if ($_POST["ajax"] == md5(self::API_Contrasena)) {
					try {
						$ok = OperacionesCtrl::cambioClave_Add($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Contrasena FIN

				// Anyolectivo INI
				if ($_POST["ajax"] == md5(self::API_AnyolectivoAdd)) {
					try {
						$ok = OperacionesCtrl::anyolectivo_Add_Helper($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Anyolectivo FIN

				// Fotos de perfil INI
				if ($_POST["ajax"] == md5(self::API_UpFotoPerfiles)) {
					try {
						$ok = OperacionesCtrl::SubirFotoPerfil($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Fotos de perfil FIN

				// Plantillas INI
				if ($_POST["ajax"] == md5(self::API_plantillasAdd)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_plantillasNew)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_Nuevo($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_plantillasDel)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_Eliminar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_plantillasMixAdd)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_Mezclar_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_plantillasMixGet)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_Mezclar_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_plantillasMixSend)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_Mezclar_Enviar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_plantillasMixVariablesHelperGet)) {
					try {
						$ok = OperacionesCtrl::editarPlantillas_JBB_Variables_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Plantillas FIN

				// Firmas INI
				
				if ( $_POST["ajax"] == md5( self::API_FirmasGet ) ) {
				    try{
				        $ok = OperacionesCtrl::firmaspro_Helper_Obtener( $_POST );
				        echo json_encode($ok);
				    }catch (Exception $ex){
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				
				if ( $_POST["ajax"] == md5( self::API_FirmasPreviaGet ) ) {
				    try{
				        $ok = OperacionesCtrl::firmaspro_Preview_Obtener( $_POST );
				        echo json_encode($ok);
				    }catch (Exception $ex){
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_FirmasAgregarConfigCorp_Add)) {
					try {
						$ok = OperacionesCtrl::firmaspro_Config_Page_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FirmasAgregarConfigCorp_Get)) {
					try {
						$ok = OperacionesCtrl::firmaspro_Config_Page_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// yalfonso - JBB
				if ( $_POST["ajax"] == md5( self::API_FirmasproHelperAdd ) ) {
				    try{
				        $ok = OperacionesCtrl::firmaspro_Helper_FirmarDoc( $_POST );
				        echo json_encode($ok);
				    }catch (Exception $ex){
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ( $_POST["ajax"] == md5( self::API_FirmasproAdminP12Add ) ) {
				    try{
				        $ok = OperacionesCtrl::firmaspro_Helper_Admin_MkCert_p12( $_POST );
				        echo json_encode($ok);
				    }catch (Exception $ex){
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Firmas FIN

				// Firmaslog INI
				if ( $_POST["ajax"] == md5( self::API_FirmaslogHelperEvent ) ) {
				    try{
				        $ok = OperacionesCtrl::firmaspro_Helper_EventsObtener( $_POST );
				        echo json_encode($ok);
				    }catch (Exception $ex){
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Firmaslog FIN
				
				// ApiBox INI
				if ($_POST["ajax"] == md5(self::API_ApiboxGet)) {
					try {
						$ok = OperacionesCtrl::apibox_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// ApiBox FIN
				
				// Deducciones INI
				if ( $_POST["ajax"] == md5( self::API_DeduccionesHelperAdd ) ) {
				    try {
				        $ok = OperacionesCtrl::deducciones_Helper_Agregar( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Deducciones FIN
				
				// Deducciones Virtual INI
				if ( $_POST["ajax"] == md5( self::API_DeduccionesVirtualAdd ) ) {
				    try {
				        $ok = OperacionesCtrl::deducciones_Config_Agregar($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ( $_POST["ajax"] == md5( self::API_DeduccionesVirtualGet ) ) {
				    try {
				        $ok = OperacionesCtrl::deducciones_Config_Obtener($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ( $_POST["ajax"] == md5( self::API_DeduccionesVirtualGetAjax ) ) {
				    try {
				        $ok = OperacionesCtrl::deducciones_Config_Obtener_Ajax($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				
				if ( $_POST["ajax"] == md5( self::API_DeduccionesVirtualDel ) ) {
				    try {
				        $ok = OperacionesCtrl::deducciones_Config_Eliminar($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Deducciones Virtual FIN

				// requerimientostpls INI
				if ($_POST["ajax"] == md5(self::API_RequerimientostplsGetAjax)) {
					try {
						$ok = OperacionesCtrl::requerimientostpls_Obtener_Ajax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_RequerimientosHelperAdd)) {
					try {
						$ok = OperacionesCtrl::requerimientostpls_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_RequerimientostplsitemsHelperGet)) {
					try {
						$ok = OperacionesCtrl::requerimientostplsitems_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// requerimientostpls FIN

				// Flujos INI
				if ($_POST["ajax"] == md5(self::API_FlujosHelperEstadoMod)) {
					try {
						$ok = OperacionesCtrl::flujos_Estados_Helper_Modificar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FlujosHelperAdd)) {
					try {
						$ok = OperacionesCtrl::flujos_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FlujosGetAjax)) {
					try {
						$ok = OperacionesCtrl::flujos_Obtener_Ajax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Flujos FIN

				// Flujositems INI
				if ($_POST["ajax"] == md5(self::API_FlujositemsPrincipalHelperGet)) {
					try {
						$ok = OperacionesCtrl::flujositems_Pricipal_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FlujositemsGet)) {
					try {
						$ok = OperacionesCtrl::flujositems_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FlujositemsHelperGet)) {
					try {
						$ok = OperacionesCtrl::flujositems_Helper_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FlujositemsHelperDel)) {
					try {
						$ok = OperacionesCtrl::flujositems_Helper_Eliminar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FlujositemsRevDtGet)) {
				    try {
				        $ok = OperacionesCtrl::flujositems_Helper_ObtenerRevisorData($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Flujositems FIN

				// Paquetes INI
				if ($_POST["ajax"] == md5(self::API_PaquetesHomeHelperAdd)) {
					try {
						$ok = OperacionesCtrl::paquetes_Home_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_PaquetesGetAjax)) {
				    try {
				        $ok = OperacionesCtrl::paquetes_Obtener_Ajax( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_PaquetesHelperGetAjax)) {
					try {
						$ok = OperacionesCtrl::paquetes_Helper_Obtener_Ajax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_PaquetesHelperMoveReview)) {
				    try {
				        $ok = OperacionesCtrl::paquetes_Helper_MoverRevisar($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_PaquetesHelperMoveAdmin)) {
				    try {
				        $ok = OperacionesCtrl::paquetes_Helper_MoverAdmin($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Paquetes FIN

				// Paquetesrequ INI
				if ($_POST["ajax"] == md5(self::API_PaquetesrequHelperAdd)) {
					try {
						$ok = OperacionesCtrl::paquetesrequ_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				// Paquetesrequ FIN
				
				// paquetesreqcomentarios INI
				if ($_POST["ajax"] == md5(self::API_PaquetesreqcomentariosHelperGet)) {
				    try {
				        $ok = OperacionesCtrl::paquetesreqcomentarios_Helper_Obtener( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_PaquetesreqcomentariosHelperAdd)) {
				    try {
				        $ok = OperacionesCtrl::paquetesreqcomentarios_Helper_Agregar( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_PaquetesreqcomentariosHelperDel)) {
				    try {
				        $ok = OperacionesCtrl::paquetesreqcomentarios_Helper_Eliminar( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// paquetesreqcomentarios FIN
				
				/*
				 * @yalfonso
				 * TODO: Tarea 68 Agregar controlador de enrutamiento para Apoyo supervisor
				 */
				// Apoyos INI
				if ( $_POST["ajax"] == md5(self::API_ApoyosGet) ) {
				    try {
				        $ok = OperacionesCtrl::apoyos_Obtener($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ( $_POST["ajax"] == md5(self::API_ApooyosHelperAdd) ) {
				    try {
				        $ok = OperacionesCtrl::apoyos_Helper_Agregar($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ( $_POST["ajax"] == md5(self::API_ApoyosDel) ) {
				    try {
				        $ok = OperacionesCtrl::apoyos_Eliminar($_POST);
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// Apoyos FIN

				if ($_POST["ajax"] == md5(self::API_PaquetesAdminReg_Helper_Add)) {
					try {
						$ok = OperacionesCtrl::paquetesAdminReg_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				// Reflista INI
				if ($_POST["ajax"] == md5(self::API_ReflistaGet)) {
					try {
						$ok = OperacionesCtrl::reflista_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Reflista FIN

				// Formularios INI
				if ($_POST["ajax"] == md5(self::API_FormulariosGetAjax)) {
					try {
						$ok = OperacionesCtrl::formularios_Obtener_Ajax($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FormulariosHelperAdd)) {
					try {
						$ok = OperacionesCtrl::formularios_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_FormulariosGet)) {
					try {
						$ok = OperacionesCtrl::formularios_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// Formularios FIN

				// empleadosdetallescontrato INI
				/*
				 * @vnavarro
				 * TODO: tarea 6
				 * Enrutamos a la funcion empleadosdetallescontrato_Obtener del controlador OperacionesCtrl.php
				 * 1. copiar desde la linea 1072 hasta 1081
				 * 2. la comparacion debe ser $_POST["ajax"] == md5( self::API_empleadosdetallescontrato_Get )
				 * 3. la funcion debe ser $ok = OperacionesCtrl::empleadosdetallescontrato_Obtener( $_POST );
				 */

				if ($_POST["ajax"] == md5(self::API_empleadosdetallescontrato_Get)) {
					try {
						$ok = OperacionesCtrl::empleadosdetallescontrato_Obtener($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				/*
				 * @vnavarro
				 * TODO: tarea 7
				 * Enrutamos a la funcion empleadosdetallescontrato_Helper_Agregar del controlador OperacionesCtrl.php
				 * 1. la comparacion debe ser $_POST["ajax"] == md5( self::API_empleadosdetallescontrato_Helper_Add )
				 * 2. la funcion debe ser $ok = OperacionesCtrl::empleadosdetallescontrato_Helper_Agregar( $_POST );
				 */
				if ($_POST["ajax"] == md5(self::API_empleadosdetallescontrato_Helper_Add)) {
					try {
						$ok = OperacionesCtrl::empleadosdetallescontrato_Helper_Agregar($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				if (isset($_POST['ajax']) && $_POST['ajax'] === md5(self::API_Bogdata_Consultar)) {
					try {
						$post = $_POST;

						if (isset($post['buscarpor']) && is_string($post['buscarpor'])) {
							$bp = json_decode($post['buscarpor'], true);
							if (json_last_error() !== JSON_ERROR_NONE) {
								throw new Exception('Formato inválido: buscarpor no es JSON válido');
							}
							$post['buscarpor'] = $bp;
						}

						if (!isset($post['buscarpor']) || !is_array($post['buscarpor'])) {
							$post['buscarpor'] = []; // sin filtros
						} else {
							// Limpieza básica cuando sí vienen filtros
							$clean = [];
							foreach ($post['buscarpor'] as $c) {
								$campo = isset($c['campo']) ? trim((string) $c['campo']) : '';
								$valor = isset($c['valor']) ? trim((string) $c['valor']) : '';
								if ($campo !== '' && $valor !== '') {
									$clean[] = ['campo' => $campo, 'valor' => $valor];
								}
							}
							// Si después de limpiar quedó vacío, también significa "traer todo"
							$post['buscarpor'] = $clean;
						}

						$ok = OperacionesCtrl::empleados_Procesar_Archivos($post);
						echo json_encode($ok);
					} catch (Exception $ex) {
						http_response_code(IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
						echo json_encode(['err' => $ex->getMessage()]);
					}
					die("");
				}

				// empleadosdetallescontrato FIN

				// HomeCtrls INI

				// Recuperar cuenta
				if ($_POST["ajax"] == md5(self::API_Home_RecuperaUsuario)) {
					try {
						$ok = OperacionesCtrl::home_Login_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_Home_SolicitarTkn)) {
					try {
						$ok = OperacionesCtrl::home_RecuToken_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_Home_Login)) {
					try {
						$ok = OperacionesCtrl::home_Start_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_Home_LoginAs)) {
					try {
						$ok = OperacionesCtrl::home_LoginAs_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_MiPerfilHomeGet)) {
					try {
						$ok = OperacionesCtrl::home_Perfil_Get($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_Home_AlumnoPassAdd)) {
					try {
						$ok = OperacionesCtrl::home_AlumnoPass_Add($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				if ($_POST["ajax"] == md5(self::API_ContrasenaHome)) {
					try {
						$ok = OperacionesCtrl::cambioClave_Home_Add($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}

				if ($_POST["ajax"] == md5(self::API_Home_Empleado_Registro)) {
					try {
						$ok = OperacionesCtrl::empleados_Home_Helper_Add($_POST);
						echo json_encode($ok);
					} catch (Exception $ex) {
						$er = array("err" => $ex->getMessage());
						echo json_encode($er);
					}
					die("");
				}
				// HomeCtrls FIN

			}
		}

	}

	public static function JS_Name_get()
	{
		$array = parse_url(Utiles::getBaseUrl());
		$n = 'acpp_admin_' . str_replace(".", "", $array['host']);
		return $n;
	}

	private function renderCtrl($rutaVista)
	{
		$vista = pathinfo($rutaVista);
		$url_baseCtrls = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
		$rutaCtrl = $url_baseCtrls . $vista['filename'] . "Ctrl.php";
		if (file_exists($rutaCtrl)) {
			include_once $rutaCtrl;
			$tmpNombreClase = $vista['filename'] . "Ctrl";
			$rutaCtrlO = new $tmpNombreClase();
			$rutaCtrlO->render();
			return $rutaCtrlO;
		} else {
			include_once $rutaVista;
		}
	}

	public function render()
	{
		if (!isset($_SESSION)) {
			session_start();
		}

		$url_base = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "tpls" . DIRECTORY_SEPARATOR;

		$this->renderCtrl($url_base . "Encabezado.phtml");

		if (Seguridad::isLogin()) {
			if (isset($_REQUEST["logout"])) {
				Seguridad::logout();
				@header("location: ./index.php");
				echo "<script type=\"text/javascript\">location.href='./index.php';</script>";
			}

			if (isset($_REQUEST["pageid"])) {

				$rutaVista = $url_base . $_REQUEST["pageid"];
				if ($_REQUEST["pageid"] != Config::PAGINA_LOGIN) {

					if (file_exists($rutaVista)) {
						$this->renderCtrl($rutaVista);
					} else {
						$this->setMensaje("P&aacute;gina no existente!");
						$this->renderCtrl($url_base . Config::PAGINA_ERROR);
					}

				} else {
					$rutaVista = $url_base . Config::PAGINA_WORKSPACE;
					$this->renderCtrl($rutaVista);
				}

			} else {
				$rutaVista = $url_base . Config::PAGINA_WORKSPACE;
				$this->renderCtrl($rutaVista);
			}
		} else {
			if (isset($_POST["cmd"])) {
				if (isset($_POST["usuario"]) && isset($_POST["clave"])) {
					if (strlen(trim($_POST["usuario"])) > 0 || strlen(trim($_POST["clave"])) > 0) {
						if (Seguridad::loginAdmin($_POST["usuario"], $_POST["clave"])) {


							$_olg = array(
								"refid" => "WEB_USR_LGN_OK",
								"vl" => self::USABILIDAD_MSJ_LOGINOK,
								"usr" => trim($_POST["usuario"])
							);
							try {
								OperacionesCtrl::Usabilidad_agregar($_olg);
							} catch (Exception $e) {
								error_log("IndexCtrl.render: " . $e->getMessage());
							}

							@header("location: ./index.php");
							echo "<script type=\"text/javascript\">location.href='./index.php';</script>";
						} else {
							$this->setMensaje('<div class="alert alert-danger" role="alert"><i class="fas fa-bug"></i> Usuario o Clave inv&aacute;lida!</div>');
						}
					} else {
						$this->setMensaje("Campos vac&iacute;os!");
					}
				}
			}
			$this->renderCtrl($url_base . Config::PAGINA_LOGIN);
		}
		$this->renderCtrl($url_base . Config::PAGINA_PIE);

		echo "	\n";
		echo "	</body>\n";
		echo "</html>";
	}

}
?>