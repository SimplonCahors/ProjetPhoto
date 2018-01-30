tinymce.PluginManager.add('avalon_td_button', function(ed, url) {
	ed.addCommand("themedoPopup", function ( a, params )
	{
		var popup = 'shortcode-generator';

		if(typeof params != 'undefined' && params.identifier) {
			popup = params.identifier;
		}

		// load thickbox
		tb_show("Themedo Shortcodes", ajaxurl + "?action=avalon_td_shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});

	// Add a button that opens a window
	ed.addButton('avalon_td_button', {
		text: '',
		icon: true,
		image: themedoShortcodes.plugin_folder + '/tinymce/images/icon.png',
		cmd: 'themedoPopup'
	});
});