<?php



// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



// let's create the function for the custom type
function lightbox_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'lightbox', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Lightboxes', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Lightbox', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Lightboxes', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Lightbox', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Lightbox', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Lightbox', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Lightbox', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Lightbox', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the lightboxes.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-lightbulb', /* the icon for the custom post type menu */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array( 'title', 'revisions' )
		) /* end of options */
	); /* end of register post type */
	
	// add post tags to our cpt
	// register_taxonomy_for_object_type( 'post_tag', 'lightbox' );
	
}


// adding the function to the Wordpress init
add_action( 'init', 'lightbox_post_type');


// function outputs the lightbox code into the footer
// of each page.
function get_lightbox() {
    
	// retrieve and store the current post id
	global $post;
	if ( in_array( $post->post_type, array( 'post', 'page', 'event' ) ) ) {

		// store the post id
		$current_page = $post->ID;

		// get all the lightboxes
		$the_query = new WP_Query(array(
			'post_type' => 'lightbox'
		));

		// if we have lightboxes
		if ( $the_query->have_posts() ) {

			// loop through the lightboxes and display the lightbox only
			// if the page is selected as a display location for the
			// lightbox
			while ( $the_query->have_posts() ) {

				// boolean to dictate whether a lightbox will display.
				$display_lightbox = false;
				
				// get this lightbox
				$the_query->the_post();

				// get the posts/pages/events this lightbox is supposed to display on
				$lightbox_pages = get_field( 'lightbox_pages' );
				$lightbox_urls = get_field( 'lightbox_urls' );
				$lightbox_content = get_field( 'lightbox_content' );
				$pageload = get_field( 'pageload' );
				$expires = get_field( 'expires' );
				$theme = get_field( 'theme' );

				// get the cookie name, if it's empty, set to the post id.
				$cookie = get_field( 'cookie' );
				if ( empty( $cookie ) ) {
					$cookie = get_the_ID();
				}

				// has the cookie name and add a prefix
				$cookie = 'lightbox-' . md5( $cookie );

				// if this page/event id is selected
				if ( in_array( $current_page, $lightbox_pages ) ) $display_lightbox = true;

				// if this url is selected 
				$current_url = $_SERVER['REQUEST_URI'];

				// separate multiple specific urls for the match
				$lightbox_urls_array = explode( ',', $lightbox_urls );

				foreach ( $lightbox_urls_array as $lightbox_url ) {

					// if the current url matches the specified 
					if ( fnmatch( $lightbox_url, $current_url ) && !$display_lightbox ) {
						$display_lightbox = true;
					}
				}

				// if the lightbox is supposed to be on this page.
				if ( $display_lightbox ) {
					print '<div class="lightbox-theme ' . $theme . '" data-expires="' . $expires . '" data-pageload="' . ( $pageload  ? 'true' : 'false' ) . '" data-cookie="' . $cookie . '">';
					print '<div class="lightbox-logo text-center"><img src="';
					if ( $theme == 'foundation' ) {
						print 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXkAAABSCAMAAACGwVROAAABblBMVEUAAADkfSTkfSTkfSTkfSTkfSTkfST////kfSTkfSTkfSTkfSTkfST////kfST////kfST////kfSTkfSTkfST////kfST////kfSTkfST////kfSTkfSTkfSTkfST////////////////kfST////////kfST////kfSTkfST////kfST////kfST////kfSTkfST////kfST////////kfST////////kfST////kfST////kfST////kfSTlfiX////////kfSTkfST////////////kfST////kfST////kfST////kfST////lfiX////kfSTkfST////kfSTkfSTkfSTkfST////////////////////////kfST////////////////kfSTkfSTkfST////////kfST////////kfSTkfST////////////////kfSTkfST////ojT7tqG399OzqmlPkfST///8v7X70AAAAeHRSTlMAQFAgoODxQBAUsGDQ+/uwkB/s04DRCjD1NmAcDgPAI+w2wJcD2MmRMS3IuJeIc1tWBWpOD9ygeSkoBvTjgHYk+N+nfCznzGRYTUg8BnAS+du9o24Y16uaiYVoGxYJ5sS2qI2MSUXw44NbDOnFpDu9ugxeU/Lb2ecwJJJbAAAOi0lEQVR42uyaXYvaQBSGDxQqvZBgSwgVSpJtxBJSQQyKiKVSFZEgUm/8RO2FpVJtoTc9/75OMjEzk4y6212Ii8/NEnUT95mZc95JFs5S703WdquBBxrfu+txXrPgxlOjjxQDYzR+l9pw4+kYlLoopdDMwY0nwVxn8TSrPtx4dMwVXoBagRuPiq7ghSxNuPFolGuf8XIcF248DnUV78X3DNx4DPINvC/jW8D/f8oOPoBfA7gUa6Zpunf2a2ia1oaIweF4BizzwytzeD64v/FBFHS4BL1pZ4PPO2dK1BARGfX1w6ENLCR7PaNUO+/iAzHacJa6wiXSk95qiPgNIpaH4zq7CLKIRhmeC3MV8enUj8TEVF2AlNzh/Q5jNk/aCURMSaqC54LbPWW2oHbV79kTH6jDSRyMcQdyfh3eZ/ZpJTISTCO/Oxw/m0xVltX4gvNDo9PTyvUndxL9rZMN7xvGyPL1ZpYfV6vFqRZNcgWO2MjV9Zk/EIsMi0nrUG/ijPMz/1MZjgGkFCdZe00HgUHexiS6Hkj5E8X/5bKFPiVg6N8hZTglVWbbQMzOo+JDWHNLoEheZVDhgDdpBKNadQFGyJHWWx35xLgoWdGagglUQYbbodO8WPdF1gzEHTuYCjfapGdU2bEpIeHzgF0C+wTzrh0duldivt7AGGoGpGhLjPNDHlV8DBMo2529YArNEDkaGYCML5PSRSxkEUcQoJO1E6yEoRJCotCaXMQpfWshbnSoKATykkJI5y2msooin0vW6UWyQZFNDpJpBTN+DxGM+G0BBRoaWOR3zMh0bYXY5TNnzq85DCapeWRheErURPxWnl7opOSX/Bl0G0VWECEYiSzFqIa+bbsTXt2DJgmO0bfTf0SbK5UMSoL5b8fU707hOszrn1Hgtwtn8aoo0oMkSugTrQgrE9IG0Gjr7ZEOvadVbORP9M0iLDYq6bl0c9UmVQaoeWFj2wHKlZhfo8DOg0uYxKLlQj6pC0kZUzm+O6d1bx2cKNi39sJi0/S/pFEOrzpOMq8gNryrMm+iwNp6aJWqQQIKlZyQoxQoB71dA8r2OxJMmJKlF16kDVAJ88mQHCeZL5IvcFXmV2KY9OBSishjbCUbUiZ0mp9Z85rYIWo07bvkYzOabMhqMILRM+n6iZvf+8u1fj3mNbFkDOBiLDHZlyCOwsmddbg9QI/+mrACnaAG1oJiM6F7vew8KFXN0LzdDIl2g+pEuxLzO2FXb8I9cFvCI6qybGF0aJzsIsMYpmJrngedBqAfdNJaWIsy/ghZHZpghJ0UEJpZ9LH712B+IASbCdyLPfJUpPtjMzCf88mgTx7y9OcRnS6GwHEGVNJvCdahA6h0iyUxD3qV/jXFKzBfQo6hB1JevDtf6hWIocffCbf2OvTp3D9SOb4wJiNQp7fq6bHpBDWImv+dDwHKYLoMen36zdsX39748PorxHENvlgNpJeYMiWlEybNWdBbykIG/UEfRTV83VFDcgx/vKIOK7u10dim3XwOOWyQ8vbl37/vzy+aPMTohZkz9KurUT8u8C3WzPrjN6NbKDwcfgdKwT/ELkTm5Xe8+2k3P41Pebn4RPULg98MQAzLDktZqb215n2HFuPO9jhw2TwV32GC0Eio2c1ovCLzsuaTT7t5ha/y1knxkXr5Y49NwinaVLVAj61Wd3lT+7Oj4WQfPm4lZISGkZOb96JH5r20m+cnbPOUeJn6NnJoEOdPFuM4US0ScNhpYVh8w1iC1Pyf1uy4WOopN19HDv2EeLn6ArJMIYFefNZXLdmjwuWCzTmOkIhGMvPbKqKqk+S/QbTTnm34CVeQi2f4CAKVrDhh42gF4f7/SHrnbbUFStng/69mTi40Y8wb6hETPHKJ7K+dSk6vpd08/0cX5eIvVC+PR+Vpi/Hu5IChP2T6xMjiNgtGGSIOoeWXJJVlAPTh8SSV1O+k1pc8z/tJdF+s3gAZ+8lqaBjDO6fnisPSUzZ+xFmOXOGeUlXYDk/l5sGdGP5Zdnr67x7YyFKHRF69uZf6BTwEK2eadQ8EXJd7yXLd8umztCt/9gu4AlrI4sFjqNfhxnkayNABuFj9F7n6dD7lTxvIosI91H8CgZ6v/jn9392Tgixd+C/1/9q1t5YlgjgM4P/NMjdrE5NNW62gA4qUFggmlqWFiIgYphHRjUZF3RQdpm9f2bjPzsnZ6UARPVfvu8eZHzunXV99o/+3fl79G2N5XeZK//+Z/0W9jTv9D/fzfqNS6VbpzyTy6ScSduvThv9TI+w9+iX0t+TzMmqWlMhg1ORrtWercU5C2R0eEZLL7BIShfxiVSJ1/1u+n8cPyZzmWjxdjb8vifR1KDce9tku2cVooNZbPYNfhl4IK3r6JfRPScwJpuY8dm/PC3uCh11K5Nj3ahFSYLscITrCT3kj1K3Edsnz/XGeLUp10qbOgki4vJqj+5KwHCHdo4FYqy0lclSLdJLtQsL36I8DZ/qZQv/51GUX+UGTyQkKb93k2eywPPJo3CM1Q8YKPyAfFgImZzFQ5eddnfzpJPz8CDnT3yQpTx6Qg3y7zBAAdd3kyxmLPNLZkpzBtyv4zvLdR0yTcluQR5uU5R8n4LOsRL+A/riD/Izpk506ybPzVnmkUCMxa/Y1JVf5SpHpM4M8Nqny5/CG+D0qoCZspKdPLz9mpmTrTvJsbJVHmuJgu5yzrym+dZNvZJkpY8ijTSryZ+N5zVd4FuRM8Iuihd4u//pYIsPdY4N+8s3Ltue926AB93NO8tnILg96obO/Jo6DI15Cfiz/byPJVzvovwr55157tMA4NYU8z0KVv8GnlQ/es29pmeAZs9Db5T2S0oudhwPimb6Jt6WSh6ZZ/igR1fz6zSY6HEJyZT71kcZeJt5Ykl8znpPPiScTS/dDLo+MFXn+c9OL79EJqKnuOCz07vJ3MCghtRHj8ZzkWeuAPE8jnr8+pzgjVCK9fJ3xbGqEbLN4kyvJZyNF/vruE84nxtPVwV9lzErvLh++5o1T2jHDUOAiX1xa5am24QeficHCYtxr1NLLr/g5JRJS4e2n7HN55IQif1+AZ2s9vJU+7y7/Tr8kQInrTvJsZZdHLxE3s5tqq7HLR+AU08biSZDH1SFPVz7f/YD9QdcID3psRFrO8k3eUdZISi6LNptGvgxNq3zYEbvV2jFU4Uw6eTTLeYbkLHilEvJzbufL8rdPfVBbhQpvp3eU75WN512DRBr5h7wyr327PLV4cZdxw0MmaeVP4MJSvP3lIT/i9CtZ/gLgeY1keGd6uzwGqXJISrr8itV08kfrASRs8r2iUFqh23yTVp43yi2p6fP2B/kjJchCPoZBXvsqvDu9Xb6F2ip5xnappJSnlwwURnmUBtOPCRPipZP3ec8ckpqH/EFPyPf2bTInyT+X1xnoeH3oOtAb5JtHkRnRHfxizdRbtlPKxyuDftUij92r5O9ZSitexHTydb7IIiVxtdYJeaqgTQryJAtuzC9p3OkhL40m/Dl9SZoMOV5aeargl4c2+ZsJZI8T1jLcpp5Knp92lTTJx+tAyNM1LCME+a12dg54Mz2/CvLcWb5Emjx0k8dG5jnJN+P6DtESfoN8iDYpyNN5hR7wujwb8DVhkYkpR+nlRwd6m6Zjb4PZYidM29tgkC+GWJQOHHqbR6TJDPeEPE3RJgX5uiIzArwu/V0Bp4DHqjm1fF7pWpVKTlPLYzpXsMmv0KUOE83uPI61ykd8hO2Rmku4JuTRJqeCPLYjqwzgDfTjubK16iA/5VVTio8lop9aHlVmlXSzyjHRILnUn3DNKIU8lfeMani/0pLkQ352JxTlq8cUm4AdTL/ykCk5QofkZx7SIAr5HSbG+UEH9Q0IuaSXr/Z5H3At1UpqQLRGf4eZfSGN/HkcK6WBy0M+2SY3ojxN2S/IQ4f5PIq/IDlhf0+C+laxe6iVx0ShmObtwZn9FxEWZGiXMVqAVX7Ed+ZMc4MOSfJ4Y5QV5alkUS2urfCdqpv8TbxuEfOSJRpzR5zuYRI8EWVRU2aWR580i6d6w3039AzTXJv8AAOmGI/hIpBHm0Tw/rR5UDVb4QU1p1wnF3l8kih2ScgEL7DQMu7gNEy9Jdnca5t8XIni2/j2vNh4kN/a5WmhX8BEzzBayPI00ctT9cxheLLRt8lRnjb7SWqdEmnPcUE8pJ2eBBSEquwRi3wmfrzGuM75fa7iDa9FHuv+YEyJdI8x3FGQV9skIVH/ILyN/g45y1f3z+i89DYuRVy88+Ib73WNj0hzDA+yLK0OyC+PDAPGs8AXETXPQrs85mvDDPGEd8p7r6VW3n+tl6fBswPwNvpr5C5PE9ziaLsRRfXxiSDewmv0Nss3vNmGRN1rc8Cq8n5RJx9kv6bMkI6PUUaTmynko/hOwYmblWjZbV8qSs0f8ro2KUB0+2Z4jE92eLs8xlJTgq1wDBcMgNfTyVNLlVdzLIMvIrp0anZ5eh4wUzZkkKeVQZ4yjwzwNvoZucnjeiZ4DF2h1ug5CfK4l13+6hJfROYnhXDNVgp5apvo12SUXxYN8pRbqFMWz0pVxrVd5Wmkn8NuCalndaOKQT7KWuTnpR6WmlgLCVZn0sjTc/1IMSKzPLVM8lTbaOAt9I8a5CyPeB2mpBlRMpXXcou4SSZ5Gh+UL68z+zMx+0MGWFfb5SlqanoqjzTySBPyciavZXgL/dG39DPy1Jv1pd5gQlL8h+IBFTLLU1Mjr/w4/6ph1T3kdzgsD6yr0h1mPToojzZJavyhCm+mP/acrGl4u6DIsv3kaIx/ZlMhTbqFfW9fHOKOvrdLF8dho7fc/Yk0Evev8W0+IcLJNSJvlyn2VeJdiVQ28Tqo/3DSEwuNmygbDR3AGQO8+kvNlyH9miyn7Xz+SCV34AivlX+3HdBfl2p98i7f9iL6BanljwFes5s3/mAd0f/84tTenWTBhBCVPlv47/57MvWIzPQnxyH9z0/kC2L0+sRM2tKcAAAAAElFTkSuQmCC';
					} else if ( $theme == 'solutions' ) {
						print 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVwAAABUCAMAAAD57H/HAAABXFBMVEUAAABQm6RQm6RQm6RQm6RQm6T///9Qm6T///9Qm6RQm6RQm6RQm6T///9Qm6T///9Qm6RQm6RQm6RQm6RQm6RQm6T///9Qm6RQm6RQm6RQm6RQm6T///9Qm6RQm6RQm6RQm6T///9Qm6RQm6T///9Qm6T///9Qm6T///////9Qm6T///////9Qm6RQm6RQm6T///////////9Qm6T///////////9Qm6RQm6T///////////////////9Qm6T///9Qm6T///9Qm6RQm6RQm6T///9Qm6T+//////9Qm6T///////////////////////////9Qm6RQm6T///////////////9Qm6T///////9Qm6RQm6T////////////////////////////////////////////////////////c6+3///9Qm6SPv8Wv0dXE3uGbxsueyM1Qm6T////oMQF4AAAAcnRSTlMAYLEQwAXAHBDc8XAg+0/QCvrLoHcOA/bsaL5/Cvzi0lVOLAjsxbCGBufY1S8nt1pW8pdBOCTw54uHQvbeuph3bOKqpjEeGMtfSQ7EgXzZj2o8FKydcUc3E7SfkYs+LCgXWzOoIKWiZFIa0Kaj2tHP1W57CD47AAAOGElEQVR42uyb24vaQBSHf6Vgtw/BUtpAIVACIrHmwYoK3rA+iKLWlVpFwXu321361vP/QxNnx0lmkhhtixb8HnadzUX55njmnNHFQXS7Mx+1m1VyqDbbo3lnq+PKX8Bu1D+SQjXxeYsrf0SxX6NQmuUlrpyIbiboAL3cNT+cgp4bUAxqP656j6aSpZgMTFw5hvWIjqBexJXYbEp0FNUxrsTD+ElHM5viSgyKWTqB5hYxeRyPBlWiUjKfMxDJkIjSEHSc8TdA+ssM/w+LFJ1E9QFxsEckKJW7iGCqEWlrMTZKzvgGHupEtMF/g6nRqQxxEGsu3T5jIgJ3IhoQ3ErPstaIql38L2xOdss8RDPtkcJnhGM6x7MQNJxxW8obI/wvsLj9V7HbbR++xtiaG9O22MDKEFEBe3bXL8XYnatc2EQuzMJFrbKLULeZUX9Tse/ultuHxn1465ZDFN9IJQ8P+qausQSeNlke8J1RJJc5OC1n9NGAv0nvsyhh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';
					} else {
						print 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVwAAABUCAMAAAD57H/HAAABa1BMVEUAAAD///////////////////////////////////////////8ArYL///////////////////////////////8ArYIArYL///////8ArYL///8ArYIArYIArYL///////////////////8ArYL///////////////8ArYL////////////////////+//////////////////////8ArYL///8ArYL///////8ArYL///////8ArYIArYIArYL///8ArYL///8ArYL///8ArYIArYL///8ArYL///////8ArYL///8ArYL///8ArYL///////8ArYL///8BrYL///8ArYIArYIArYL///////////8ArYIArYL///8ArYL///////8ArYIArYIArYIArYL///////8ArYIArYIArYL///8ArYLl9/IHsIWy5tkXtI7w+vjq+PXY8uzO7+fB6+Gg4NALsYf///8ArYKtuQVgAAAAd3RSTlMAoA+w8WCQQMDRUID74P0g+TD1BQIQ5ewUy4okCFu53NfIlezFtVcK8+NMq25cSQznzKYmAr2zfGNNRTxpOqdwQBjUahS8cyoeEgydnZmVgnl4M90s98KLZxoHfG43IIV2YVQbgjoqdTJFHGb1597Y+vfu6eTZeH1Uc/8AABFUSURBVHja7Jp5WxJRFMaPSpqEAwmyGIXI4pIkIuKWJOKuqRkuuZBbpvYB7nz8rLl595k72MNf/P7xkYHH4Z1z3/uec4UWLVq0cIc/u1tI9vSiRzyJdGHa+w1a/A82coU8EujZyo5Di2cRzL4LIAW97z+EoEWjRF9FkC09q63ybYyN/l7kSGRvCFyzeX9TjoWHTXM4tVQ6urqGZ9CFLHK2V+cdPz8KTSRUjSAtRnLgir6PKz6TZen0DTRMD/rLFEgZsK5ugYrPuEhOoHnUkkibd37Q5s3OgSmjtAgNsov+YshvYtW66lGtr2CEqN8sxgLIBR7d4l3e8ZkqSmvQEJPI4hXIiAaIa8j4gCw+QLMYf49csqW1qt6mTBt8p0VohDTeXEFKwdY1oA27QhCaxPoAck0yCk7Et00HDhva2o6RRRfImLN1jSGPdfkzNIlaHjVAz6STJRyajoTvwD3tONS0gYycrWt4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';
					}
					print '" /></a></div>';
					print '<div class="lightbox-content">' . $lightbox_content . '</div>';
					print '</div>';
				}
			}
		}
		
		// restore original postdata
		wp_reset_postdata();
	
	}

}
add_action( 'wp_footer', 'get_lightbox' );

