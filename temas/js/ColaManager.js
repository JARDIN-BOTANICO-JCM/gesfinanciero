/**
 * @author YAlfonso
 * @date 20200903
 * @version 0.2.0
 */
var ColaManager = function(){
	var este = this;
	var _autoid = 0;
	este.CantidadProcesos = 3;
	var Avance =  0;
	var Cola = [];
	este.Total = function(){ return Cola.length; };
	este.Estados = [{'id' : 1, 'nombre' : 'Pendiente'}, {'id' : 2, 'nombre' : 'Ejecutando'}, {'id' : 3, 'nombre' : 'Terminado'}, {'id' : 4, 'nombre' : 'Fallido'}];
	este.Limpiar = function(){ Cola = []; _autoid = 0; Avance = 0; };
	este.Reiniciar = function(){ 
		_autoid = 0;
		Avance = 0;
		for(var i in Cola){
			var _oc = Cola[i];
			CambiarEstadoProceso( _oc["id"], este.ObtenerEstadosById(1) );
		}
	};
	este.Agregar = function( o ){ Cola.push( o ); _autoid++; };
	este.Obtener = function(){ return Cola; };
	este.ObtenerEstadosById = function( id ){ return este.Estados[ id - 1 ]; };
	este.EspaciosLibres = function(){
		var cola = este.Obtener();
		var actuales = 0;
		Avance = 0;
		for(var i in cola){
			var _c = cola[i];
			if( _c.estado == 2 ){
				if( actuales < este.CantidadProcesos ){
					actuales++;
				}
			}

			if( _c.estado == 3 ){
				Avance++;
			}
		}
		return actuales;
	};
	este.Ejecutar = function( f ){
		var permi = este.EspaciosLibres();
		var cola = Cola;
		
		for(var i in cola){
			var _c = cola[i];
			if( _c.estado == 1 ){
				if( permi < este.CantidadProcesos ){
					permi++;
					var _tmpId = _autoid;
					if( typeof( _c['id'] ) != "undefined" ){
						_tmpId = _c['id'];
					}
    				este.CambiarEstadoProceso( _tmpId, este.ObtenerEstadosById(2) );
    				var idTmp = _tmpId;
    				f( idTmp, _c );
				}
				else{
					break;
				}
			}
		}
		
		
	};
	este.CambiarEstadoProceso = function( id, idEstado ){
		for(var i in Cola){
			var _c = Cola[i];
			if( _c['id'] == id ){
				Cola[i]['estado'] = idEstado['id'];
				break;
			}
		}
	};
	este.ObtenerAvance = function(){ return Avance; };
};
