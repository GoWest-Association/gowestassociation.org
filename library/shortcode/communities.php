<?php

// function to return the community widget code
function communities_shortcode( $atts, $content = null ) {

    // allow the community type to be passed in
    $a = shortcode_atts( array(
		'type' => false,
	), $atts );

    // generate unique code for each widget
    $uid = md5( $a['type'] );

    // generate the code
    $code = '<div id="' . $uid . '"></div>
<script src=https://gowest.lightning.force.com/lightning/lightning.out.js></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
    $Lightning.use("c:boardMemberExternalApp", function() {
        console.log( "Loaded boardMemberExternalApp app" );
        $Lightning.createComponent( "c:boardMemberExternal", {communityType: "' . $a['type'] . '" }, "' . $uid . '", function(cmp) {
            console.log( "component boardMemberExternal created" );
        });
    }, "https://gowest.my.site.com");
});
</script>';

    // return it
    return $code;

}
// add the shortcode
add_shortcode( "communities", "communities_shortcode" );

