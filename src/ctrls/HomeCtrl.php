
<?php
/**
 * HomeCtrl - Clase controladora para manejar la página de inicio y funcionalidad de enrutamiento
 * 
 * Esta clase extiende Pagina y gestiona el enrutamiento principal, autenticación y operaciones 
 * de renderizado para la página de inicio y funcionalidades relacionadas de la aplicación.
 * 
 * Responsabilidades principales:
 * - Maneja peticiones REST API
 * - Gestiona autenticación externa
 * - Controla enrutamiento y renderizado de páginas
 * - Genera espacio de nombres JavaScript
 * 
 * Constantes:
 * - REPO_ARCHIVOS: Ruta del repositorio
 * - API_RegEventos: Endpoint de API para registro de eventos
 * - API_LoginAjaxUsr: Endpoint de API para login AJAX de usuarios
 * 
 * Características principales:
 * - Manejo de peticiones REST API a través de PATH_INFO
 * - Procesamiento de autenticación externa vía AJAX
 * - Enrutamiento dinámico de páginas basado en parámetros URL
 * - Renderizado de plantillas con manejo de errores
 * - Gestión e inicialización de sesiones
 * 
 * La clase sirve como controlador principal para la funcionalidad de inicio de la aplicación,
 * centralizando la lógica de enrutamiento y gestión de plantillas mientras proporciona
 * capacidades de integración con API.
 * 
 * @package GesFinanciero
 * @extends Pagina
 * @see Rest
 * @see OperacionesHomeCtrl
 * @see Config
 */
class HomeCtrl extends Pagina {
    
    const REPO_ARCHIVOS = "repo";
    const API_RegEventos = 'Api/RegEventos';
    const API_LoginAjaxUsr = 'Api/LoginAjaxUsr';
    
    /**
     * Constructor de la clase HomeCtrl
     * 
     * Este constructor maneja varias tareas de inicialización:
     * 1. Centraliza todas las operaciones de transmisión de datos (POST, GET, REQUEST)
     * 2. Procesa peticiones REST API si PATH_INFO está establecido
     * 3. Maneja autenticación externa a través de peticiones AJAX
     * 
     * El constructor realiza las siguientes operaciones:
     * - Carga el archivo OperacionesCtrl.php
     * - Verifica peticiones REST API y las procesa usando Rest::handler()
     * - Procesa peticiones de autenticación externa a través de POST["ajax"]
     * 
     * @throws Exception Si hay un error durante la autenticación externa
     */

    public function __construct(){
        // Aquí se centralizan todas las operaciones de envío de datos: POST, GET ó REQUEST
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        $this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
        
        // Api REST
        if ( isset( $_SERVER['PATH_INFO'] ) ){
            $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
            $this->renderCtrl($url_baseCtrls . "Rest.php");
            Rest::handler();            
            die("");
        }
        
        if( isset( $_POST ) ){
            
            if( isset( $_POST["ajax"] ) ){
                if( $_POST["ajax"] == md5( "Api/IntegraAutentica" ) ){
                    try{
                        $ok = OperacionesHomeCtrl::LoginFromExterno( $_POST );
                        echo json_encode($ok);
                    }catch (Exception $ex){
                        $er = array("err" => $ex->getMessage());
                        echo json_encode($er);
                    }
                    die("");
                }
            }
        }
        
    }
    
    /**
     * Genera un espacio de nombres JavaScript único basado en la URL del host.
     * 
     * Este método estático crea un identificador con espacio de nombres mediante:
     * 1. Obtención de la URL base de la aplicación
     * 2. Extracción del componente host
     * 3. Eliminación de puntos del nombre del host
     * 4. Añadiendo el prefijo 'acpp_'
     * 
     * @return string El nombre del espacio de nombres JavaScript generado
     * @example Si el host es "example.com", devuelve "acpp_examplecom"
     */
    public static function JS_Name_get(){
        $array=parse_url( Utiles::getBaseUrl() );
        $n = 'acpp_' . str_replace( ".", "", $array['host'] ) ;
        return $n;
    }
    
    /**
     * Renderiza un controlador o una vista basada en la ruta proporcionada
     * 
     * Este método intenta cargar y renderizar una clase controladora correspondiente a la ruta de la vista.
     * Si el controlador existe, lo instancia y renderiza. De lo contrario, incluye la vista directamente.
     *
     * @param string $rutaVista La ruta al archivo de vista
     * @return void
     *
     * @throws Exception Si la clase controladora no puede ser instanciada
     * 
     * El método sigue estos pasos:
     * 1. Extrae el nombre del archivo de la ruta de la vista
     * 2. Construye la ruta del controlador añadiendo 'Ctrl.php' al nombre del archivo
     * 3. Si el controlador existe, lo carga e instancia, luego llama a su método render
     * 4. Si el controlador no existe, incluye el archivo de vista directamente
     */

    private function renderCtrl( $rutaVista ){
        $vista = pathinfo( $rutaVista );
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        $rutaCtrl = $url_baseCtrls . $vista[ 'filename' ] . "Ctrl.php";
        if( file_exists( $rutaCtrl ) ){
            include_once $rutaCtrl;
            $tmpNombreClase = $vista[ 'filename' ] . "Ctrl";
            $rutaCtrl = new $tmpNombreClase();
            $rutaCtrl->render();
        }else{
            include_once $rutaVista;
        }
    }
    
    /**
     * Renderiza la página de inicio y maneja el enrutamiento de páginas basado en parámetros URL.
     * 
     * Este método realiza las siguientes tareas:
     * - Inicializa la sesión si no está iniciada
     * - Configura las rutas base para los archivos de plantilla
     * - Incluye la plantilla del encabezado
     * - Maneja el enrutamiento de páginas según el parámetro 'pageid':
     *   - Si existe pageid, valida y carga la página solicitada
     *   - Si la página no existe, muestra página de error
     *   - Si pageid es workspace home, carga plantilla de workspace
     *   - Si no hay pageid, usa workspace home por defecto
     * - Incluye plantilla de pie de página y cierra etiquetas HTML
     *
     * @return void
     * @throws Ninguna pero puede incluir plantilla de error si no encuentra la página
     */

    public function render(){
        if(!isset($_SESSION)){
            session_start();
        }
        
        $url_base = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "tpls" . DIRECTORY_SEPARATOR ;
        $url_home = $url_base . "home" . DIRECTORY_SEPARATOR;
        include_once $url_home . "Encabezadohome.phtml" ;
        
        if( isset( $_REQUEST["pageid"] ) ){
            $urlp = $_REQUEST["pageid"];
            
            $rutaVista = $url_base . $urlp;
            if( $_REQUEST["pageid"] != Config::PAGINA_WORKSPACE_HOME ){
                
                if( file_exists($url_base . "modelos/" . $urlp)){
                    $this->setMensaje("P&aacute;gina no existente!");
                    $this->renderCtrl( $url_home . Config::PAGINA_ERROR );
                }
                else{
                    if( file_exists($rutaVista) ){
                        $this->renderCtrl( $rutaVista );
                    }else{
                        $this->setMensaje("P&aacute;gina no existente!");
                        $this->renderCtrl( $url_home . Config::PAGINA_ERROR );
                    }
                }
                
            }else{
                $rutaVista = $url_home . Config::PAGINA_WORKSPACE_HOME;
                $this->renderCtrl( $rutaVista );
            }
            
        }else{
            $rutaVista = $url_home . Config::PAGINA_WORKSPACE_HOME;
            $this->renderCtrl( $rutaVista );
        }
        
        $this->renderCtrl( $url_home . Config::PAGINA_PIE_HOME );
        
        echo "	\n";
        echo "	</body>\n";
        echo "</html>";
    } 
}
?>