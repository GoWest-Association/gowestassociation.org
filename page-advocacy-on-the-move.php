<?php

/*
Template Name: Advocacy on the Move
*/

set_brand( 'association' );

get_header();

if ( show_title() ) {
	?>
<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>
	<?php
}

if ( is_member() ) {

	if ( has_introduction() ) {
		?>
	<div class="content-wide" role="main">
		<?php 

		if ( show_breadcrumbs() ) breadcrumbs();

		the_introduction();

		?>
	</div><!-- #content -->
		<?php
	}

	the_icons();

	the_page_events_row();

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			if ( !empty( get_the_content() ) ) {
		?>
		<div class="content-wide" role="main">
			<?php
			if ( !has_introduction() && show_breadcrumbs() ) {
				breadcrumbs();
			}

			the_content();
			
			?>
		</div>
		<?php
			}
		endwhile;
	endif;
	?>
	<div class="page-articles">
		<h2>On The Move</h2>
		<div class="filtering">
			<label><input type="checkbox" name="arizona" value="Arizona" class="arizona-filter" /> Arizona</label>
			<label><input type="checkbox" name="colorado" value="Colorado" class="colorado-filter" /> Colorado</label>
			<label><input type="checkbox" name="idaho" value="Idaho" class="idaho-filter" /> Idaho</label>
			<label><input type="checkbox" name="oregon" value="Oregon" class="oregon-filter" /> Oregon</label>
			<label><input type="checkbox" name="washington" value="Washington" class="washington-filter" /> Washington</label>
			<label><input type="checkbox" name="wyoming" value="Wyoming" class="wyoming-filter" /> Wyoming</label>
			<label><input type="checkbox" name="regulatory" value="Regulatory" class="regulatory-filter" /> Regulatory</label>
			<a href="#subscribe" class="btn green">Get Updates</a>
		</div>
	<?php
			
	$args = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => '35',
			),
		),
		'posts_per_page' => 60
	);
	$query = new WP_Query( $args );

	// Check that we have query results.
	if ( $query->have_posts() ) {

		$return = '<div class="article-cards aotm-listing">';

		// Start looping over the query results.
		while ( $query->have_posts() ) {
			$query->the_post();
			$return .= '<div class="entry' . 
				( in_category(259) ? ' arizona' : '' ) . 
				( in_category(260) ? ' colorado' : '' ) . 
				( in_category(249) ? ' idaho' : '' ) . 
				( in_category(36) ? ' oregon' : '' ) . 
				( in_category(250) ? ' washington' : '' ) . 
				( in_category(261) ? ' wyoming' : '' ) . 
				( in_category(251) ? ' regulatory' : '' ) . 
			'">';
			$return .= '<div class="entry-thumbnail">';
			$return .= '<a href="' . get_the_permalink() . '">';
			$return .= get_the_post_thumbnail( null, array( 768, 480 ) );
			$return .= '</a>';
			$return .= '</div>';
			$return .= '<div class="entry-inner">';
			$return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
			$return .= wpautop( get_the_excerpt() );
			$return .= '</div>';
			$return .= '</div>';
		}

		$return .= '</div>';

	}
	print $return;
	?>
	</div>
	<a name="subscribe"></a>
		<div class="content-wide subscribe-form">
			<div class="aotm-title">
					<h2>Stay up to date on Advocacy!</h2>
					<p>Sign up for daily or weekly updates.</p>
			</div>
			<div class="aotm-subscribe">
	<!-- Begin MailChimp Signup Form -->
	<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
		/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
		We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
	</style>
	<div id="mc_embed_signup">
	<form action="https://nwcua.us17.list-manage.com/subscribe/post?u=c400b6f955643963baa013b6b&amp;id=bb0b3f82bb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		<div id="mc_embed_signup_scroll">
		
	<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
	<div class="mc-field-group">
		<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
	</label>
		<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
	</div>
	<div class="mc-field-group">
		<label for="mce-FNAME">First Name  <span class="asterisk">*</span>
	</label>
		<input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
	</div>
	<div class="mc-field-group">
		<label for="mce-LNAME">Last Name </label>
		<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
	</div>
	<div class="mc-field-group input-group">
		<strong>Frequency  <span class="asterisk">*</span>
	</strong>
		<ul><li><input type="radio" value="Daily" name="FREQ" id="mce-FREQ-0"><label for="mce-FREQ-0">Daily</label></li>
	<li><input type="radio" value="Weekly" name="FREQ" id="mce-FREQ-1"><label for="mce-FREQ-1">Weekly</label></li>
	</ul>
	</div>
	<div class="mc-address-group">
		<div class="mc-field-group">
			<label for="mce-ADDRESS-addr1">Address </label>
			<input type="text" value="" maxlength="70" name="ADDRESS[addr1]" id="mce-ADDRESS-addr1" class="">
		</div>
		<div class="mc-field-group">
			<label for="mce-ADDRESS-addr2">Address Line 2</label>
			<input type="text" value="" maxlength="70" name="ADDRESS[addr2]" id="mce-ADDRESS-addr2">		
		</div>
		<div class="mc-field-group size1of2">
			<label for="mce-ADDRESS-city">City</label>
			<input type="text" value="" maxlength="40" name="ADDRESS[city]" id="mce-ADDRESS-city" class="">
		</div>
		<div class="mc-field-group size1of2">
			<label for="mce-ADDRESS-state">State/Province/Region</label>
		<input type="text" value="" maxlength="20" name="ADDRESS[state]" id="mce-ADDRESS-state" class="">
		</div>
		<div class="mc-field-group size1of2">
			<label for="mce-ADDRESS-zip">Postal / Zip Code</label>
			<input type="text" value="" maxlength="10" name="ADDRESS[zip]" id="mce-ADDRESS-zip" class="">
		</div>
		<div class="mc-field-group size1of2">
			<label for="mce-ADDRESS-country">Country</label>
			<select name="ADDRESS[country]" id="mce-ADDRESS-country" class=""><option value="">Select a country</option><option value="164" selected>USA</option><option value="286">Aaland Islands</option><option value="274">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="178">American Samoa</option><option value="4">Andorra</option><option value="5">Angola</option><option value="176">Anguilla</option><option value="175">Antigua And Barbuda</option><option value="6">Argentina</option><option value="7">Armenia</option><option value="179">Aruba</option><option value="8">Australia</option><option value="9">Austria</option><option value="10">Azerbaijan</option><option value="11">Bahamas</option><option value="12">Bahrain</option><option value="13">Bangladesh</option><option value="14">Barbados</option><option value="15">Belarus</option><option value="16">Belgium</option><option value="17">Belize</option><option value="18">Benin</option><option value="19">Bermuda</option><option value="20">Bhutan</option><option value="21">Bolivia</option><option value="325">Bonaire, Saint Eustatius and Saba</option><option value="22">Bosnia and Herzegovina</option><option value="23">Botswana</option><option value="181">Bouvet Island</option><option value="24">Brazil</option><option value="180">Brunei Darussalam</option><option value="25">Bulgaria</option><option value="26">Burkina Faso</option><option value="27">Burundi</option><option value="28">Cambodia</option><option value="29">Cameroon</option><option value="30">Canada</option><option value="31">Cape Verde</option><option value="32">Cayman Islands</option><option value="33">Central African Republic</option><option value="34">Chad</option><option value="35">Chile</option><option value="36">China</option><option value="185">Christmas Island</option><option value="37">Colombia</option><option value="204">Comoros</option><option value="38">Congo</option><option value="183">Cook Islands</option><option value="268">Costa Rica</option><option value="275">Cote D'Ivoire</option><option value="40">Croatia</option><option value="276">Cuba</option><option value="298">Curacao</option><option value="41">Cyprus</option><option value="42">Czech Republic</option><option value="318">Democratic Republic of the Congo</option><option value="43">Denmark</option><option value="44">Djibouti</option><option value="289">Dominica</option><option value="187">Dominican Republic</option><option value="45">Ecuador</option><option value="46">Egypt</option><option value="47">El Salvador</option><option value="48">Equatorial Guinea</option><option value="49">Eritrea</option><option value="50">Estonia</option><option value="51">Ethiopia</option><option value="189">Falkland Islands</option><option value="191">Faroe Islands</option><option value="52">Fiji</option><option value="53">Finland</option><option value="54">France</option><option value="193">French Guiana</option><option value="277">French Polynesia</option><option value="56">Gabon</option><option value="57">Gambia</option><option value="58">Georgia</option><option value="59">Germany</option><option value="60">Ghana</option><option value="194">Gibraltar</option><option value="61">Greece</option><option value="195">Greenland</option><option value="192">Grenada</option><option value="196">Guadeloupe</option><option value="62">Guam</option><option value="198">Guatemala</option><option value="270">Guernsey</option><option value="63">Guinea</option><option value="65">Guyana</option><option value="200">Haiti</option><option value="66">Honduras</option><option value="67">Hong Kong</option><option value="68">Hungary</option><option value="69">Iceland</option><option value="70">India</option><option value="71">Indonesia</option><option value="278">Iran</option><option value="279">Iraq</option><option value="74">Ireland</option><option value="323">Isle of Man</option><option value="75">Israel</option><option value="76">Italy</option><option value="202">Jamaica</option><option value="78">Japan</option><option value="288">Jersey  (Channel Islands)</option><option value="79">Jordan</option><option value="80">Kazakhstan</option><option value="81">Kenya</option><option value="203">Kiribati</option><option value="82">Kuwait</option><option value="83">Kyrgyzstan</option><option value="84">Lao People's Democratic Republic</option><option value="85">Latvia</option><option value="86">Lebanon</option><option value="87">Lesotho</option><option value="88">Liberia</option><option value="281">Libya</option><option value="90">Liechtenstein</option><option value="91">Lithuania</option><option value="92">Luxembourg</option><option value="208">Macau</option><option value="93">Macedonia</option><option value="94">Madagascar</option><option value="95">Malawi</option><option value="96">Malaysia</option><option value="97">Maldives</option><option value="98">Mali</option><option value="99">Malta</option><option value="207">Marshall Islands</option><option value="210">Martinique</option><option value="100">Mauritania</option><option value="212">Mauritius</option><option value="241">Mayotte</option><option value="101">Mexico</option><option value="102">Moldova, Republic of</option><option value="103">Monaco</option><option value="104">Mongolia</option><option value="290">Montenegro</option><option value="294">Montserrat</option><option value="105">Morocco</option><option value="106">Mozambique</option><option value="242">Myanmar</option><option value="107">Namibia</option><option value="108">Nepal</option><option value="109">Netherlands</option><option value="110">Netherlands Antilles</option><option value="213">New Caledonia</option><option value="111">New Zealand</option><option value="112">Nicaragua</option><option value="113">Niger</option><option value="114">Nigeria</option><option value="217">Niue</option><option value="214">Norfolk Island</option><option value="272">North Korea</option><option value="116">Norway</option><option value="117">Oman</option><option value="118">Pakistan</option><option value="222">Palau</option><option value="282">Palestine</option><option value="119">Panama</option><option value="219">Papua New Guinea</option><option value="120">Paraguay</option><option value="121">Peru</option><option value="122">Philippines</option><option value="221">Pitcairn</option><option value="123">Poland</option><option value="124">Portugal</option><option value="126">Qatar</option><option value="315">Republic of Kosovo</option><option value="127">Reunion</option><option value="128">Romania</option><option value="129">Russia</option><option value="130">Rwanda</option><option value="205">Saint Kitts and Nevis</option><option value="206">Saint Lucia</option><option value="324">Saint Martin</option><option value="237">Saint Vincent and the Grenadines</option><option value="132">Samoa (Independent)</option><option value="227">San Marino</option><option value="255">Sao Tome and Principe</option><option value="133">Saudi Arabia</option><option value="134">Senegal</option><option value="326">Serbia</option><option value="135">Seychelles</option><option value="136">Sierra Leone</option><option value="137">Singapore</option><option value="302">Sint Maarten</option><option value="138">Slovakia</option><option value="139">Slovenia</option><option value="223">Solomon Islands</option><option value="140">Somalia</option><option value="141">South Africa</option><option value="257">South Georgia and the South Sandwich Islands</option><option value="142">South Korea</option><option value="311">South Sudan</option><option value="143">Spain</option><option value="144">Sri Lanka</option><option value="293">Sudan</option><option value="146">Suriname</option><option value="225">Svalbard and Jan Mayen Islands</option><option value="147">Swaziland</option><option value="148">Sweden</option><option value="149">Switzerland</option><option value="285">Syria</option><option value="152">Taiwan</option><option value="260">Tajikistan</option><option value="153">Tanzania</option><option value="154">Thailand</option><option value="233">Timor-Leste</option><option value="155">Togo</option><option value="232">Tonga</option><option value="234">Trinidad and Tobago</option><option value="156">Tunisia</option><option value="157">Turkey</option><option value="158">Turkmenistan</option><option value="287">Turks &amp; Caicos Islands</option><option value="159">Uganda</option><option value="161">Ukraine</option><option value="162">United Arab Emirates</option><option value="262">United Kingdom</option><option value="163">Uruguay</option><option value="165">Uzbekistan</option><option value="239">Vanuatu</option><option value="166">Vatican City State (Holy See)</option><option value="167">Venezuela</option><option value="168">Vietnam</option><option value="169">Virgin Islands (British)</option><option value="238">Virgin Islands (U.S.)</option><option value="188">Western Sahara</option><option value="170">Yemen</option><option value="173">Zambia</option><option value="174">Zimbabwe</option></select>
		</div>
	</div>
	<div class="mc-field-group">
		<label for="mce-CU">Credit Union </label>
		<input type="text" value="" name="CU" class="" id="mce-CU">
	</div>
		<div id="mce-responses" class="clear">
			<div class="response" id="mce-error-response" style="display:none"></div>
			<div class="response" id="mce-success-response" style="display:none"></div>
		</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c400b6f955643963baa013b6b_bb0b3f82bb" tabindex="-1" value=""></div>
		<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
		</div>
	</form>
	</div>
	<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[4]='FREQ';ftypes[4]='radio';fnames[5]='ADDRESS';ftypes[5]='address';fnames[6]='CU';ftypes[6]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
	<!--End mc_embed_signup-->
			</div>
		</div>
	<?php

	the_footer_buttons();

}

get_footer();

