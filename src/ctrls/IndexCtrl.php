<?php
/**
 * Clase controladora principal de la aplicación que extiende la clase Pagina
 * 
 * Esta clase maneja la funcionalidad central de la aplicación incluyendo:
 * - Constantes de codificación de caracteres
 * - Configuración de carga de archivos
 * - Estados de visibilidad de campos
 * - Definiciones de perfiles/roles de usuario
 * - IDs y mensajes de usabilidad 
 * - Códigos y mensajes de error
 * - Definiciones de endpoints API para:
 *   - Autenticación
 *   - Gestión de instituciones
 *   - Gestión de empleados  
 *   - Gestión de usuarios
 *   - Configuración de ajustes
 *   - Gestión de plantillas
 *   - Firmas digitales
 *   - Gestión de flujos de trabajo
 *   - Gestión de paquetes
 *   - Gestión de formularios
 *   - Gestión de perfiles
 * 
 * La clase proporciona:
 * - Gestión de sesiones y autenticación
 * - Enrutamiento de peticiones y endpoints API
 * - Control de acceso y seguridad  
 * - Descargas de archivos (CSV, PDF)
 * - Manejo de peticiones AJAX
 * 
 * Actúa como el punto de entrada y controlador principal para todas las operaciones 
 * de la aplicación coordinando entre vistas, modelos y otros controladores.
 */

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
   
	/**
	 * Mensaje de usabilidad que indica que el inicio de sesión se realizó correctamente.
	 * 
	 * Texto que se muestra al usuario cuando las credenciales son válidas y
	 * la autenticación se completa con éxito.
	 * 
	 * @var string
	 */
    const USABILIDAD_MSJ_LOGINOK = 'ingreso login correcto';
    
  
	/**
	 * Constante de código de error: El usuario no tiene privilegios suficientes
	 * Se usa cuando un usuario intenta realizar una operación sin tener los permisos necesarios
	 * 
	 * @const int ERR_COD_SIN_PRIVILEGIOS
	 * @var int 520  
	 */
	const ERR_COD_SIN_PRIVILEGIOS = 520;
	/**
	 * Constante de código de error: El ID de usuario no existe
	 * Se usa cuando se intenta recuperar un usuario por ID que no se encuentra en el sistema
	 * 
	 * @const int ERR_COD_USUARIO_NO_EXISTE_BY_ID 
	 * @var int 521
	 */
    const ERR_COD_USUARIO_NO_EXISTE_BY_ID = 521; 
	/**
	 * Constante de código de error: Error al enviar correo electrónico
	 * Se usa cuando una operación de envío de correo electrónico falla en el sistema
	 * 
	 * @const int ERR_COD_ENVIO_MAIL_FALLIDO
	 * @var int 522
	 */
    const ERR_COD_ENVIO_MAIL_FALLIDO = 522;
	/**
	 * Constante de código de error: Error al cambiar la contraseña
	 * 
	 * Esta constante representa el código de error específico (523) que se devuelve
	 * cuando falla un intento de cambio de contraseña en el sistema.
	 * 
	 * @const int ERR_COD_CAMBIO_CLAVE_FALLIDO
	 * @var int 523
	 */
	const ERR_COD_CAMBIO_CLAVE_FALLIDO = 523;
	/**
	 * Constante de código de error: Representa un error de validación cuando falta un campo obligatorio
	 * 
	 * Esta constante se utiliza en toda la aplicación para identificar errores relacionados con
	 * campos obligatorios que no fueron proporcionados por el usuario.
	 *
	 * @const int ERR_COD_CAMPO_OBLIGATORIO
	 * @var int 524
	 */
    const ERR_COD_CAMPO_OBLIGATORIO = 524;
	/**
	 * Código de error: Comunicación sin destinatario
	 * 
	 * Esta constante representa un error que ocurre cuando se intenta 
	 * enviar un mensaje sin agregar ningún destinatario
	 * 
	 * @const int ERR_COD_COMUNICACIONES_SIN_DESTINATARIO
	 * @var int 525
	 */
    const ERR_COD_COMUNICACIONES_SIN_DESTINATARIO = 525;
	/**
	 * Código de error: Fallo al agregar destinatarios en una comunicación
	 * 
	 * Esta constante representa un escenario específico de error donde el sistema 
	 * falló al agregar destinatario(s) a un mensaje durante el proceso de comunicación.
	 * 
	 * @const int ERR_COD_COMUNICACIONES_AGREGANDO
	 * @var int 526
	 */
    const ERR_COD_COMUNICACIONES_AGREGANDO = 526;
	/**
	 * Constante de código de error: Error al obtener la lista de destinatarios para envío
	 * 
	 * Este error ocurre cuando se intenta recuperar la lista de destinatarios para un mensaje
	 * pero no se encontraron o agregaron destinatarios.
	 * 
	 * @const int ERR_COD_COMUNICACIONES_OBTENER_LISTA_POR_ENVIAR 
	 * @var int 527
	 */

    const ERR_COD_COMUNICACIONES_OBTENER_LISTA_POR_ENVIAR = 527;
	/**
	 * Código de error: Error al agregar destinatarios en la agenda
	 * 
	 * Esta constante representa el código de error (528) que se devuelve 
	 * cuando el sistema falla al agregar destinatarios a un mensaje
	 * en la funcionalidad de agenda
	 *
	 * @const int ERR_COD_AGENDA_AGREGAR
	 * @var int 528 
	 */
    const ERR_COD_AGENDA_AGREGAR = 528;
	/**
	 * Constante de código de error: Sesión inactiva
	 * Indica que la sesión del usuario ha sido cerrada debido a un tiempo de inactividad.
	 * 
	 * @const int ERR_COD_SESION_INACTIVA 
	 * @var int 529
	 */
    const ERR_COD_SESION_INACTIVA = 529;
	/**
	 * Constante de código de error: Para errores comunes
	 * Se utiliza cuando ocurren errores generales de inserción en el sistema
	 * 
	 * @const int ERR_COD_MSJ_ERR_COMUN 
	 * @value 530
	 */
    const ERR_COD_MSJ_ERR_COMUN = 530; 
	/**
	 * Constante de código de error: La contraseña del empleado no fue modificada
	 * 
	 * Esta constante representa el código de error (531) que se devuelve cuando
	 * falla el intento de modificar la contraseña de un empleado.
	 * 
	 * @const int ERR_COD_EST_CLAVE_NO_MODIFICADA
	 * @var int 531
	 */
    const ERR_COD_EST_CLAVE_NO_MODIFICADA = 531;
	/**
	 * Constante de código de error: Error al enviar correo electrónico
	 * 
	 * Esta constante representa el código de error que se devuelve cuando
	 * el sistema falla al enviar un mensaje de correo electrónico
	 * 
	 * @const int ERR_COD_CORREO_FAIL
	 * @var int 532
	 */

    const ERR_COD_CORREO_FAIL = 532; 
	/**
	 * Constante de código de error: El usuario existe pero sin datos
	 * 
	 * Esta constante representa el código de error (533) que se devuelve cuando 
	 * existe una cuenta de usuario en el sistema pero no tiene datos asociados.
	 * 
	 * @const int ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS
	 * @var int 533
	 */
    const ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS = 533;
	/**
	 * Constante de código de error: El acudiente no tiene hijos activos en el sistema
	 * 
	 * Este error se lanza cuando se intenta realizar operaciones que requieren
	 * hijos activos asociados a un acudiente, pero no se encuentran.
	 * 
	 * @const int ERR_COD_ACUDIENTE_HIJOS_ACTIVOS
	 * @var int 534
	 */
    const ERR_COD_ACUDIENTE_HIJOS_ACTIVOS = 534;
	/**
	 * Constante de código de error: Usuario o clave inválida
	 * 
	 * Esta constante representa el código de error (535) que se devuelve cuando
	 * las credenciales proporcionadas (usuario o contraseña) son inválidas.
	 * 
	 * @const int ERR_COD_USUARIO_O_CLAVE_INVALIDA
	 * @var int 535
	 */
    const ERR_COD_USUARIO_O_CLAVE_INVALIDA = 535;
	/**
	 * Constante de código de error: Error al guardar la plantilla
	 * 
	 * Esta constante representa el código de error (536) que se devuelve
	 * cuando falla el intento de guardar una plantilla en el sistema.
	 * 
	 * @const int ERR_COD_PLANTILLA_NO_SALVADA 
	 * @var int 536
	 */
    const ERR_COD_PLANTILLA_NO_SALVADA = 536;
	/**
	 * Constante de código de error: Registro existente con los mismos datos
	 * 
	 * Esta constante representa el código de error (537) que se devuelve cuando
	 * se intenta insertar un registro duplicado en el sistema.
	 * 
	 * @const int ERR_COD_REGISTRO_EXISTENTE
	 * @var int 537
	 */
    const ERR_COD_REGISTRO_EXISTENTE = 537;
	/**
	 * Constante de código de error: Error al actualizar datos SQL 
	 * 
	 * Esta constante representa el código de error (538) que se devuelve
	 * cuando falla un intento de actualizar datos mediante una sentencia SQL.
	 *
	 * @const int ERR_COD_ACTUALIZACION_SQL
	 * @var int 538
	 */
    const ERR_COD_ACTUALIZACION_SQL = 538;
	/**
	 * Constante de código de error: Error al eliminar datos SQL
	 * 
	 * Esta constante representa el código de error (538) que se devuelve
	 * cuando falla un intento de eliminar registros mediante una sentencia SQL.
	 * 
	 * @const int ERR_COD_ELIMINACION_SQL
	 * @var int 538
	 */
    const ERR_COD_ELIMINACION_SQL = 538;
	/**
	 * Constante de código de error: Respuesta SQL vacía
	 * 
	 * Esta constante representa el código de error (539) que se devuelve 
	 * cuando una consulta a la base de datos no retorna resultados.
	 * 
	 * @const int ERR_COD_RESPUESTA_SQL_VACIA 
	 * @var int 539
	 */
    const ERR_COD_RESPUESTA_SQL_VACIA = 539;
	/**
	 * Mensaje de error que se muestra cuando un usuario intenta crear usuarios sin permisos suficientes.
	 * Esta constante se utiliza para la validación de control de acceso en operaciones de gestión de usuarios.
	 * 
	 * @var string
	 */
	const SIN_PRIVILEGIOS = "No tiene los permisos suficientes para crear usuarios.";
	/**
	 * Mensaje de error que se muestra cuando un usuario intenta realizar una operación 
	 * que requiere autenticación sin haber iniciado sesión en el sistema.
	 * 
	 * Esta constante contiene un mensaje en español con codificación HTML que indica
	 * que es necesario estar autenticado para la operación intentada.
	 * 
	 * @var string
	 */
	const USUARIO_NO_AUTENTICADO = "Para esta operaci&oacute;n es obligatorio estar autenticado.";
	/**
	 * Constante que define el tiempo de retraso en milisegundos para las notificaciones de carga AJAX.
	 * 
	 * Este valor se utiliza para controlar el tiempo de las notificaciones del diálogo de carga
	 * en las peticiones AJAX a través de la aplicación.
	 * 
	 * @var string
	 */
	const TIEMPO_AJAX_LDN = "1000";


	/**
	 * Constante de enlace API para descargar datos de alumnos.
	 * 
	 * Esta constante define el endpoint de API utilizado para recuperar/descargar registros de alumnos.
	 * Sirve como identificador de cadena para la ruta API que maneja las descargas de datos de alumnos.
	 * 
	 * @const string 
	 */
	const API_LNK_DESCARGAR_ALUMNOS = 'API_LNK_DESCARGAR_ALUMNOS';
	/**
	 * Constante de enlace para descargar archivos PDF a través de la API.
	 * 
	 * Esta constante define el endpoint/ruta utilizada para acceder a la funcionalidad 
	 * de descarga de PDF a través de la interfaz API de la aplicación.
	 * 
	 * @const string API_LNK_DESCARGAR_PDF El endpoint de API para descargas de PDF
	 */
	const API_LNK_DESCARGAR_PDF = 'API_LNK_DESCARGAR_PDF';
	/**
	 * Constante de enlace API para visualizar proceso PDF.
	 * 
	 * Esta constante define el endpoint de la API utilizado para ver/procesar 
	 * documentos PDF en el sistema.
	 * 
	 * @const string API_LNK_VISTA_PDF_PROC El endpoint de API para visualización de PDF
	 */
	const API_LNK_VISTA_PDF_PROC = 'API_LNK_VISTA_PDF_PROC';
	/**
	 * Constante de enlace para descargar certificados desde la API
	 * 
	 * Esta constante define el identificador de URL del endpoint de API
	 * para la descarga de certificados
	 * 
	 * @const string API_LNK_DESCARGAR_CERTIFICADOS El endpoint de API para descargas de certificados
	 */
	const API_LNK_DESCARGAR_CERTIFICADOS = 'API_LNK_DESCARGAR_CERTIFICADOS';
	/**
	 * Constante que representa el estado de una sesión API activa.
	 * 
	 * Esta constante se utiliza para verificar si hay una sesión válida ejecutándose en la API.
	 * 
	 * @const string API_SESSION_ACTIVA El identificador de la sesión API activa
	 */
	const API_SESSION_ACTIVA = 'API_SESSION_ACTIVA';
	/**
	 * Constante para el endpoint de la API para agregar configuración corporativa.
	 * 
	 * Este endpoint maneja la adición de nuevas configuraciones corporativas.
	 * 
	 * @const string API_AgregarConfigCorp El endpoint de API para agregar configuración corporativa
	 */
	const API_AgregarConfigCorp = 'API_AgregarConfigCorp';
	/**
	 * Constante que representa el endpoint de API para iniciar sesión como otro usuario.
	 * 
	 * Esta funcionalidad permite a usuarios autorizados suplantar o cambiar a la sesión de otro usuario.
	 * 
	 * @const string API_IniciarLoginAsOtro El endpoint de API para iniciar sesión como otro usuario
	 */
	const API_IniciarLoginAsOtro = 'API_IniciarLoginAsOtro';
	/**
	 * Constante de endpoint API para sistema de login AJAX
	 * 
	 * Esta constante define el identificador para manejar peticiones de autenticación basadas en AJAX
	 * 
	 * @const string API_LoginSystemAjax El endpoint de API para login AJAX
	 */
	const API_LoginSystemAjax = 'API_LoginSystemAjax';

	// Listas principales INI
	/**
	 * Constante de endpoint API para recuperar lugares/ubicaciones.
	 * Se utiliza para obtener una lista de ubicaciones disponibles del sistema.
	 * 
	 * @const string API_ObtenerLugares El endpoint de API para obtener lugares
	 */
	const API_ObtenerLugares = 'API_ObtenerLugares';
	/**
	 * Constante de endpoint API para obtener tutores.
	 * 
	 * Esta constante define el nombre del endpoint de API utilizado para
	 * solicitar la lista de tutores del sistema.
	 * 
	 * @const string API_ObtenerTutores El endpoint de API para obtener tutores
	 */
	const API_ObtenerTutores = 'API_ObtenerTutores';
	// Listas principales FIN

	// Sistema General INI
	/**
	 * Constante del endpoint API para obtener información de uso de tamaño.
	 * 
	 * Esta constante define el nombre del endpoint para recuperar información
	 * sobre el uso de tamaño en el sistema.
	 * 
	 * @const string API_TamanoUsoGet El endpoint de API para obtener uso de tamaño
	 */
	const API_TamanoUsoGet = 'API_TamanoUsoGet';
	/**
	 * Constante que define el punto final de la API para la funcionalidad de recuperación de contraseña
	 * 
	 * Esta constante representa el nombre del endpoint de API utilizado para manejar
	 * las solicitudes de recuperación de contraseña del sistema en la aplicación.
	 * 
	 * @const string API_RecuperarSisClave El endpoint de API para recuperación de contraseña
	 */
	const API_RecuperarSisClave = 'API_RecuperarSisClave';
	// Sistema General FIN

	// Institucion INI
	/**
	 * Constante de endpoint API para agregar una nueva institución
	 * 
	 * Se utiliza para identificar la ruta o acción de la API 
	 * para crear/agregar un nuevo registro de institución en el sistema
	 * 
	 * @const string API_InstitucionAdd El endpoint de API para agregar institución
	 */
	const API_InstitucionAdd = 'API_InstitucionAdd';
	/**
	 * Constante de endpoint API para obtener el logo de la institución
	 * 
	 * Esta constante define el nombre del endpoint de API utilizado para 
	 * recuperar el logo de la institución.
	 * 
	 * @const string API_InstitucionLogo El endpoint de API para el logo institucional
	 */
	const API_InstitucionLogo = 'API_InstitucionLogo';
	// Institucion FIN

	// Empleados INI 
	/**
	 * Constante de endpoint API para agregar nuevos empleados
	 * 
	 * Define el identificador del endpoint utilizado para operaciones 
	 * de creación de empleados a través de la API
	 * 
	 * @const string API_EmpleadosAdd El endpoint de API para agregar empleados
	 */
	const API_EmpleadosAdd = 'API_EmpleadosAdd';
	/**
	 * Constante de endpoint API para operaciones de modificación de empleados
	 * 
	 * Esta constante define el identificador de endpoint utilizado para manejar
	 * solicitudes de modificación de empleados en la API
	 * 
	 * @const string API_EmpleadosMod El endpoint de API para modificar empleados
	 */
	const API_EmpleadosMod = 'API_EmpleadosMod';
	/**
	 * Constante de endpoint API para gestionar empleados eliminados.
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado para manejar
	 * operaciones relacionadas con empleados eliminados/inactivos en el sistema.
	 * 
	 * @const string API_EmpleadosRm El endpoint de API para eliminar empleados
	 */
	const API_EmpleadosRm = 'API_EmpleadosRm';
	/**
	 * Constante de endpoint API para activación de empleados.
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado para
	 * activar/reactivar empleados en el sistema.
	 * 
	 * @const string API_EmpleadosActivar El endpoint de API para activar empleados
	 */
	const API_EmpleadosActivar = 'API_EmpleadosActivar';

	/**
	 * Constante de endpoint API para obtener datos auxiliares de empleados
	 * 
	 * Esta constante define el identificador del endpoint utilizado para peticiones GET
	 * para recuperar información auxiliar de empleados desde la API.
	 * 
	 * @const string API_EmpleadosHelperGet El endpoint de API para obtener datos auxiliares de empleados
	 */
	const API_EmpleadosHelperGet = 'API_EmpleadosHelperGet';

	/**
	 * Constante de endpoint API para obtener datos de empleados.
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado
	 * para peticiones GET de información de empleados.
	 * 
	 * @const string API_EmpleadosGet El endpoint de API para obtener datos de empleados
	 */
	const API_EmpleadosGet = 'API_EmpleadosGet';

	/**
	 * Constante de endpoint API para obtener datos auxiliares de inicio de empleados
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado para 
	 * recuperar información auxiliar de la página de inicio de empleados
	 * 
	 * @const string API_EmpleadosHomeHelperGet El endpoint de API para obtener datos auxiliares de inicio de empleados
	 */
	const API_EmpleadosHomeHelperGet = 'API_EmpleadosHomeHelperGet';
	
	/**
	 * Constante de endpoint API para obtener datos de empleados mediante AJAX
	 * 
	 * Esta constante define el identificador para el endpoint AJAX que maneja
	 * las solicitudes de recuperación de datos de empleados.
	 * 
	 * @const string API_EmpleadosGetAjax El endpoint de API para obtener datos de empleados vía AJAX
	 */
	const API_EmpleadosGetAjax = 'API_EmpleadosGetAjax';
	/**
	 * Constante de endpoint API para agregar ayudantes de empleados.
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado para
	 * operaciones de adición de ayudantes de empleados en el sistema.
	 * 
	 * @const string API_EmpleadosHelperAdd El endpoint de API para agregar ayudantes de empleados
	 */
	const API_EmpleadosHelperAdd = 'API_EmpleadosHelperAdd';
	/**
	 * Constante de endpoint API para agregar ayudantes de empleados sin autenticación.
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado para 
	 * agregar registros de ayudantes de empleados en modo offline sin requerir autenticación.
	 * 
	 * @const string API_EmpleadosHelperOffAuthAdd El endpoint de API para agregar ayudantes de empleados sin autenticación
	 */
	const API_EmpleadosHelperOffAuthAdd = 'API_EmpleadosHelperOffAuthAdd';
	/**
	 * Constante que representa el endpoint de la API para recuperar anexos de empleados.
	 * 
	 * Este endpoint permite obtener anexos o archivos adjuntos asociados con los empleados.
	 * 
	 * @const string API_EmpleadosGetAnexos El endpoint de API para obtener anexos de empleados
	 */
	const API_EmpleadosGetAnexos = 'API_EmpleadosGetAnexos';
	/**
	 * Constante que define el endpoint de la API para empleados con claves de administrador asignadas manualmente.
	 * Se utiliza en procesos de autenticación y control de acceso.
	 * 
	 * @const string API_EmpleadosClaveAsignadaAdminManual El endpoint de API para empleados con claves de administrador asignadas manualmente
	 */
	const API_EmpleadosClaveAsignadaAdminManual = 'API_EmpleadosClaveAsignadaAdminManual';
	/**
	 * Constante que representa el endpoint de API para empleados con credenciales de administrador asignadas
	 * 
	 * Se utiliza para definir el identificador de ruta/endpoint para gestionar el acceso 
	 * administrativo de empleados y claves de seguridad asignadas en el sistema
	 * 
	 * @const string API_EmpleadosClaveAsignadaAdmin El endpoint de API para empleados con claves de administrador asignadas
	 */
	const API_EmpleadosClaveAsignadaAdmin = 'API_EmpleadosClaveAsignadaAdmin';
	// Empleados FIN

	// Usuarios INI
	/**
	 * Constante de endpoint API para agregar nuevos usuarios
	 * 
	 * Esta constante define el identificador del endpoint utilizado para operaciones 
	 * de creación de usuarios en el sistema API.
	 * 
	 * @const string API_UsuariosAdd El endpoint de API para agregar usuarios
	 */
	const API_UsuariosAdd = 'API_UsuariosAdd';
	/**
	 * Constante de endpoint API para modificaciones auxiliares de usuarios
	 * 
	 * Esta constante representa el identificador utilizado para el módulo API Helper de Usuarios
	 * que maneja modificaciones y operaciones relacionadas con usuarios
	 * 
	 * @const string API_UsuariosHelperMod El módulo de API para modificaciones auxiliares de usuarios
	 */
	const API_UsuariosHelperMod = 'API_UsuariosHelperMod';
	/**
	 * Constante que representa el endpoint de API para modificaciones de usuarios.
	 * Esta constante define la URL o identificador del endpoint de API utilizado
	 * para manejar solicitudes de modificación de usuarios.
	 * 
	 * @const string API_UsuariosMod El endpoint de API para modificar usuarios
	 */
	const API_UsuariosMod = 'API_UsuariosMod';
	/**
	 * Constante de endpoint API para eliminar usuarios
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado para 
	 * manejar operaciones de eliminación de usuarios en el sistema.
	 *
	 * @const string API_UsuariosRm El endpoint de API para eliminar usuarios
	 */
	const API_UsuariosRm = 'API_UsuariosRm';
	/**
	 * Constante de endpoint API para obtener datos auxiliares de usuarios
	 * 
	 * Esta constante define el identificador del endpoint utilizado para obtener
	 * información auxiliar de usuarios a través de la API.
	 * 
	 * @const string API_UsuariosHelperGet El endpoint de API para obtener datos auxiliares de usuarios
	 */
	const API_UsuariosHelperGet = 'API_UsuariosHelperGet';
	/**
	 * Constante de endpoint API para obtener datos de usuarios
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado
	 * para recuperar información de usuarios del sistema.
	 * 
	 * @const string API_UsuariosGet El endpoint de API para obtener datos de usuarios
	 */
	const API_UsuariosGet = 'API_UsuariosGet';
	/**
	 * Constante de endpoint API para obtener datos de usuarios vía AJAX
	 * 
	 * Esta constante define el identificador del endpoint de API utilizado 
	 * para recuperar información de usuarios mediante peticiones AJAX
	 * 
	 * @const string API_UsuariosGetAjax El endpoint de API para obtener datos de usuarios vía AJAX 
	 */
	const API_UsuariosGetAjax = 'API_UsuariosGetAjax';
	/**
	 * Constante de endpoint API para agregar ayudante administrativo.
	 * 
	 * Esta constante define el identificador del endpoint utilizado para operaciones 
	 * relacionadas con agregar nuevos registros de ayudantes administrativos en el sistema.
	 * 
	 * @const string API_AdminHelperAdd El endpoint de API para agregar ayudantes administrativos
	 */
	const API_AdminHelperAdd = 'API_AdminHelperAdd';
	/**
	 * Constante de endpoint API para agregar usuarios mini.
	 * 
	 * Se utiliza para identificar la ruta del endpoint para crear registros 
	 * simplificados de usuarios.
	 * 
	 * @const string API_UsuariosMiniAdd
	 */
	const API_UsuariosMiniAdd = 'API_UsuariosMiniAdd';
	/**
	 * Constante que define el endpoint de la API para usuarios con contraseña de administrador asignada.
	 * 
	 * Esta constante representa el identificador del endpoint utilizado para manejar
	 * usuarios que tienen asignadas credenciales administrativas.
	 * 
	 * @const string API_UsuariosClaveAsignadaAdmin El endpoint de API para usuarios con clave de administrador
	 */
	const API_UsuariosClaveAsignadaAdmin = 'API_UsuariosClaveAsignadaAdmin';
	/**
	 * Constante que representa el endpoint de API para asignación manual de contraseñas por el administrador.
	 * 
	 * Esta constante define el identificador del endpoint utilizado para gestionar las contraseñas 
	 * de usuarios que son asignadas manualmente por administradores del sistema.
	 * 
	 * @const string API_UsuariosClaveAsignadaAdminManual El endpoint de API para asignación manual de contraseñas de usuarios
	 */
	const API_UsuariosClaveAsignadaAdminManual = 'API_UsuariosClaveAsignadaAdminManual';

	// Cargadatos.phtml INI
	/**
	 * Constante de endpoint API para carga de archivos en la interfaz Cargadatos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para manejar
	 * operaciones de carga de archivos en la interfaz Cargadatos.phtml
	 * 
	 * @const string API_Cargadatos_Upload El endpoint de API para carga de archivos en Cargadatos
	 */

	const API_Cargadatos_Upload = 'API_Cargadatos_Upload';
	/**
	 * Constante de endpoint API para consultar servicios Bogdata
	 * 
	 * Esta constante define el identificador de endpoint utilizado para realizar
	 * solicitudes de consulta al servicio API Bogdata.
	 * 
	 * @const string API_Bogdata_Consultar El endpoint de API para consultar Bogdata
	 */
	const API_Bogdata_Consultar = 'API_Bogdata_Consultar';
	// Cargadatos.phtml FIN

	// Usuarios FIN

	// Codigoactiva INI
	/**
	 * Constante de endpoint API para obtener datos del código activa
	 * 
	 * Esta constante define el identificador del endpoint utilizado para 
	 * recuperar información del código de activación desde la API.
	 * 
	 * @const string API_CodigoactivaGet El endpoint de API para obtener código activa
	 */
	const API_CodigoactivaGet = 'API_CodigoactivaGet';
	/**
	 * Constante de endpoint API para agregar código activa
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de creación de códigos de activación en el sistema API.
	 * 
	 * @const string API_CodigoactivaAdd El endpoint de API para agregar código activa
	 */
	const API_CodigoactivaAdd = 'API_CodigoactivaAdd';
	/**
	 * Constante de endpoint API para agregar código activa en formato JSON Base64
	 * 
	 * Esta constante define el identificador del endpoint utilizado para 
	 * agregar códigos de activación codificados en Base64 a través de la API.
	 * 
	 * @const string API_CodigoactivaJson64Add El endpoint de API para agregar código activa en formato JSON Base64
	 */
	const API_CodigoactivaJson64Add = 'API_CodigoactivaJson64Add';
	// Codigoactiva FIN

	// Contrasena INI
	/**
	 * Constante que representa la clave API para contraseñas.
	 * 
	 * Se utiliza para propósitos de autenticación en comunicaciones API.
	 * 
	 * @const string API_Contrasena La clave API para contraseñas
	 */
	const API_Contrasena = 'API_Contrasena';
	// Contrasena FIN

	// Anyolectivo INI
	/**
	 * Constante de endpoint API para agregar un nuevo año académico.
	 * 
	 * Esta constante se utiliza para identificar el endpoint de la API responsable de
	 * manejar la creación de nuevos registros de año académico en el sistema.
	 * 
	 * @const string API_AnyolectivoAdd El endpoint de API para agregar año académico
	 */
	const API_AnyolectivoAdd = 'API_AnyolectivoAdd';
	// Anyolectivo FIN

	// Fotos de perfil INI
	/**
	 * Constante de endpoint API para subir fotos de perfil 
	 *
	 * Esta constante define el identificador del endpoint utilizado para 
	 * cargar/subir imágenes de perfil de usuario en el sistema
	 *
	 * @const string API_UpFotoPerfiles El endpoint de API para subir fotos de perfil
	 */
	const API_UpFotoPerfiles = 'API_UpFotoPerfiles';
	// Fotos de perfil FIN

	// Plantillas INI
	/**
	 * Constante de endpoint API para agregar plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de creación de plantillas en el sistema.
	 * 
	 * @const string API_plantillasAdd El endpoint de API para agregar plantillas
	 */
	const API_plantillasAdd = 'API_plantillasAdd';
	/**
	 * Constante de endpoint API para crear nuevas plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * inicializar nuevas plantillas en el sistema.
	 * 
	 * @const string API_plantillasNew El endpoint de API para nuevas plantillas
	 */
	const API_plantillasNew = 'API_plantillasNew';
	/**
	 * Constante de endpoint API para eliminar plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de eliminación de plantillas del sistema.
	 * 
	 * @const string API_plantillasDel El endpoint de API para eliminar plantillas
	 */
	const API_plantillasDel = 'API_plantillasDel';
	/**
	 * Constante de endpoint API para agregar mezclas de plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de combinación/mezcla de plantillas en el sistema.
	 * 
	 * @const string API_plantillasMixAdd El endpoint de API para agregar mezclas de plantillas
	 */
	const API_plantillasMixAdd = 'API_plantillasMixAdd';
	/**
	 * Constante de endpoint API para obtener mezclas de plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de plantillas mezcladas del sistema.
	 * 
	 * @const string API_plantillasMixGet El endpoint de API para obtener mezclas de plantillas
	 */
	const API_plantillasMixGet = 'API_plantillasMixGet';
	/**
	 * Constante de endpoint API para enviar mezclas de plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de envío de plantillas mezcladas en el sistema.
	 * 
	 * @const string API_plantillasMixSend El endpoint de API para enviar mezclas de plantillas
	 */
	const API_plantillasMixSend = 'API_plantillasMixSend';
	/**
	 * Constante de endpoint API para obtener variables auxiliares de mezclas de plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar variables auxiliares usadas en el proceso de mezcla de plantillas.
	 * 
	 * @const string API_plantillasMixVariablesHelperGet El endpoint de API para obtener variables auxiliares de mezclas
	 */
	const API_plantillasMixVariablesHelperGet = 'API_plantillasMixVariablesHelperGet';
	// Plantillas FIN

	// Firmas INI
	/**
	 * Constante de endpoint API para obtener firmas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de firmas digitales del sistema.
	 * 
	 * @const string API_FirmasGet El endpoint de API para obtener firmas
	 */
	const API_FirmasGet = 'API_FirmasGet';

	/**
	 * Constante de endpoint API para obtener vista previa de firmas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar la visualización preliminar de firmas digitales.
	 * 
	 * @const string API_FirmasPreviaGet El endpoint de API para previsualizar firmas
	 */
	const API_FirmasPreviaGet = 'API_FirmasPreviaGet';

	/**
	 * Constante de endpoint API para agregar configuración corporativa de firmas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * añadir configuraciones corporativas relacionadas con firmas digitales.
	 * 
	 * @const string API_FirmasAgregarConfigCorp_Add El endpoint de API para agregar config de firmas corporativas
	 */
	const API_FirmasAgregarConfigCorp_Add = 'API_FirmasAgregarConfigCorp_Add';

	/**
	 * Constante de endpoint API para obtener configuración corporativa de firmas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar configuraciones corporativas de firmas digitales.
	 * 
	 * @const string API_FirmasAgregarConfigCorp_Get El endpoint de API para obtener config de firmas corporativas
	 */
	const API_FirmasAgregarConfigCorp_Get = 'API_FirmasAgregarConfigCorp_Get';

	/**
	 * Constante de endpoint API para agregar ayudante de firmas profesionales
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares con firmas profesionales.
	 * 
	 * @const string API_FirmasproHelperAdd El endpoint de API para agregar helper de firmas pro
	 */
	const API_FirmasproHelperAdd = 'API_FirmasproHelperAdd';

	/**
	 * Constante de endpoint API para agregar certificados P12 de admin
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * agregar certificados P12 por parte del administrador.
	 * 
	 * @const string API_FirmasproAdminP12Add El endpoint de API para agregar certificados P12 admin
	 */
	const API_FirmasproAdminP12Add = 'API_FirmasproAdminP12Add';
	// Firmas FIN
	
	// Firmaslog INI
	/**
	 * Constante de endpoint API para obtener eventos del registro de firmas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar eventos y actividades relacionadas con el registro de firmas digitales.
	 * 
	 * @const string API_FirmaslogHelperEvent El endpoint de API para obtener log de eventos de firmas
	 */
	const API_FirmaslogHelperEvent = 'API_FirmaslogHelperEvent';
	// Firmaslog FIN
	
	// Firmascomentarios INI
	const API_FirmascomentariosHelperGet = 'API_FirmascomentariosHelperGet';
	const API_FirmascomentariosHelperAdd = 'API_FirmascomentariosHelperAdd';
	const API_FirmascomentariosHelperDel = 'API_FirmascomentariosHelperDel';
	// Firmascomentarios FIN
	
	// ApiBox INI
	/**
	 * Constante de endpoint API para obtener datos de ApiBox
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información y datos desde el servicio ApiBox del sistema.
	 * 
	 * @const string API_ApiboxGet El endpoint de API para obtener datos de ApiBox
	 */
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
	/**
	 * Constante de endpoint API para obtener requerimientos de plantillas vía AJAX
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar requerimientos de plantillas mediante peticiones AJAX.
	 * 
	 * @const string API_RequerimientostplsGetAjax El endpoint de API para obtener requerimientos de plantillas
	 */
	const API_RequerimientostplsGetAjax = 'API_RequerimientostplsGetAjax';
	/**
	 * Constante de endpoint API para agregar ayudante de requerimientos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de adición de requerimientos en el sistema.
	 * 
	 * @const string API_RequerimientosHelperAdd El endpoint de API para agregar helper de requerimientos
	 */
	const API_RequerimientosHelperAdd = 'API_RequerimientosHelperAdd';
	// requerimientos FIN

	// requerimientostplsitems INI
	/**
	 * Constante de endpoint API para obtener items auxiliares de requerimientos de plantillas
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar elementos auxiliares relacionados con los requerimientos de plantillas.
	 * 
	 * @const string API_RequerimientostplsitemsHelperGet El endpoint de API para obtener helper items de requerimientos
	 */
	const API_RequerimientostplsitemsHelperGet = 'API_RequerimientostplsitemsHelperGet';
	// requerimientostplsitems FIN

	// Flujos INI
	/**
	 * Constante de endpoint API para agregar ayudante de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de adición de flujos en el sistema.
	 * 
	 * @const string API_FlujosHelperAdd El endpoint de API para agregar helper de flujos
	 */
	const API_FlujosHelperAdd = 'API_FlujosHelperAdd';
	/**
	 * Constante de endpoint API para modificar estado de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * modificar estados en los flujos de trabajo del sistema.
	 * 
	 * @const string API_FlujosHelperEstadoMod El endpoint de API para modificar estados de flujos
	 */
	const API_FlujosHelperEstadoMod = 'API_FlujosHelperEstadoMod';
	/**
	 * Constante de endpoint API para obtener flujos vía AJAX
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de flujos mediante peticiones AJAX.
	 * 
	 * @const string API_FlujosGetAjax El endpoint de API para obtener flujos vía AJAX
	 */
	const API_FlujosGetAjax = 'API_FlujosGetAjax';
	// Flujos FIN

	// Flujositems INI
	/**
	 * Constante de endpoint API para obtener helper principal de items de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información auxiliar principal de los items de flujos.
	 * 
	 * @const string API_FlujositemsPrincipalHelperGet El endpoint de API para obtener helper principal de items
	 */
	const API_FlujositemsPrincipalHelperGet = 'API_FlujositemsPrincipalHelperGet';
	/**
	 * Constante de endpoint API para obtener items de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de los items de flujos en el sistema.
	 * 
	 * @const string API_FlujositemsGet El endpoint de API para obtener items de flujos
	 */
	const API_FlujositemsGet = 'API_FlujositemsGet';
	/**
	 * Constante de endpoint API para obtener helper de items de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información auxiliar de los items de flujos.
	 * 
	 * @const string API_FlujositemsHelperGet El endpoint de API para obtener helper de items
	 */
	const API_FlujositemsHelperGet = 'API_FlujositemsHelperGet';
	/**
	 * Constante de endpoint API para eliminar helper de items de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * manejar la eliminación de items de flujos en el sistema.
	 * 
	 * @const string API_FlujositemsHelperDel El endpoint de API para eliminar helper de items
	 */
	const API_FlujositemsHelperDel = 'API_FlujositemsHelperDel';
	/**
	 * Constante de endpoint API para obtener datos de revisión de items de flujos
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información relacionada con la revisión de los items de flujos.
	 * 
	 * @const string API_FlujositemsRevDtGet El endpoint de API para obtener datos de revisión de items
	 */
	const API_FlujositemsRevDtGet = 'API_FlujositemsRevDtGet';
	// Flujositems FIN

	// Paquetes INI
	/**
	 * Constante de endpoint API para obtener paquetes vía AJAX
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de paquetes mediante peticiones AJAX.
	 * 
	 * @const string API_PaquetesGetAjax El endpoint de API para obtener paquetes
	 */
	const API_PaquetesGetAjax = 'API_PaquetesGetAjax';
	/**
	 * Constante de endpoint API para obtener datos auxiliares de paquetes vía AJAX
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información auxiliar de paquetes mediante peticiones AJAX.
	 * 
	 * @const string API_PaquetesHelperGetAjax El endpoint de API para obtener helper de paquetes
	 */
	const API_PaquetesHelperGetAjax = 'API_PaquetesHelperGetAjax';
	/**
	 * Constante de endpoint API para mover paquetes a revisión
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * cambiar el estado de paquetes a revisión en el sistema.
	 * 
	 * @const string API_PaquetesHelperMoveReview El endpoint de API para mover paquetes a revisión
	 */
	const API_PaquetesHelperMoveReview = 'API_PaquetesHelperMoveReview';
	/**
	 * Constante de endpoint API para mover paquetes a administración
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * cambiar el estado de paquetes a administración en el sistema.
	 * 
	 * @const string API_PaquetesHelperMoveAdmin El endpoint de API para mover paquetes a administración
	 */
	const API_PaquetesHelperMoveAdmin = 'API_PaquetesHelperMoveAdmin';
	// Paquetes FIN

	// Paquetesrequ INI
	/**
	 * Constante de endpoint API para agregar ayudante de requerimientos de paquetes
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de adición de requerimientos en paquetes del sistema.
	 * 
	 * @const string API_PaquetesrequHelperAdd El endpoint de API para agregar helper de requerimientos de paquetes
	 */
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
	/**
	 * Constante de endpoint API para obtener lista de referencias
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de listas de referencia del sistema.
	 * 
	 * @const string API_ReflistaGet El endpoint de API para obtener listas de referencia
	 */
	const API_ReflistaGet = 'API_ReflistaGet';
	// Reflista FIN

	// Formularios INI
	/**
	 * Constante de endpoint API para obtener formularios vía AJAX
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de formularios mediante peticiones AJAX.
	 * 
	 * @const string API_FormulariosGetAjax El endpoint de API para obtener formularios vía AJAX
	 */
	const API_FormulariosGetAjax = 'API_FormulariosGetAjax';
	/**
	 * Constante de endpoint API para eliminar ayudante de formularios
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * manejar la eliminación de formularios en el sistema.
	 * 
	 * @const string API_FormulariosHelperDel El endpoint de API para eliminar helper de formularios
	 */
	const API_FormulariosHelperDel = 'API_FormulariosHelperDel';
	/**
	 * Constante de endpoint API para agregar ayudante de formularios
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de adición de formularios en el sistema.
	 * 
	 * @const string API_FormulariosHelperAdd El endpoint de API para agregar helper de formularios
	 */
	const API_FormulariosHelperAdd = 'API_FormulariosHelperAdd';
	/**
	 * Constante de endpoint API para obtener formularios
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de formularios en el sistema.
	 * 
	 * @const string API_FormulariosGet El endpoint de API para obtener formularios
	 */
	const API_FormulariosGet = 'API_FormulariosGet';
	// Formularios FIN

	// empleadosdetallescontrato INI
	/**
	 * Constante de endpoint API para agregar ayudante de detalles de contrato de empleados
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de adición de detalles de contrato de empleados.
	 * 
	 * @const string API_empleadosdetallescontrato_Helper_Add El endpoint de API para agregar helper de detalles de contrato
	 */
	const API_empleadosdetallescontrato_Helper_Add = 'API_empleadosdetallescontrato_Helper_Add';
	/**
	 * Constante de endpoint API para obtener detalles de contrato de empleados
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información de detalles de contrato de empleados del sistema.
	 * 
	 * @const string API_empleadosdetallescontrato_Get El endpoint de API para obtener detalles de contrato de empleados
	 */
	const API_empleadosdetallescontrato_Get = 'API_empleadosdetallescontrato_Get';
	// empleadosdetallescontrato FIN

	// HomeCtrls INI
	// --Version2
	/**
	 * Constante de endpoint API para agregar ayudante de paquetes en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de adición de paquetes en la página de inicio.
	 * 
	 * @const string API_PaquetesHomeHelperAdd El endpoint de API para agregar helper de paquetes en home
	 */
	const API_PaquetesHomeHelperAdd = 'API_PaquetesHomeHelperAdd';
	/**
	 * Constante de endpoint API para agregar ayudante de registro administrativo de paquetes
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones auxiliares de registro administrativo de paquetes en el sistema.
	 * 
	 * @const string API_PaquetesAdminReg_Helper_Add El endpoint de API para agregar helper de registro admin de paquetes
	 */
	const API_PaquetesAdminReg_Helper_Add = 'API_PaquetesAdminReg_Helper_Add';

	// --Version1
	/**
	 * Constante de endpoint API para recuperar información de usuario en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar datos de usuarios desde la página de inicio.
	 * 
	 * @const string API_Home_RecuperaUsuario El endpoint de API para recuperar usuarios en home
	 */
	const API_Home_RecuperaUsuario = 'API_Home_RecuperaUsuario';
	/**
	 * Constante de endpoint API para solicitar token en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * solicitar tokens de autenticación desde la página de inicio.
	 * 
	 * @const string API_Home_SolicitarTkn El endpoint de API para solicitar tokens en home
	 */
	const API_Home_SolicitarTkn = 'API_Home_SolicitarTkn';
	/**
	 * Constante de endpoint API para login en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de autenticación desde la página de inicio.
	 * 
	 * @const string API_Home_Login El endpoint de API para login en home
	 */
	const API_Home_Login = 'API_Home_Login';
	/**
	 * Constante de endpoint API para login como otro usuario en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * funcionalidad de suplantación de usuarios desde la página de inicio.
	 * 
	 * @const string API_Home_LoginAs El endpoint de API para login como otro usuario en home
	 */
	const API_Home_LoginAs = 'API_Home_LoginAs';
	/**
	 * Constante de endpoint API para obtener perfil en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * recuperar información del perfil de usuario desde la página de inicio.
	 * 
	 * @const string API_MiPerfilHomeGet El endpoint de API para obtener perfil en home
	 */
	const API_MiPerfilHomeGet = 'API_MiPerfilHomeGet';
	/**
	 * Constante de endpoint API para agregar contraseña de alumno en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de adición de contraseñas de alumnos desde la página de inicio.
	 * 
	 * @const string API_Home_AlumnoPassAdd El endpoint de API para agregar contraseña de alumno en home
	 */
	const API_Home_AlumnoPassAdd = 'API_Home_AlumnoPassAdd';
	/**
	 * Constante de endpoint API para cambio de contraseña en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de cambio de contraseña desde la página de inicio.
	 * 
	 * @const string API_ContrasenaHome El endpoint de API para cambio de contraseña en home
	 */
	const API_ContrasenaHome = 'API_ContrasenaHome';
	/**
	 * Constante de endpoint API para registro de empleados en página principal
	 * 
	 * Esta constante define el identificador del endpoint utilizado para
	 * operaciones de registro de empleados desde la página de inicio.
	 * 
	 * @const string API_Home_Empleado_Registro El endpoint de API para registro de empleados en home
	 */
	const API_Home_Empleado_Registro = 'API_Home_Empleado_Registro';
	// HomeCtrls FIN

	// Mascaras descarga
	/**
	 * Constante de máscara para campo de repositorio de anexos
	 * 
	 * Esta constante define la máscara utilizada para identificar
	 * y procesar campos relacionados con el repositorio de anexos.
	 * 
	 * @const string MASK_FLD_REPO_ANEXOS La máscara para repositorio de anexos
	 */
	const MASK_FLD_REPO_ANEXOS = 'MASK_FLD_REPO_ANEXOS';
	/**
	 * Constante de máscara para campo de repositorio de procesos
	 * 
	 * Esta constante define la máscara utilizada para identificar
	 * y procesar campos relacionados con el repositorio de procesos.
	 * 
	 * @const string MASK_FLD_REPO_PROCESOS La máscara para repositorio de procesos
	 */
	const MASK_FLD_REPO_PROCESOS = 'MASK_FLD_REPO_PROCESOS';
	
	/**
	 * Constructor para la clase IndexCtrl
	 * 
	 * Este método maneja todas las operaciones de envío de datos (POST, GET, REQUEST) y controla:
	 * - Gestión y validación de sesiones de usuario
	 * - Enrutamiento de endpoints de API REST 
	 * - Control de acceso y seguridad
	 * - Descargas de archivos (CSV, PDF)
	 * - Manejo de peticiones AJAX para múltiples operaciones como:
	 *   - Autenticación y login de usuarios
	 *   - Gestión de instituciones
	 *   - Gestión de empleados
	 *   - Gestión de usuarios  
	 *   - Configuración de ajustes
	 *   - Gestión de plantillas
	 *   - Firmas digitales
	 *   - Gestión de flujos de trabajo
	 *   - Gestión de paquetes
	 *   - Gestión de formularios
	 *   - Gestión de perfiles
	 * 
	 * También maneja la expiración de sesiones, validación del estado del usuario y control de acceso de seguridad.
	 */
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
				
				// TODO: Tarea 77 - Agregar controlador de enrutamiento para Firmascomentarios
				// firmascomentarios INI
				if ($_POST["ajax"] == md5(self::API_FirmascomentariosHelperGet)) {
				    try {
				        $ok = OperacionesCtrl::firmascomentarios_Helper_Obtener( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_FirmascomentariosHelperAdd)) {
				    try {
				        $ok = OperacionesCtrl::firmascomentarios_Helper_Agregar( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				if ($_POST["ajax"] == md5(self::API_FirmascomentariosHelperDel)) {
				    try {
				        $ok = OperacionesCtrl::firmascomentarios_Helper_Eliminar( $_POST );
				        echo json_encode($ok);
				    } catch (Exception $ex) {
				        $er = array("err" => $ex->getMessage());
				        echo json_encode($er);
				    }
				    die("");
				}
				// firmascomentarios FIN
				
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

	/**
	 * Genera un nombre JavaScript único basado en el host de la URL base.
	 * 
	 * Este método crea un identificador JavaScript estandarizado mediante:
	 * 1. Obtener la URL base de la aplicación
	 * 2. Analizar la URL para extraer el componente host
	 * 3. Eliminar puntos del nombre del host  
	 * 4. Agregar el prefijo 'acpp_admin_'
	 * 
	 * @return string El nombre JavaScript generado en formato 'acpp_admin_[hostname]'
	 */
	public static function JS_Name_get()
	{
		$array = parse_url(Utiles::getBaseUrl());
		$n = 'acpp_admin_' . str_replace(".", "", $array['host']);
		return $n;
	}

	/**
	 * Renderiza un controlador cargando y ejecutando su archivo correspondiente.
	 * 
	 * Este método toma una ruta de vista e intenta encontrar y ejecutar su controlador asociado.
	 * Si existe un controlador, lo instancia y renderiza. De lo contrario, incluye la vista directamente.
	 * 
	 * @param string $rutaVista La ruta al archivo de vista
	 * @return mixed|void Retorna el objeto controlador si se encuentra y renderiza, void en caso contrario
	 * 
	 * @throws Exception Si no se puede instanciar la clase controladora
	 * 
	 * El método sigue estos pasos:
	 * 1. Extrae el nombre de archivo de la ruta de vista 
	 * 2. Construye la ruta del archivo controlador
	 * 3. Si existe el controlador:
	 *    - Incluye el archivo controlador
	 *    - Instancia la clase controladora
	 *    - Llama al método render()
	 *    - Retorna el objeto controlador
	 * 4. Si no existe controlador:
	 *    - Incluye el archivo de vista directamente
	 */
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

	/**
	 * Renderiza la estructura principal de la página y maneja el flujo de autenticación de usuarios
	 * 
	 * Este método controla el proceso de renderización de páginas incluyendo:
	 * - Inicialización de sesión
	 * - Renderización del encabezado
	 * - Verificación de autenticación y manejo de login/logout
	 * - Carga dinámica del contenido de la página basado en el parámetro pageid
	 * - Procesamiento del formulario de login
	 * - Renderización del pie de página
	 * 
	 * El flujo incluye:
	 * 1. Iniciar sesión si no está iniciada
	 * 2. Renderizar plantilla de encabezado  
	 * 3. Si el usuario está autenticado:
	 *    - Maneja solicitudes de logout
	 *    - Carga la página solicitada o workspace por defecto
	 * 4. Si el usuario no está autenticado:
	 *    - Procesa intentos de login
	 *    - Muestra página de login
	 * 5. Renderiza pie de página y cierra estructura HTML
	 * 
	 * @return void
	 * 
	 * @throws Exception Cuando hay un error al registrar datos de usabilidad
	 */
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