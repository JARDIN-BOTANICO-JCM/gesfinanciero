const MemoriaManager = function(){
	let mem = [];
	const _this = this;
	
	_this.cargar = function( el ){
		mem = el;
	};
	
	_this.obtenerPorId = function( el ){
		for (const k in mem ) {
            if (Object.hasOwnProperty.call(mem, k)) {
            	const _el = mem[ k ];
            	
            	if( _el['id'] == el['id'] ){
            		return _el;
            	}
        	}
    	}
    	
    	return false;
	};
	
	_this.agregar = function( el ){
		const existe = _this.obtenerPorId( el );
		
		if( existe === false ){
			mem.push( el );
			return true;
		}
		else{
			return false;
		}
	};
	
	_this.modificar = function( el ){
		const existe = _this.obtenerPorId( el );
		
		if( existe === false ) {
			return _this.agregar( el );
		}
		else{
			for (const k in mem ) {
	            if (Object.hasOwnProperty.call(mem, k)) {
	            	const _el = mem[ k ];
	            	
	            	if( _el['id'] == el['id'] ){
	            		mem[ k ] = el;
	            	}
	        	}
	    	}
			
			return true;
		}
	};
	
	_this.eliminarPorId = function( el ){
		for (const k in mem ) {
            if (Object.hasOwnProperty.call(mem, k)) {
            	const _el = mem[ k ];
            	
            	if( _el['id'] == el['id'] ){
            		mem.splice(k, 1);
            		return true;
            	}
        	}
    	}
    	return false;
	};
	
	_this.obtenerTodo = function(){
		return mem;
	}
	
};