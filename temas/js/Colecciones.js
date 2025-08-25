var Colecciones = function(){
    var _this = this;
    var mem = [];

    _this.agregar = function(id, vl){
        for (const key in mem) {
            var _m = mem[ key ];
            if ( _m['id'] == id ) {
                return false;
            }
        }
        mem.push({'id' : id, 'vl' : vl});
        return true;
    };

    _this.obtenerTodo = function(){
        return mem;
    };

    _this.obtenerPorId = function( id ) {
        for (const key in mem) {
            var _m = mem[ key ];
            if ( _m['id'] == id ) {
                return _m;
            }
        }
        return false;
    };

    _this.eliminarPorId = function( id ) {
        for (const key in mem) {
            var _m = mem[ key ];
            if ( _m['id'] == id ) {
                mem.splice( key , 1 );
                return true;
            }
        }
        return false;
    };
    
    _this.iniciar = function( vl ){
		mem = vl;
	};
    
};