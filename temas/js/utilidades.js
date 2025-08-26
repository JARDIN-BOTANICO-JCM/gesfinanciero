var Utilidades = function(){
	var este = this;
	
	this.b64EncodeUnicode = function (str) {
	    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
	        return String.fromCharCode('0x' + p1);
	    }));
	};
	
	this.b64DecodeUnicode = function (str) {
	    return decodeURIComponent(Array.prototype.map.call(atob(str), function(c) {
	        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	    }).join(''));
	};
	
	this.isBase64 = function (str) {
	    if (typeof str !== 'string') {
	        return false;
	    }
	    if (str.length % 4 !== 0) {
	        return false;
	    }
		let base64Regex = /^(?:[A-Za-z0-9+\/]{4})*(?:[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)?$/;
	
	    return base64Regex.test(str);
	}
	
	this.appPath = function( fld ){
		
		if( typeof( fld ) == "undefined"){
			fld = "";
		}
		
		var scriptEls = document.getElementsByTagName( 'script' );
		var thisScriptEl = scriptEls[scriptEls.length - 1];
		var scriptPath = thisScriptEl.src;
		var scriptFolder = scriptPath.substr(0, scriptPath.lastIndexOf( '/' )+1 );

		// Folder Img
		var imgFolder = scriptFolder.substr(0, scriptFolder.length - 1 );
		imgFolder = imgFolder.substr(0, imgFolder.lastIndexOf( '/' )+1 ) + fld;
		
		return imgFolder;
	};
	
	this.isLandscape = function(){
		var landscapeOrientation = window.innerWidth / window.innerHeight > 1;
		return landscapeOrientation;
	};
	
	this.CrearId = function(){
		var f = new Date();
		var txt = [];
		txt.push(f.getFullYear());
		txt.push(f.getMonth());
		txt.push(f.getDay());
		txt.push(f.getHours());
		txt.push(f.getMinutes());
		txt.push(f.getSeconds());
		
		return txt.join("");
	};
	
	this.GetUUID = function (){
	    var dt = new Date().getTime();
	    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
	        var r = (dt + Math.random()*16)%16 | 0;
	        dt = Math.floor(dt/16);
	        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
	    });
	    return uuid;
	};

	this.SetDatosLocal = function(id, vl){
		if(typeof(Storage) !== "undefined") {
			localStorage.setItem(id, vl);
		} else {
			return "Dispositivo sin soporte para salvar datos locales";
		}
	};
	
	this.GetDatosLocal = function(id){
		if(typeof(Storage) !== "undefined") {
			return localStorage.getItem(id);
		} else {
			return "Dispositivo sin soporte para salvar datos locales";
		}

	};
	
	this.DelDatosLocal = function(id){
		if(typeof(Storage) !== "undefined") {
			localStorage.removeItem(id);
		} else {
			return "Dispositivo sin soporte para salvar datos locales";
		}
	};
	
	this.UrlEncodingToObject = function(str){
		var ob = null;
		var txt = ("" + str);
		var s = txt.split("?");
		
		if( txt.indexOf("?") >= 0 ){
			var search = s[1];
			
			var jsonTxt = search.replace(/&/g, ',').replace(/=/g,':');
			
			var defjs = [];
			var verif = jsonTxt.split(',');
			for( var _i in verif){
				var _v = verif[ _i ];
				var llaves = _v.split(':');
				//console.log( llaves[0] + " = " + llaves[1] );
				defjs.push( '"' + llaves[0] + '":"' + llaves[1] + '"' );
			}
			
			var strjson = defjs.join(',');
			var r = JSON.parse('{' + strjson + '}',
	                 function(key, value) { return key === "" ? value : decodeURIComponent(value) });
			
			ob = { url : s[0], params : r };
		}
		else{
			ob = {};
		}
		
		return ob;
	};
	
	this.crearFormulario = function ( path, params, method ) {
	    method = method || "post";

	    var form = document.createElement("form");
	    form.setAttribute("method", method);
	    form.setAttribute("action", path);
	    
	    for ( const key in arguments ) {
	        if ( Object.hasOwnProperty.call( arguments, key ) ) {
	            const _el = arguments[ key ];
	            
	            if( key == 3 ){
		            form.setAttribute("target", _el);
				}
				
            }
        }
	    
	    for(var key in params) {
	        if(params.hasOwnProperty(key)) {
	            var hiddenField = document.createElement("input");
	            hiddenField.setAttribute("type", "hidden");
	            hiddenField.setAttribute("name", key);
	            hiddenField.setAttribute("value", params[key]);

	            form.appendChild(hiddenField);
	         }
	    }

	    document.body.appendChild(form);
	    form.submit();
	};
	
	this.efectoVuelta = function(objSal, objEnt) {
		var s = jQuery(objSal);
		var e = jQuery(objEnt);

		var cssS = "salirElemento";
		var cssE = "entrarElemento";

		var anchoS = s.outerWidth() + "px";

		s.css("width", anchoS);
		e.css("width", anchoS);
		e.addClass("elementosNoVisibles");
		e.fadeIn("slow");
		
		s.removeClass(cssS).addClass(cssS).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuery(this)
				.removeClass(cssS)
				.addClass("elementosInicialesSecond");
		});
	    e.removeClass(cssE).addClass(cssE).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuery(this).removeClass(cssE + " elementosNoVisibles elementosInicialesSecond");
		});

		jQuery( ".mnCpSection" ).removeClass('mnCpSection');
		e.addClass("mnCpSection");
	};
	
	this.intToPesos = function(ente, c, d, t){
		var n = ente, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "." : d, 
	    t = t == undefined ? "," : t, 
	    s = n < 0 ? "-" : "", 
	    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
	    j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
	
	this.validarFrm = function( cls, fn ) {
		event.preventDefault();
		event.stopPropagation();

        var forms = document.getElementsByClassName(cls);
        var validation = Array.prototype.filter.call(forms, function(form) {
            if (!(form.checkValidity() === false)) {
            	var o = jQuery(form);
          		jsonObj = [];
          		jQuery("#" + o.attr('id') + " input, #" + o.attr('id') + " select, #" + o.attr('id') + " textarea").each(function(i,o) {
					const _o = jQuery( o );
        			//var nombre = jQuery(this).attr("name");
        			const nombre = _o.attr("name");
        			//var valor = ("" + jQuery(this).val()).replace(/\\/ig, "/");
        			//const valorTmp = ( "" + _o.val() ).replace(/\\/ig, "/");
        			var valor = JSON.stringify( _o.val() );
        			
        			if( (""+_o.attr('type')).toLowerCase() == 'checkbox' ){
						valor = false;
						if( _o.is(':checked') ){
							if( _o.val() === true || _o.val() === "true" || _o.val() == "true"){
								valor = true;
							}
							else{
								valor = JSON.stringify( _o.val() );
							}
						}
					}
        			
        			if(jQuery.trim( valor ).length > 0){
	        			jsonObj.push('"' + nombre + '" : ' + valor + '');
        			}
          		});
          		var tmpJson = JSON.parse("{" + jsonObj.join(',') + "}");
          		fn( tmpJson );
            }
            form.classList.add('was-validated');
    	});
	};
	
	this.copyTextToClipboard = function (text, fun) {
		if (!navigator.clipboard) {
	        if( !fallbackCopyTextToClipboard(text) ){
	        	fun();
	        }
	        return;
		}
		navigator.clipboard.writeText(text).then(function() {
			console.log('Async: Copying to clipboard was successful!');
		}, function(err) {
			console.error('Async: Could not copy text: ', err);
			fun();
		});
	};
	
	this.csvJSON = function(csvO){
		
		if( typeof(csvO) == "object" ){
			if( typeof( csvO['csv'] ) != "string" ) throw "CSV debe ser de tipo texto";
			
			var sepa = ";";
			if( typeof( csvO['separador'] ) == "string" ) sepa = csvO['separador'];
			
			var csv = csvO['csv'];
			var lines=csv.split("\n");
		
			var result = [];
			var headers=lines[0].split( sepa );
			
			for(var i=1;i<lines.length;i++){
				var obj = {};
				var currentline=lines[i].split(sepa);
				for(var j=0;j<headers.length;j++){
					obj[headers[j]] = currentline[j];
				}
				result.push(obj);
			}
			return JSON.stringify(result);
		}
		
	};

	this.generateString = function (length) {
		var characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

		let result = ' ';
		const charactersLength = characters.length;
		for ( let i = 0; i < length; i++ ) {
			result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
	
		return result;
	};
	
	this.formatoYYYYMMDD = function( f ){
		var d = new Date( f ),
			month = '' + (d.getMonth() + 1),
    		day = '' + d.getUTCDate(),
    		year = d.getFullYear();

			if (month.length < 2) 
    			month = '0' + month;
			
			if (day.length < 2) 
    			day = '0' + day;
    			
		return [year, month, day].join('-');

	};
	
	this.pathInfo = function(path) {
	    var fileName = path.split('/').pop();
	    var extension = fileName.split('.').pop();
	    var fileNameWithoutExtension = fileName.replace('.' + extension, '');
	    var dirname = path.replace('/' + fileName, '');
	
	    return {
	        'dirname': dirname,
	        'basename': fileName,
	        'extension': extension,
	        'filename': fileNameWithoutExtension
	    };
	}
	
	this.replacelabel = function( texto, valores, reP ) {
		let _reP = "__\\w+__";
		
		if( typeof( reP ) == 'string' ){
			_reP = reP;
		}
		
		let defTxt = texto;
		let bbf = [];
		bbf.push( { "t":"[b]", "r":"<b>" }, { "t":"[/b]","r":"</b>" } );
		bbf.push( { "t":"[i]", "r":"<i>" }, { "t":"[/i]","r":"</i>" } );
		bbf.push( { "t":"[small]", "r":"<small>" }, { "t":"[/small]","r":"</small>" } );
		bbf.push( { "t":"[big]", "r":"<big>" }, { "t":"[/big]","r":"</big>" } );
		
		for ( const cpK in bbf ) {
            if ( Object.hasOwnProperty.call( bbf, cpK ) ) {
                const _elCp = bbf[ cpK ];
                
                defTxt = defTxt.replace(_elCp['t'], _elCp['r']);
            }
        }
		
		
	    let regex = new RegExp( _reP, 'g');
	    
	    return defTxt.replace(regex, function(match) {
	        let campo = match.slice(2, -2);
	        return valores[campo] !== undefined ? valores[campo] : match;
	    });
	};
	
	
	this.textToLinks = function (texto) {
	    const regexUrl = /(https?:\/\/[^\s]+)/g;
	    return texto.replace(regexUrl, function(url) {
	        return '<a href="' + url + '" target="' + este.GetUUID() + '">' + url + '</a>';
	    });
	}
	
	este.precargarImagen = function( src, fn ) {
		const imagen = new Image();
		imagen.src = src;
		
		const body = document.querySelector('body');
		const nuevoDiv = document.createElement('div');
		nuevoDiv.style.display = 'inline-block';
	    nuevoDiv.style.position = 'absolute';
	    nuevoDiv.style.opacity = 0;
	    nuevoDiv.style.top = '0px';
	    nuevoDiv.style.left = '0px';
		
		body.appendChild(nuevoDiv);
		nuevoDiv.appendChild(imagen);
		
		if (imagen.complete) {
			fn( { 'img':imagen, 'size' : nuevoDiv } );
			nuevoDiv.remove();
		} else {
			imagen.addEventListener('load', () => {
				fn( { 'img':imagen, 'size' : nuevoDiv } );
				nuevoDiv.remove();
			});
		}
	};
	
};