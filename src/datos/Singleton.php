<?php

/**
 * Singleton de conexi&oacute;n
 * @author yalfonso
 *
 */
class Singleton {
	
	public static $lnk;
	
	/**
	 * Constructor del singleton de conexión MySQL.
	 *
	 * Inicializa la conexión mysqli única (self::$lnk) si no existe y devuelve la instancia.
	 * Si no se pasan parámetros, toma los valores por defecto desde Corporation.
	 *
	 * @param string $host Host de la base de datos (opcional).
	 * @param string $db   Nombre de la base de datos (opcional).
	 * @param string $uname Usuario de la base de datos (opcional).
	 * @param string $pass Contraseña de la base de datos (opcional).
	 * @return \mysqli|null Instancia de mysqli conectada o null en caso de fallo.
	 */
	function __construct($host='',$db='',$uname='',$pass=''){
		if( !self::$lnk ){
		    include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "corp" . DIRECTORY_SEPARATOR . "Corporation.php";
		    
		    $_host = (strlen(trim($host)) > 0 ? '' : Corporation::HOST);
		    $_uname = (strlen(trim($uname)) > 0 ? '' : Corporation::DBUSER);
		    $_pass = (strlen(trim($pass)) > 0 ? '' : Corporation::DBPASS);
		    $_db = (strlen(trim($db)) > 0 ? '' : Corporation::DBNAME);
			
			self::$lnk = new mysqli($_host, $_uname, $_pass, $_db);
			if (self::$lnk->connect_errno) {
			    echo "Failed to connect to MySQL: (" . self::$lnk->connect_errno . ") " . self::$lnk->connect_error;
			}else{
				return self::$lnk;
			}
		}else{
			return self::$lnk;
		}
	}
	
	/**
	 * Convierte un arreglo de objetos en una tabla de referencia asociativa.
	 *
	 * @param array  $arreglo     Arreglo de objetos.
	 * @param string $campoId     Método a invocar en cada objeto para obtener la clave (por defecto "getId").
	 * @param string $campoValor  Método a invocar en cada objeto para obtener el valor (por defecto "getNombre").
	 * @return array Tabla asociativa con id => valor.
	 */
	public static function _arrayToTableReference($arreglo, $campoId = "getId", $campoValor = "getNombre"){
		$tablaReferencia = array();
		foreach ($arreglo as $key => $value) {
			$tablaReferencia[ $value->$campoId() ] = $value->$campoValor();
		}
		return $tablaReferencia;
	}
	
	/**
	 * Obtiene los nombres de las columnas (metadatos) de la primera fila de una tabla.
	 *
	 * Ejecuta un SELECT * LIMIT 1 sobre la tabla indicada y devuelve un array
	 * asociativo donde las claves y los valores son los nombres de los campos.
	 * En caso de error retorna un array con la clave "err_info" y el mensaje de error.
	 *
	 * @param string $tb Nombre de la tabla.
	 * @return array Array con los nombres de las columnas o ['err_info' => 'mensaje'] en caso de fallo.
	 */
	public static function _metaDatos( $tb ){
		$s = new Singleton();
		$stmt = null;
		$result = array();
		$query = 'SELECT * FROM ' . strtolower($tb) . ' limit 1;';
		if ($stmt = self::$lnk->prepare($query)) {
			$stmt->execute();
			
			$meta = $stmt->result_metadata(); 
			while ($field = $meta->fetch_field()) {
				$result[ $field->name ] = $field->name;
			} 
			
			$stmt->close();
		}else{
			$result["err_info"] = self::$lnk->error;
			return $result;
		}
		return $result;
	}
	
	const SQLTP_TINYINT        = 'tinyint';
	const SQLTP_INT            = 'int';
	const SQLTP_BIGINT         = 'bigint';
	const SQLTP_DATE           = 'date';
	const SQLTP_DATETIME       = 'datetime';
	const SQLTP_DECIMAL        = 'json';
	const SQLTP_JSON           = 'decimal';
	const SQLTP_TEXT           = 'text';
	const SQLTP_VARCHAR        = 'varchar';

	/**
	 * Obtiene metadatos de las columnas de una tabla de la base de datos.
	 *
	 * Realiza un SELECT limitado a 1 fila sobre la tabla indicada (convertida a minúsculas)
	 * y devuelve un arreglo asociativo por nombre de columna con información:
	 *  - 'nombre' => nombre de la columna
	 *  - 'tipoid' => identificador numérico del tipo MySQL
	 *  - 'tipo'   => tipo mapeado a constantes internas (SQLTP_...)
	 *  - 'largo'  => longitud del campo
	 *
	 * En caso de error devuelve un arreglo con la clave 'err_info' con el mensaje de error.
	 *
	 * @param string $tb Nombre de la tabla a inspeccionar.
	 * @return array Arreglo asociativo de metadatos por columna o ['err_info' => string] en error.
	 */
	public static function _metaDatosPlus( $tb ){
	    new Singleton();
	    
	    $tipos = array(
	        '1'        => self::SQLTP_TINYINT
	        ,'3'       => self::SQLTP_INT
	        ,'8'       => self::SQLTP_BIGINT
			,'10'      => self::SQLTP_DATE
	        ,'12'      => self::SQLTP_DATETIME
	        ,'245'     => self::SQLTP_JSON
	        ,'246'     => self::SQLTP_DECIMAL
	        ,'252'     => self::SQLTP_TEXT
	        ,'253'     => self::SQLTP_VARCHAR
	    );

	    $stmt = null;
	    $result = array();
	    $query = 'SELECT * FROM ' . strtolower($tb) . ' limit 1;';
	    if ($stmt = self::$lnk->prepare($query)) {
	        $stmt->execute();
	        
	        $meta = $stmt->result_metadata();
	        while ($field = $meta->fetch_field()) {
	            $result[ $field->name ] = array( 'nombre' => $field->name, 'tipoid' => $field->type, 'tipo' => $tipos[ $field->type ], 'largo' => $field->length );
	        }
			
	        $stmt->close();
	    }else{
	        $result["err_info"] = self::$lnk->error;
	        return $result;
	    }
	    return $result;
	}
	
	/**
	 * Obtiene una lista que contiene una nueva lista con los datos de la consulta
	 * @param ver Campos que quiere ver, ejemplo "ID, COUNT(ID)"
	 * @param extras filtros en SQL, ejemplo: "Where id > 1 AND id < 3"
	 * @return array, retorna un arreglo de datos
	 */
	public static function _readInfo($tb, $ver = "*", $extra = "") {
		$s = new Singleton();
		$fnName = "getId";
		$_id = 1;
		
		$result = array();
		$params = array();
		
		if( $_id > 0 ){
			$stmt = null;
			
			$query = "SELECT " . $ver . " FROM " . $tb . " " . $extra;
			if( $stmt = self::$lnk->prepare($query) ){
				$stmt->execute();
				    
				$meta = $stmt->result_metadata(); 
				while ($field = $meta->fetch_field()) {
					$params[] = &$row[ $field->name ]; 
				}
				call_user_func_array(array($stmt, 'bind_result'), $params); 
				    
				while ($stmt->fetch()) {
				    foreach($row as $key => $val) {
				        $c[$key] = mb_convert_encoding($val, "utf8");
				    } 
					$result[] = $c;			        
				} 
	
				$stmt->close();
			}else{
				$result["err_info"] = self::$lnk->error;
				return $result;
			}
		}
		
		
		return $result;
		
	}
	
	/**
	 * Obtiene una lista que contiene una nueva lista con los datos de la consulta y permite indicar el juego de caracteres 
	 * @param string $tb Nombre de la tabla
	 * @param string $ver Campos que quiere ver, ejemplo "ID, COUNT(ID)"
	 * @param string $extra filtros en SQL, ejemplo: "Where id > 1 AND id < 3"
	 * @param string $desdeChar Si solo modificamos este parametro, entonces el juego de caracteres se cambia automaticamente a este valor
	 * @param string $hasta Si llenamos este parametro, estamos indicando desde donde queremos cambiarlo y ha donde vamos a dejarlo
	 * @return string[]|NULL[]
	 */
	public static function _readInfoChar($tb, $ver = "*", $extra = "", $desdeChar = "utf8", $hasta = "") {
	    $s = new Singleton();
	    $fnName = "getId";
	    $_id = 1;
	    
	    $result = array();
	    $params = array();
	    
	    if( $_id > 0 ){
	        $stmt = null;
	        
	        $query = "SELECT " . $ver . " FROM " . $tb . " " . $extra;
	        if( $stmt = self::$lnk->prepare($query) ){
	            $stmt->execute();
	            
	            $meta = $stmt->result_metadata();
	            while ($field = $meta->fetch_field()) {
	                $params[] = &$row[ $field->name ];
	            }
	            call_user_func_array(array($stmt, 'bind_result'), $params);
	            
	            while ($stmt->fetch()) {
	                foreach($row as $key => $val) {
	                    if( $desdeChar == ""){
	                        $c[$key] = $val;
	                    }
	                    else{
	                        if( $hasta == "" ){
	                            $c[$key] = mb_convert_encoding($val, $desdeChar);
	                        }
	                        else {
	                            $c[$key] = mb_convert_encoding($val, $desdeChar, $hasta);
	                        }
	                    }
	                }
	                $result[] = $c;
	            }
	            
	            $stmt->close();
	        }else{
	            $result["err_info"] = self::$lnk->error;
	            return $result;
	        }
	    }
	    
	    
	    return $result;
	    
	}
	
	/**
	 * Elimina registros de la tabla indicada construyendo y ejecutando una sentencia DELETE.
	 *
	 * @param string $tb    Nombre de la tabla (se convierte a minúsculas).
	 * @param string $extra Cláusulas adicionales para la consulta (por ejemplo WHERE).
	 * @return bool         True si la eliminación fue exitosa.
	 * @throws Exception    Si ocurre un error al ejecutar la consulta.
	 */
	public static function _classicDelete($tb, $extra){
	    $s = new Singleton();
	    $query = "DELETE FROM " . strtolower( $tb ) . " " . $extra;
	    
	    try {
	        $result = $s::$lnk->query($query);
	        if ($result === TRUE) {
	            return true;
	        } else {
	            throw new Exception($s::$lnk->error);
	        }
	    } catch (Exception $e) {
	        throw new Exception( $e->getMessage() );
	    }
	}
	
	/**
	 * Actualiza registros en la tabla indicada construyendo y ejecutando una consulta UPDATE.
	 *
	 * @param string $tb    Nombre de la tabla (se convierte a minúsculas).
	 * @param string $set   Cláusula SET (ej. "campo='valor'").
	 * @param string $extra Texto adicional para la consulta (ej. "WHERE id=1").
	 * @return bool         Devuelve true si la actualización fue exitosa.
	 * @throws Exception    Lanza excepción con el error de la conexión si falla la consulta.
	 */
	public static function _classicUpdate($tb, $set, $extra){
	    $s = new Singleton();
	    $query = "UPDATE " . strtolower( $tb ) . " set " . $set . " " . $extra;
	    
	    try {
	        $result = $s::$lnk->query($query);
	        if ($result === TRUE) {
	            return true;
	        } else {
	            throw new Exception($s::$lnk->error);
	        }
	    } catch (Exception $e) {
	        throw new Exception( $e->getMessage() );
	    }
	    return false;
	}
	
	/**
	 * Realiza un SELECT sobre la tabla indicada usando el Singleton y devuelve
	 * todas las filas como un arreglo asociativo.
	 *
	 * @param string $tb    Nombre de la tabla.
	 * @param string $ver   Columnas a seleccionar (por defecto "*").
	 * @param string $extra Cláusulas SQL adicionales (WHERE, ORDER BY, etc.).
	 * @return array        Arreglo de filas asociativas (vacío si no hay resultados).
	 */
	public static function _classicReadInfo($tb, $ver = "*", $extra = ""){
	    $s = new Singleton();
	    $query = "SELECT " . strtolower( $ver ) . " FROM " . strtolower( $tb ) . " " . $extra;
	    $result = $s::$lnk->query($query);
	    
	    $rows = array();
	    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	        $rows[] = $row;
	    }
	    $s::$lnk->close();
	    
	    return $rows;
	}
	
	/**
	 * Inserta uno o varios registros mediante una consulta INSERT construida manualmente.
	 *
	 * Construye y ejecuta "INSERT INTO <tabla> <campos> <valores>" usando la conexión singleton.
	 *
	 * @param string $tb  Nombre de la tabla (se convierte a minúsculas).
	 * @param string $vls Cadena con la cláusula VALUES o los valores a insertar.
	 * @param string $fld Opcional. Lista de campos (ej. "(col1,col2)").
	 * @return bool Devuelve true si la consulta se ejecutó correctamente.
	 * @throws Exception Si ocurre un error en la ejecución, lanza la excepción con el mensaje de la conexión.
	 */
	public static function _classicInsertMultiQuery($tb, $vls, $fld = ""){
	    $s = new Singleton();
	    $query = "INSERT INTO " . strtolower( $tb ) . " " . $fld . " " . $vls;

	    try {
	        $result = $s::$lnk->query($query);
	        if ($result === TRUE) {
	            return true;
	        } else {
	            throw new Exception($s::$lnk->error);
	        }
	    } catch (Exception $e) {
	        throw new Exception( $e->getMessage() );
	    }
	}
	
	/**
	 * Inserta una fila en la tabla indicada mediante una consulta INSERT construida.
	 *
	 * @param string $tb  Nombre de la tabla (se convierte a minúsculas).
	 * @param string $vls Cadena con los valores para VALUES (ej. "(1,'texto')").
	 * @param string $fld Campos opcionales a insertar (ej. "(id,nombre)").
	 * @return bool Devuelve true si la inserción fue exitosa.
	 * @throws Exception Si la consulta falla, se lanza la excepción con el error.
	 */
    public static function _classicInsertUniqQuery($tb, $vls, $fld = ""){
        $s = new Singleton();
        $query = "INSERT INTO " . strtolower( $tb ) . " " . $fld . " VALUES " . $vls;
        
        try {
            $result = $s::$lnk->query($query);
            if ($result === TRUE) {
                return true;
            } else {
                throw new Exception($s::$lnk->error);
            }
        } catch (Exception $e) {
            throw new Exception( $e->getMessage() );
        }
	}
	
	/**
	 * Genera archivos de modelo y vistas a partir de las tablas de la base de datos.
	 *
	 * Lee las tablas del esquema configurado, crea las carpetas temporales (tmpmodelo y tmpvistas)
	 * y escribe para cada tabla una clase PHP (modelo) y su plantilla PHTML (formulario). 
	 * Si $jsMenu es true, en lugar de escribir archivos imprime las líneas para agregar entradas al menú JS.
	 *
	 * @param bool $jsMenu Opcional. Si es true solo imprime las líneas de menú JS; por defecto false.
	 * @return void
	 */
	public static function _modelos($jsMenu = false){
		include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "corp" . DIRECTORY_SEPARATOR . "Corporation.php";
		$_db = Corporation::DBNAME;

		$actualPath = dirname(__FILE__);
		$tmpFold = $actualPath . DIRECTORY_SEPARATOR . "tmpmodelo";
		$tmpFlHtml = $actualPath . DIRECTORY_SEPARATOR . "tmpvistas";
		echo "dir: " . $tmpFold . "<br />";
		$okDir = @mkdir($tmpFold, "0777");
		$okDirHtml = @mkdir($tmpFlHtml, "0777");
		
		if( file_exists( $tmpFold ) ){

			$r = self::_readInfo("INFORMATION_SCHEMA.TABLES", "*", "where TABLE_SCHEMA like '" . $_db . "'");
			foreach ($r as $id => $vl) {
				$tb = $vl["TABLE_NAME"];
				$md = self::_metaDatos($tb);
				
				$clase = self::toCap( $tb );
				$flname = $clase;
				
				$elHtml = "";
				$txt = "<?php \n";
				
				$txt .= "/**\n";
	 			$txt .= " *\n";
	 			$txt .= " * @author yalfonso\n";
	 			$txt .= " *\n";
	 			$txt .= " */\n";
				$txt .= "class " . $clase . " extends Clsdatos { \n\n";
				foreach ($md as $value) {
					$vlDef = "\"\"";
					$vlToL = strtolower($value);
					
					$vlHtml = "<input type=\"text\" name=\"" . $vlToL . "[]\" id=\"" . $vlToL . "_x\" class=\"camposEntrada\">";
					if (Utiles::TerminaEn($value, "id")) {
						$vlDef = "0";
						$vlHtml = "Lista datos";
					}
					
					
					$txt .= "\tprivate \$" . $vlToL . " = " . $vlDef . "; \n";
					
					$elHtml .= "		<table border=\"0\" class=\"tbComun\"> \n";
					$elHtml .= "			<tbody> \n";
					$elHtml .= "				<tr> \n";
					$elHtml .= "					<th><label for=\"" . $vlToL . "_x\">" . self::toCap($value) . "</label></th> \n";
					$elHtml .= "					<td>" . $vlHtml . "</td> \n";
					$elHtml .= "				</tr> \n";
					$elHtml .= "			</tbody> \n";
					$elHtml .= "		</table> \n";
					
				}
				
				$txt .= "\n";
				$elHtmlT = "<form id=\"frmData\" action=\"./\" method=\"post\" > \n";
				$elHtmlT .= "	<div> \n";
				$elHtmlT .= $elHtml;
				$elHtmlT .= "\n	</div> \n";
				
				$elHtmlPHPInf  = "	<input type=\"hidden\" name=\"id[]\" id=\"id_x\" value=\"\" /> \n";
				$elHtmlPHPInf .= "	<input type=\"hidden\" name=\"pageid\" value=\"modelos/<?php echo basename( __FILE__ ); ?>\" /> \n";
				$elHtmlPHPInf .= "	<input type=\"hidden\" name=\"jsmenuid\" value=\"<?php echo \$_POST[ \"jsmenuid\" ]; ?>\" /> \n";
				$elHtmlPHPInf .= "	<input class=\"boton_guardar\" type=\"submit\" name=\"cmd\" value=\"Guardar " . $flname . "\" /> \n";
				
				$elHtmlT .= $elHtmlPHPInf;
				$elHtmlT .= "</form> \n";
				
				$elHtmlT .= "<div id=\"frmVista\" class=\"frmVistaOculta\" > \n";
				$elHtmlT .= "	Sin datos";
				$elHtmlT .= "</div>\n";
				
				
				foreach ($md as $key => $value) {
					$nmFn = self::toCap( $value );

					$txt .= "\tpublic function get" . $nmFn . " (){ \n";
					$txt .= "\t\treturn \$this->" . $value . ";\n";
					$txt .= "\t} \n";
					
					$txt .= "\tpublic function set" . $nmFn . " ( \$vl ){ \n";
					$txt .= "\t\t\$this->" . $value . " = \$vl;\n";
					$txt .= "\t} \n";
				}
				$txt .= "} \n";
				$txt .= "?>";
				
				if( $jsMenu ){
					echo "pageMenu.agregarMenu( utilidades.appPath(\"img/\") + \"admin_casos.png\",\"" . $flname . "\",\"modelos/" . $flname . ".phtml\"); <br />\n";
				}else{
					$flwr = $tmpFold . DIRECTORY_SEPARATOR . $flname . ".php";
					$flwrHtml = $tmpFlHtml . DIRECTORY_SEPARATOR . $flname . ".phtml";
					echo "escribe php en: " . $flwr . "<br />";
					self::RwFile($flwr, $txt);
					
					echo "escribe html en: " . $flwrHtml . "<br />";
					self::RwFile($flwrHtml, $elHtmlT);
				}
			}			
		}
		
	}
	
	/**
	 * Escribe (sobrescribe) texto en un archivo.
	 *
	 * @param string $flwr Ruta del archivo a escribir.
	 * @param string $txt  Texto a guardar en el archivo.
	 * @return void
	 */
	public static function RwFile($flwr, $txt){
		$decF = fopen($flwr, "w");
		fwrite($decF, $txt);
		fclose($decF);
	}
	
	/**
	 * Convierte la primera letra de una cadena a mayúscula.
	 *
	 * @param string $str Cadena de entrada.
	 * @return string Cadena resultante con la primera letra en mayúscula (si está vacía, devuelve cadena vacía).
	 */
	public static function toCap( $str ){
		return strtoupper( substr($str, 0, 1) ) . substr($str, 1, strlen( $str ));
	}
	
	/**
	 * Genera y devuelve la salida formateada para DataTables usando SSP::simple.
	 *
	 * Construye las columnas según la estructura de la tabla indicada en $data['tb'],
	 * aplica formateadores para fechas y decimales, y permite parámetros de codificación
	 * opcionales ('codifica_a', 'codifica_desde').
	 *
	 * @param array $data Array de configuración. Requiere 'tb' (nombre de la tabla). Opcionales: 'codifica_a', 'codifica_desde'.
	 * @return array Estructura de datos preparada para DataTables (resultado de SSP::simple).
	 */
	public static function _dataTable( $data ){
	    
	    $table = $data['tb'];
	    $primaryKey = 'id';
	    
	    $columns = array();
	    
	    $estructura = self::_metaDatosPlus( $table ); 
	    foreach ($estructura as $v) {
	        if ( $v['tipo'] == self::SQLTP_DATETIME ) {
	            $columns[] = array(
	                'db' => $v['nombre'],
	                'dt' => $v['nombre'],
	                'formatter' => function( $d, $row ) {
	                   return date( 'Y-m-d H:i:s', strtotime($d));
	                }
	            );
	        }elseif ( $v['tipo'] == self::SQLTP_DECIMAL ){
	            $columns[] = array(
	                'db' => $v['nombre'],
	                'dt' => $v['nombre'],
	                'formatter' => function( $d, $row ) {
	                   return '$' . number_format($d);
	                }
                );
	        }else{
	            if( $v['nombre'] == 'id' ) {
	                $columns[] = array('db' => $v['nombre'], 'dt' => $v['nombre']);
	                $columns[] = array(
	                    'db' => 'id',
	                    'dt' => 'DT_RowId',
	                    'formatter' => function( $d, $row ) {
	                       return 'row_'.$d;
	                    }
                    );
	            }
	            else{
	               $columns[] = array('db' => $v['nombre'], 'dt' => $v['nombre']);
	            }
	        }
	        
	    }
	    
	    require_once( dirname(dirname( __FILE__ )) . DIRECTORY_SEPARATOR . "libs" . DIRECTORY_SEPARATOR . "datatable" . DIRECTORY_SEPARATOR . 'ssp.class.php' );
	    
	    self::$lnk->close();
	    
	    include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "corp" . DIRECTORY_SEPARATOR . "Corporation.php";
	    $sql_details = array(
	        'user' => Corporation::DBUSER,
	        'pass' => Corporation::DBPASS,
	        'db'   => Corporation::DBNAME,
	        'host' => Corporation::HOST
	    );
	    //return json_encode( SSP::simple( $_POST, self::$lnk, $table, $primaryKey, $columns ) );
		
	    $codifica = array();
	    if ( isset( $data['codifica_a'] ) ) {
            $codifica['codifica_a'] = $data['codifica_a'];
	    }
	    if ( isset( $data['codifica_desde'] ) ) {
	        $codifica['codifica_desde'] = $data['codifica_desde'];
	    }
	    
	    
	    return SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $codifica ) ;
	}
	
	/**
	 * Destructor.
	 *
	 * Cierra la conexión almacenada en self::$lnk si existe y dispone del método close().
	 *
	 * @return void
	 */
	function __destruct(){ 
		if( !self::$lnk ){
		    if( !is_null(self::$lnk) ){
		        if(method_exists(self::$lnk, 'close')){
		            self::$lnk->close();
		        }
		    }
		}
	}
	
	/**
	 * Lee estados desde la tabla indicada aplicando filtros, orden y límite.
	 *
	 * Recibe un array de opciones ($d) con claves comunes:
	 * - 'tabla'   (string) Nombre de la tabla a consultar (obligatorio).
	 * - 'id'      (int)    Filtrar por id.
	 * - 'ordendesc' (int|string) Ordenar por columna/índice en DESC.
	 * - 'ordenasc'  (int|string) Ordenar por columna/índice en ASC.
	 * - 'limite'  (int)    Límite de filas a devolver.
	 * - 'debug'   (bool)   Si es true imprime la consulta SQL y detiene la ejecución.
	 *
	 * @param array $d Parámetros de consulta.
	 * @return mixed Resultado de la consulta (estructura devuelta por _safeRawQuery).
	 * @throws \Exception Si la consulta devuelve información de error ('err_info').
	 */
	public static function _readEstado( $d ) {
	    $tabla = $d['tabla'];
	    $r = new Singleton();
	    $r::$lnk->query( 'SET SQL_BIG_SELECTS=1' );
	    
	    $vr  = "cus.id, cus.nombre ";
	    $tb  = $tabla . ' as cus ';
	    $jn  = ' ';
	    
	    $pr = array();
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "cus.`id` = ? ";
	        $pr[] = $d['id'];
	    }
	    
	    $defWh = "";
	    if ( sizeof( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 DESC ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . intval( $d['ordendesc'] ) . " DESC ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . intval( $d['ordenasc'] ) . " ASC ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    
	    if ( isset( $d['debug'] ) ) {
	        if( $d['debug'] ){
	            die( $sql );
	        }
	    }
	    /*
	    $charsetfrom = IndexCtrl::CHARS_TO;
	    if ( isset( $d['charset_from'] ) ) {
	        $charsetfrom = $d['charset_from'];
	    }
	    $charsetto = IndexCtrl::CHARS_FR;
	    if ( isset( $d['charset_to'] ) ) {
	        $charsetto = $d['charset_to'];
	    }
	    */
	    $r = Singleton::_safeRawQuery($sql, $pr);
	    if ( isset( $r['err_info'] )) {
	        throw new \Exception( $r['err_info'] );
	    }
	    
	    return $r;
	}
	
	/**
	 * Actualiza registros de forma segura usando sentencias preparadas.
	 *
	 * @param string $table Nombre de la tabla a actualizar.
	 * @param array  $data  Array asociativo (columna => valor) para el SET.
	 * @param string $where Condición WHERE (sin la palabra "WHERE").
	 * @param array  $params Valores adicionales a enlazar para la cláusula WHERE.
	 * @return bool True si la actualización se realizó correctamente.
	 * @throws Exception Si falla la preparación o ejecución de la consulta.
	 */
	public static function _safeUpdate($table, $data, $where, $params = []) {
	    $s = new Singleton();
	    $sets = [];
	    $values = [];
	    
	    foreach ($data as $key => $value) {
	        $sets[] = "`$key` = ?";
	        $values[] = $value;
	    }
	    
	    $sql = "UPDATE `$table` SET " . implode(', ', $sets) . " WHERE $where";
	    $stmt = $s::$lnk->prepare($sql);
	    
	    if (!$stmt) {
	        throw new Exception($s::$lnk->error);
	    }
	    
	    $types = str_repeat('s', count($values) + count($params));
	    $stmt->bind_param($types, ...array_merge($values, $params));
	    
	    if (!$stmt->execute()) {
	        throw new Exception($stmt->error);
	    }
	    
	    $stmt->close();
	    return true;
	}
	
	/**
	 * Elimina filas usando prepared statements de manera segura.
	 *
	 * Ejecuta "DELETE FROM `tabla` WHERE ..." y enlaza los parámetros como strings.
	 *
	 * @param string $table Nombre de la tabla (no incluir datos de usuario sin validar).
	 * @param string $where Cláusula WHERE que debe contener marcadores "?" para los parámetros.
	 * @param array  $params Valores a enlazar a los marcadores (se tratan como cadenas).
	 * @return bool True si la eliminación se realiza correctamente.
	 * @throws Exception Si falla la preparación o la ejecución de la consulta.
	 */
	public static function _safeDelete($table, $where, $params = []) {
	    $s = new Singleton();
	    $sql = "DELETE FROM `$table` WHERE $where";
	    $stmt = $s::$lnk->prepare($sql);
	    if (!$stmt) {
	        throw new Exception($s::$lnk->error);
	    }
	    $types = str_repeat('s', count($params));
	    $stmt->bind_param($types, ...$params);
	    if (!$stmt->execute()) {
	        throw new Exception($stmt->error);
	    }
	    $stmt->close();
	    return true;
	}
	
	/**
	 * Inserta de forma segura una fila en una tabla usando prepared statements.
	 *
	 * @param string $table Nombre de la tabla destino.
	 * @param array  $data  Array asociativo con campo => valor a insertar.
	 * @return bool True si la inserción se realizó correctamente.
	 * @throws Exception Si falla la preparación o ejecución del statement.
	 */
	public static function _safeInsert($table, $data) {
	    $s = new Singleton();
	    $fields = array_keys($data);
	    $placeholders = array_fill(0, count($data), '?');
	    $sql = "INSERT INTO `$table` (`" . implode('`, `', $fields) . "`) VALUES (" . implode(',', $placeholders) . ")";
	    $stmt = $s::$lnk->prepare($sql);
	    if (!$stmt) {
	        throw new Exception($s::$lnk->error);
	    }
	    $types = str_repeat('s', count($data));
	    $stmt->bind_param($types, ...array_values($data));
	    if (!$stmt->execute()) {
	        throw new Exception($stmt->error);
	    }
	    $stmt->close();
	    return true;
	}
	
	/**
	 * Ejecuta una consulta SELECT de forma segura usando prepared statements.
	 *
	 * @param string $table  Nombre de la tabla (se encierra entre backticks).
	 * @param string $fields Campos a seleccionar (por defecto '*').
	 * @param string $where  Cláusula WHERE sin la palabra WHERE (opcional).
	 * @param array  $params Valores a enlazar a la consulta; todos se tratan como strings.
	 * @return array Array de filas asociativas en caso de éxito, o ['err_info' => string] con información de error.
	 */
	public static function _safeSelect($table, $fields = '*', $where = '', $params = []) {
	    $s = new Singleton();
	    $sql = "SELECT $fields FROM `$table`" . ($where ? " WHERE $where" : "");
	    $stmt = $s::$lnk->prepare($sql);
	    if (!$stmt) {
	        return ["err_info" => $s::$lnk->error];
	    }
	    if (!empty($params)) {
	        $types = str_repeat('s', count($params));
	        $stmt->bind_param($types, ...$params);
	    }
	    $stmt->execute();
	    $result = $stmt->get_result();
	    $rows = [];
	    while ($row = $result->fetch_assoc()) {
	        $rows[] = $row;
	    }
	    $stmt->close();
	    return $rows;
	}
	
	/**
	 * Ejecuta una consulta preparada sobre la conexión estática self::$lnk.
	 *
	 * - Si $sql comienza con "SELECT" (insensible a mayúsculas) devuelve un array
	 *   asociativo con todas las filas (fetch_all(MYSQLI_ASSOC)).
	 * - Para otras sentencias devuelve true al completarse correctamente.
	 * - Los parámetros en $params se enlazan como cadenas (tipo 's') en orden.
	 * - Cierra el statement antes de devolver el resultado.
	 *
	 * @param string $sql   Consulta SQL a ejecutar.
	 * @param array  $params  (Opcional) Valores a enlazar en la consulta.
	 * @return array|bool    Array asociativo para SELECT, true para sentencias no SELECT.
	 * @throws Exception     Si falla la preparación o la ejecución del statement.
	 * @static
	 */
	public static function _safeRawQuery($sql, $params = []) {
	    $s = new self();
	    $stmt = self::$lnk->prepare($sql);
	    if (!$stmt) throw new Exception(self::$lnk->error);
	    
	    if ($params) {
	        $types = str_repeat('s', count($params));
	        $stmt->bind_param($types, ...$params);
	    }
	    
	    if (!$stmt->execute()) throw new Exception($stmt->error);
	    
	    if (stripos($sql, 'SELECT') === 0) {
	        $res = $stmt->get_result();
	        $rows = $res->fetch_all(MYSQLI_ASSOC);
	        $stmt->close();
	        return $rows;
	    } else {
	        $stmt->close();
	        return true;
	    }
	}
	
}

?>