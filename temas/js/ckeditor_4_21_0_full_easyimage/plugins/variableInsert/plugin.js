CKEDITOR.plugins.add('variableInsert', {
    icons: 'variableInsert',
    init: function (editor) {
        editor.ui.addRichCombo('variableInsert', {
            label: 'Variables',
            title: 'Variables',
            toolbar: 'insert',
            className: 'cke_format',
            panel: {
                css: [CKEDITOR.skin.getPath('editor')],
                multiSelect: false,
                attributes: { 'aria-label': 'Insertar variable' }
            },

            init: function () {
                const combo = this;

                if (window.CKEDITOR_VARIABLES_LIST && window.CKEDITOR_VARIABLES_LIST.length) {
                    window.CKEDITOR_VARIABLES_LIST.forEach(item => {
                        combo.add(item.clave, item.label, 'Insertar ' + item.label);
                    });
                } else {
                    combo.add('-', 'Sin datos', 'No se cargaron variables');
                }
            },

            onClick: function (value) {
                editor.insertText(value);
            },
            
			onOpen: function () {
				const panel = this._.panel && this._.panel.element;
				if (panel) {
					setTimeout(() => {
						panel.setStyle('width', '300px');
					}, 50);
				}
			}
			
            
        });
    }
});
