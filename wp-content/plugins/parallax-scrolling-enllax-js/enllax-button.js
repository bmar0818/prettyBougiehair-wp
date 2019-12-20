(function() {
    tinymce.create("tinymce.plugins.enllax_button_plugin", {

        //url argument holds the absolute url of our plugin directory
        init : function(ed, url) {

            //add new button    
            ed.addButton("enllax_button", {
                title : "Enllax plugin",
                cmd : "enllax_command",
                image : url+"/enllax-button.png"
            });

            //button functionality.
            ed.addCommand("enllax_command", function() {
                var selected_text = ed.selection.getContent();
			var return_text = "<p>[enllax xclass=\"enllax\" offset=\"0\" direction=\"vertical\" speed=\"0.5\" img=\"http://www.mrwallpaper.com/wallpapers/AUtumn-Yellow-Park-1680x1050.jpg\"]<br/>Your content.<br/>[enllaxend]</p>";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

        },

        createControl : function(n, cm) {
            return null;
        },

    });

    tinymce.PluginManager.add("enllax_button_plugin", tinymce.plugins.enllax_button_plugin);
})();