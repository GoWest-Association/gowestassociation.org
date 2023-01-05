

(function() {
	tinymce.PluginManager.add('btn_mce_button', function( editor, url ) {
		editor.addButton('btn_mce_button', {
			title: 'Add Button',
			image: url + '/icon/button.png',
			onclick: function() {
				// change the shortcode as per your requirement
				editor.insertContent('[button url="/link" class="navy"]Button Text[/button]');
			}
		});
	});
})();

