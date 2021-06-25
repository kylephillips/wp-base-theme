/**
* Adds CSS Class selection to blocks
* Loads from theme config.json file
*/
var getConfigJSON = function(url, callback)
{
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.onload = function() {
      var status = xhr.status;
      if (status === 200) {
        callback(null, xhr.response);
      } else {
        callback(status, xhr.response);
      }
    };
    xhr.send();
};

getConfigJSON(editor_formats.config_url, function(err, data){
    if ( err !== null ) {
        console.log('There was an error loading the configuration file');
    } else {
        for ( const prop in data.editor_formats ){
            for ( var i = 0; i < data.editor_formats[prop].block.length; i++ ){
                wp.blocks.registerBlockStyle( data.editor_formats[prop].block[i], {
                    name: prop,
                    label: data.editor_formats[prop].label
                });
            }
        }
    }
});