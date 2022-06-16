

// small helper function to force download of a url to a file
function forceDownload(url, fileName){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function(){
        var urlCreator = window.URL || window.webkitURL;
        var imageUrl = urlCreator.createObjectURL(this.response);
        var tag = document.createElement('a');
        tag.href = imageUrl;
        tag.download = fileName;
        document.body.appendChild(tag);
        tag.click();
        document.body.removeChild(tag);
    }
    xhr.send();
}


// onload
jQuery(document).ready(function($){

    // button click handler for download option - if that parameter is set.
	$( "a.btn[download]" ).on( 'click', function( event ){

        // prevent the link from navigating to the href.
		event.preventDefault();

        // force download of the url to a specific filename.
		forceDownload( $(this).attr('href'), $(this).attr('download') );
	})

});