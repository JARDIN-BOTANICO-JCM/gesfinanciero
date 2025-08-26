var _mdlColGlobal = new Colecciones();

var ManagerModal = function (){
    var _this = this;

    _this.dibujar = function( opc ){
        var idF = opc['id'];
        var level = 'l1'
        var title = null;
        var btnCerrarX = null;
        var footer = null;
        var scrolling = null;
        var center = null;

        if (typeof(opc['level']) != 'undefined') level = opc['level'];
        if (typeof(opc['title']) != 'undefined') title = opc['title'];
        if (typeof(opc['btnCerrarX']) != 'undefined') btnCerrarX = opc['btnCerrarX'];
        if (typeof(opc['footer']) != 'undefined') footer = opc['footer'];
        
        const idmdl = '#stcMdl_' + level;

        var frmMem = _mdlColGlobal.obtenerPorId( idF );
        if ( frmMem === false ) {
            var frmNuevoDocente = jQuery('#' + idF).clone();
            jQuery('#' + idF).remove();
            
            _mdlColGlobal.agregar( idF, frmNuevoDocente.html() );
            frmMem = _mdlColGlobal.obtenerPorId( idF );
        }

        var _frmC = frmMem['vl'] ;
        var stcMdl = jQuery( idmdl ).find('.modal-dialog');
        if (typeof(opc['scrolling']) != 'undefined') {
            scrolling = opc['scrolling'];
            if ( scrolling ) {
                stcMdl.addClass( 'modal-dialog-scrollable' );
            }
        }
        if (typeof(opc['center']) != 'undefined') {
            center = opc['center'];
            if ( center ) {
                stcMdl.addClass( 'modal-dialog-centered' );
            }
        }
        if (typeof(opc['size']) != 'undefined') {
            stcMdl.addClass( opc['size'] );
        }
    
        var _html = [];
        _html.push ( '<div class="modal-content"> ');
        if ( title !== null ) {
            _html.push ( '  <div class="modal-header"> ');
            _html.push ( '    <h5 class="modal-title" id="' + idmdl + 'Label">' + title + '</h5> ');
            if ( btnCerrarX === true ) {
                _html.push ( '    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> ');
            }
            _html.push ( '  </div> ');
        }
        _html.push ( '  <div class="modal-body"> ');
        _html.push ( '  ' + _frmC );
        _html.push ( '  </div> ');

        if ( footer !== null ) {
            _html.push ( '  <div class="modal-footer"> ');
            _html.push ( '    ' + footer + '');
            _html.push ( '  </div> ');
        }

        _html.push ( '</div> ');
    
        stcMdl.html( _html.join('') );

        return idmdl;
    };

    _this.iniciar = function(){
        jQuery('.mdlCont').each(function (i, o) {
            var _o = jQuery( o );

            var idF = _o.attr( 'id' );

            var frmNuevoDocente = jQuery('#' + idF).clone();
            jQuery('#' + idF).remove();

            var frmMem = _mdlColGlobal.obtenerPorId( idF );
            if ( frmMem === false ) {
                _mdlColGlobal.agregar( idF, frmNuevoDocente.html() );
            }
        });
    };

};

var mngModal = new ManagerModal();
jQuery( document ).ready(function () {
    mngModal.iniciar();
});