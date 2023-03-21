<?php

// function to return the community widget code
function communities_shortcode( $atts, $content = null ) {

    // allow the community type to be passed in
    $a = shortcode_atts( array(
		'type' => false,
	), $atts );

    // generate the code
    $code = '<script src="https://gowest.lightning.force.com/lightning/lightning.out.js"></script>
<script>
$Lightning.use("c:boardMemberExternalApp",
function() {
    $Lightning.createComponent(
        "c:boardMemberExternal",
        { communityType: "' . $a['type'] . '" },
        "lightning locator",
        function(cmp){});
    },
    "https://gowest.force.com"
);
</script>';

    // return it
    return $code;

}
// add the shortcode
add_shortcode( "communities", "communities_shortcode" );

