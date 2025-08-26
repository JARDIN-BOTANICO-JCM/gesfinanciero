"use strict";
var __TransportarData = null;
var __AgregarDatosLista = null;
var __actualizarImg = null;
(function(){
    __TransportarData = function ( form_data, fn, fner, urljx ) {
		var _url = "/index.php";
		if( typeof( urljx ) !== "undefined"){
			_url = urljx;
		}
        var cfgajax = {url: _url,dataType: 'json',cache: false,contentType: false,processData: false, data: form_data,type: 'post'}
        
        var jqhxr = jQuery.ajax( cfgajax );
        jqhxr.done(function(data){
            fn( data );
        });
        jqhxr.fail(function(err){
            fner( err );
        });

    };

    /**
     * Llenado de campos
     * 
     * elId : number - Identificador del elemento select, ejemplo #idselect
     * formdata : Object - Arreglo de parametros que deben enviarse al servidor, ejemplo {'ajax':'88bacd11111...110003','idusr' : 1}
     * defItem : string - Id del valor a seleccionar
     * fn : function - Al recibir un resultado con exito que se debe hacer
     * campos : string - Campos a para concatenar en cada item de la lista, ejemplo "nombres;,;_;apellidos"
     */
    __AgregarDatosLista = function( cfg ) {
        const elId = cfg['elId'];
        const formdata = cfg['formdata'];
        const defItem = cfg['defItem'];
        const fn = cfg['fn'];

        var defcampo = ['nombre'];
        if (Object.hasOwnProperty.call(cfg, 'campos')) {
            defcampo = ( "" + cfg['campos'] ).split(';');
        } 

        const opc = { 'id' : 'ajaxldr' };
        const objmdl = mngModal.dibujar( opc );
        jQuery( objmdl ).modal('show');
    
        var form_data = new FormData();
        for (const k in formdata) {
            if (Object.hasOwnProperty.call(formdata, k)) {
                const _el = formdata[k];
                form_data.append(k, _el);
            }
        }

        __TransportarData(
            form_data,
            function( d ){
                var _elObj = jQuery( elId );
                
                const obj = d.ok;
                var html = [];
                for (const key in obj) {
                    if (Object.hasOwnProperty.call(obj, key)) {
                        const _el = obj[key];
                        var opcSel = "";
                        if (_el['id'] == defItem) {
                            opcSel = 'selected';
                        }

                        var _fldtxt = [];
                        for (const dcK in defcampo) {
                            if (Object.hasOwnProperty.call(defcampo, dcK)) {
                                const _idEle = defcampo[dcK];
                                if ( _idEle == '_') {
                                    _fldtxt.push( ' ' );
                                }
                                else if(_idEle == ',') {
                                    _fldtxt.push( ',' );
                                }
                                else{
                                    _fldtxt.push( _el[ _idEle ] );
                                }
                            }
                        }

                        html.push('<option value="' + _el['id'] + '" ' + opcSel + '>' + _fldtxt.join('') + '</option>');
                    }
                }
                _elObj.html( html.join('') );
    
                jQuery('.selectpicker').selectpicker('refresh');

                setTimeout( function(){ jQuery( objmdl ).modal('hide'); }, 2000);

                fn( d );
            },
            function( err ){
                const opcEr = { 'id' : 'mdlError', 'title' : 'Error','btnCerrarX' : true, 'level' : 'err' };
                const objmdlErr = mngModal.dibujar( opcEr );

                const alerta = jQuery(objmdlErr + ' div.alert');
                alerta.attr('class','alert alert-danger');
                alerta.html( err.responseText );

                jQuery( objmdlErr ).modal('show');
            }
        );
    };

    __actualizarImg = function ( ipfl, prevfoto, perfil, id, ajax ) {
        var _ipfl = jQuery( ipfl ).prop('files')[0];
        var flparts = ("" + _ipfl['name']).split('.');
        var flext = ("" + flparts[ flparts.length - 1] ).toLowerCase();
    
        if ( flext == 'jpg' || flext == 'jpeg' || flext == 'png' || flext == 'apng' ) {
            var form_data = new FormData();
            form_data.append('ajax', ajax );
            form_data.append('file', _ipfl );
            form_data.append('perfil_id', perfil );
            form_data.append('id', id );
    
            jQuery( prevfoto ).html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            __TransportarData(
                form_data,
                function( o ) {
                    jQuery( prevfoto ).html('<img src="./repo/avatar/' + o + '" style="height: 55px; " style="object-fit: cover;" />');
                },
                function ( err ) {
                    const objmdlErr = mngModal.dibujar( { 'id' : 'mdlError', 'title' : 'Error','btnCerrarX' : true, 'level' : 'err' } );
                    const alerta = jQuery(objmdlErr + ' div.alert');
                    alerta.attr('class','alert alert-danger');
                    alerta.html( err.responseText );
    
                    jQuery( objmdlErr ).modal('show');
                    setTimeout(function(){ jQuery( objmdl ).modal('hide'); }, 2000);
                }
            );
        }else{
            const oEr = mngModal.dibujar( { 'id' : 'mdlError', 'title' : 'Error','btnCerrarX' : true, 'level' : 'err' } );
            const alerta = jQuery(oEr + ' div.alert');
            alerta.attr('class','alert alert-danger');
            alerta.html( 'Solo se admiten im&aacute;genes' );
    
            jQuery( oEr ).modal('show');
        }
    
    };
})();