<?php

/**
 * Clase que controla los datos
 * @author yalfonso
 * @version 0.0.2
 *
 */
class Clsdatos extends Singleton {
	
	private $mensaje_error = null;
	
	/**
	 * 
	 * Obtiene el mensaje de error seg&uacute; indique la base de datos
	 * @return String
	 */
	public function obtenerError() {
		return $this->mensaje_error;
	}
	
	/**
	 * 
	 * Limpia la variable de mensajes
	 */
	public function limpiarError(){
		$this->mensaje_error = null;
	}
	
	/**
	 * Elimina el registro seg&uacute;n se asign&oacute; el id en el objeto instanciado
	 * @return String, n&uacute;meros de registros eliminados
	 */
	public function deleteById() {
		$fnName = "getId";
		$_id = -1;
		$_nombre = strtolower( get_class( $this ) );
		$result = -1;
		
		foreach(get_class_methods( $this ) as $id => $vl){
			if( strtolower( $vl ) == strtolower( $fnName ) ){
				$_id = $this->$fnName();
			}
		}
		
		if( $_id > 0 ){
			$sql = "DELETE FROM " . $_nombre . " WHERE id = ?";
			$stmt = null;
			if( ($stmt = self::$lnk->prepare($sql)) ) {
				$stmt->bind_param('i', $_id);
				$stmt->execute();
				$result = $stmt->affected_rows;
				$stmt->close();
			}else{
				$this->mensaje_error = self::$lnk->error;
				return -1;
			}
		}
		
		return $result;
	}
	
	/**
	 * Elimina el registro seg&uacute;n se asign&oacute; del campo y el valor correspondiente
	 * @return String, n&uacute;meros de registros eliminados
	 */
	public function deleteByField($campo, $valor) {	
		$_nombre = strtolower( get_class( $this ) );
		$sql = "DELETE FROM " . $_nombre . " WHERE " . $campo . " = ?";
		$stmt = null;
		if( ($stmt = self::$lnk->prepare($sql)) ) {
			$stmt->bind_param('i', $valor);
			$stmt->execute();
			$result = $stmt->affected_rows;
			$stmt->close();
		}else{
			$this->mensaje_error = self::$lnk->error;
			return -1;
		}
	
		return $result;
	}
	
	/**
	 * Obtiene los datos del registro seg&uacute;n el id asignado en la instancia creada
	 * @return Object, Almacena los datos de la consulta en este objeto
	 */
	public function readInfoById() {		
		$fnName = "getId";
		$_id = -1;
		
		$_nombre = get_class( $this ) ;
		$result = null;
		$params = array();
		
		foreach(get_class_methods( $this ) as $id => $vl){
			if( strtolower( $vl ) == strtolower( $fnName ) ){
				$_id = $this->$fnName();
			}
		}
		
		if( $_id > 0 ){
			$stmt = null;
			
			$query = "SELECT * FROM " . strtolower( $_nombre ) . " WHERE id = ?";
			if ($stmt = self::$lnk->prepare($query)) {
				$stmt->bind_param("i", $_id);
			    $stmt->execute();
			    
				$meta = $stmt->result_metadata(); 
			    while ($field = $meta->fetch_field()) {
			    	$params[] = &$row[ $field->name ]; 
			    } 
			
			    call_user_func_array(array($stmt, 'bind_result'), $params); 
			    
			    while ($stmt->fetch()) {
			    	$o = new $_nombre();
			        foreach($row as $key => $val) {
			            $o->{ "set" . Singleton::toCap($key)}( $val );
			        } 
			        $result = $o;			        
			    }
			    $stmt->close();
			}else{
				$this->mensaje_error = self::$lnk->error;
				return $result;
			}
			
		}
		else{
		    throw new Exception("El id no existe: " . $_id);
		}
		
		
		return $result;
		
	}
	
	/**
	 * Obtiene una lista que contiene una nueva lista con los datos de la consulta
	 * @param ver Campos que quiere ver, ejemplo "ID, COUNT(ID)"
	 * @param extras filtros en SQL, ejemplo: "Where id > 1 AND id < 3"
	 * @return array, retorna un arreglo de objetos
	 */
	public function readInfo($ver = "*", $extra = "") {		
		$fnName = "getId";
		$_id = 1;
		
		$_nombre = get_class( $this ) ;
		$result = array();
		$params = array();
		
		if( $_id > 0 ){
			$stmt = null;
			
			$query = "SELECT " . $ver . " FROM " . strtolower( $_nombre ) . " " . $extra;
			
			if( $stmt = self::$lnk->prepare($query) ){
				$stmt->execute();
				    
				$meta = $stmt->result_metadata();
				
				while ($field = $meta->fetch_field()) {
					$params[] = &$row[ $field->name ];
				} 
				
				call_user_func_array(array($stmt, 'bind_result'), $params); 
				
				while ($stmt->fetch()) {
					$o = new $_nombre();
				    foreach($row as $key => $val) {
				        $o->{ "set" . Singleton::toCap($key)}( $val );
				    } 
					$result[] = $o;
				}
	
				$stmt->close();
				
				if( sizeof($result) < 1 ){
					$execQ = self::$lnk->query($query);
					while ($row2 = $execQ->fetch_assoc()) {
						$o = new $_nombre();
					    foreach($row2 as $key => $val) {
					        $o->{ "set" . Singleton::toCap($key)}( $val );
					    } 
						$result[] = $o;
					}
				}
				
			}else{
				$this->mensaje_error = self::$lnk->error;
				return $result;
			}
		}
		
		
		return $result;
		
	}
	
	/**
	 * 
	 * Si un formulario contiene todos los campos de un modelo, este salvar&aacute; los datos que contiene
	 * @param entidades Verdadero para convertir los caracteres especiales en caracteres especiales en HTML
	 * @return array Retorna un arreglo con los ID de cada registro salvado correctamente
	 */
	public function saveDataFromPost( $entidades = false ){
		$entidad = get_class( $this ) ;
		$oArr = array();
		$totalArreglo = 0;
		$usr = Singleton::_metaDatos( $entidad );
		
		if( !isset( $usr[ "err_info" ] ) ){
			
			//unset( $usr["id"] );			
			
			foreach ( $usr as $id => $vl ) {
				if( $vl != "id" ){
					if( isset( $_POST[ $id ] ) ){
						
						$totalArreglo = sizeof( $_POST[ $id ] );
						break;
					}
				}
			}
			
			for($i = 0; $i < $totalArreglo; $i++){
				$vacio = false;
				$o = new $entidad();
				$esUpdate = false;
				foreach ( $usr as $id => $vl ) {
					
					if( isset( $_POST[ $id ] ) ){
						$valorReg = $_POST[ $id ];
						$tmpMetodo = "set" . Singleton::toCap( $id );
						
						if (isset( $valorReg[ $i ] )) {
							$vlstr = $valorReg[ $i ];
							if ($entidades) {
								$vlstr = htmlentities($vlstr, ENT_QUOTES | ENT_IGNORE, "UTF-8");
							}
							
							$o->{ $tmpMetodo }( $vlstr );
						}
					}
				}
				
				
				if( !$vacio ){
					if( $o->getId() > 0 ){
						if( $o->updateData() > 0 ){
							$oArr[] = $o->getId();
						}
					}else{
						$oArr[] = $o->saveData();
					}
				}
			}
			
			return $oArr;
		}else{
			return $usr;
		}
		
	}
	
	/**
	 * Salva los datos que se asignaron a las propiedades de este objeto
	 * @return String, ID del campo recientemente agregado
	 */
	public function saveData(){
		$_id = 1;
		$result = -1;
		
		if( $_id > 0 ){
			$_nombre = get_class( $this ) ;
			$valores = array();
			
			$stmt = null;
			$query = "SELECT * FROM " . strtolower( $_nombre ) . " limit 1";
			if ($stmt = self::$lnk->prepare($query)) {
				$meta = $stmt->result_metadata();
				while ($field = $meta->fetch_field()) {
					$nmF = $field->name;
					if( strtolower( $nmF ) != "id" ){
						$valores[ $nmF ] = $this->{ "get" . Singleton::toCap( $nmF )}( );
					}
				}
				$stmt->close();
			}else {
	        	$this->mensaje_error = self::$lnk->error;
				return $result; 
	        }
			
			$stmt = null;
			$placeholders = array_fill(0, count($valores), '?');
						
			$keys   = array();
			$values = array();
			foreach($valores as $k => $v) {
				$keys[] = $k;
				$values[] = !empty($v) ? $v : null;
			}
			$query = 'insert into ' . strtolower( $_nombre ) . '('.implode(', ', $keys).') values '. '('.implode(', ', $placeholders).'); ';
			$stmt = self::$lnk->prepare($query);
			
			if($stmt === false){
				$this->mensaje_error = self::$lnk->error;
				return $result;
			}else{
				$params = array();
				foreach ($valores as &$value) {
					$params[] = &$value;
				}
				$types  = array(str_repeat('s', count($params)));
				$values = array_merge($types, $params); 
				call_user_func_array(array($stmt, 'bind_param'), $values);
				$success = $stmt->execute();
				if ($success) { 
					$result = $stmt->insert_id; 
				}else {
		        	$this->mensaje_error = self::$lnk->error;
		        	$stmt->close();
					return $result; 
		        }
			}
	        $stmt->close();
			
		}
		
		return $result;
	}
	
	/**
	 * Actualiza los datos que se asignaron a las propiedades de este objeto seg&uacute;n el id
	 * @return Integer, cantidad de registros afectados
	 */
	public function updateData(){
		$fnName = "getId";
		$_id = -1;
		$result = -1;
		
		foreach(get_class_methods( $this ) as $id => $vl){
			if( strtolower( $vl ) == strtolower( $fnName ) ){
				$_id = $this->$fnName();
			}
		}
		
		if(!is_numeric($_id)){
			return $result;
		}
		
		if( $_id > 0 ){
			$_nombre = get_class( $this ) ;
			$valores = array();
	
			$stmt = null;
			$query = "SELECT * FROM " . strtolower( $_nombre ) . " limit 1";
			if ($stmt = self::$lnk->prepare($query)) {
				$meta = $stmt->result_metadata();
				while ($field = $meta->fetch_field()) {
					$nmF = $field->name;
					if( strtolower( $nmF ) != "id" ){
						$tmpVl = $this->{ "get" . Singleton::toCap( $nmF )}( );
						if( strlen( $tmpVl ) > 0 ){
							$valores[ $nmF ] = $tmpVl;
						}
					}
				}
				$valores["id"] = $_id;	// Se agrega el valor del id como &uacute;ltimo valor
				$stmt->close();
			}else {
	        	$this->mensaje_error = self::$lnk->error;
				return $result; 
	        }
			
	        if( sizeof( $valores ) > 0 ){	        
				$stmt = null;
		
				$keys   = array();
				$values = array();				
				foreach($valores as $k => $v) {
					if( $k != "id" ){
						$keys[] = $k . "=?";
					}
					$values[] = !empty($v) ? $v : null;
				}
				$query = 'UPDATE ' . strtolower( $_nombre ) . ' SET ' . implode(', ', $keys) . ' where id = ? ';
				$stmt = self::$lnk->prepare($query);
				
				if( $stmt === false ){
					$this->mensaje_error = self::$lnk->error;
					return $result;
				}else{
					$params = array();
					foreach ($valores as &$value) {
						$params[] = &$value;
					}
					
					$types  = array(str_repeat('s', count($params)-1) . "i"); 
					$values = array_merge($types, $params);
					
					call_user_func_array(array($stmt, 'bind_param'), $values);
					$success = $stmt->execute();
					if (!$success) {
			        	$this->mensaje_error = self::$lnk->error;
			        	$stmt->close();
						return $result; 
			        }
				}
				
				$result = $stmt->affected_rows;
		        $stmt->close();
		        
			}
			else{
				return $result;
			}
		}
		
		return $result;
	}
	
}

?>