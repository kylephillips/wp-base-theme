(function() {
	tinymce.create('tinymce.plugins.typekit', {
		init: function(ed, url) {
			ed.onPreInit.add(function(ed) {
				// Get the iframe.
				var doc = ed.getDoc();
 
				// Create the script to inject into the header asynchronously.
				var jscript = "(function() {" +
					"var config = { kitId: '" + typekit_id + "' };" +
					"var d     = false," +
						"tk    = document.createElement('script');" +
					"tk.src    = '//use.typekit.net/' + config.kitId + '.js';" +
					"tk.type   = 'text/javascript';" +
					"tk.async  = 'true';" +
					"tk.onload = tk.onreadystatechange = function() {" +
						"var rs = this.readyState;" +
						"if (d || rs && rs != 'complete' && rs != 'loaded') return;" +
						"d = true;" +
						"try { Typekit.load(config); } catch (e) {}" +
					"};" +
					"var s = document.getElementsByTagName('script')[0];" +
					"s.parentNode.insertBefore(tk, s);" +
				"})();";
 
				// Create a DOM script element and insert the code inside of it.
				var script  = doc.createElement("script");
				script.type = "text/javascript";
				script.appendChild(doc.createTextNode(jscript));
 
				// Append the srcript to the header.
				doc.getElementsByTagName('head')[0].appendChild(script);
			});
		},
	});
	tinymce.PluginManager.add('typekit', tinymce.plugins.typekit);
})();