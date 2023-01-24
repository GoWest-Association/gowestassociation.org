<?php

set_brand( 'association' );

get_header();

?>
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				global $post;
				?>

	<div class="page-title bg-<?php show_cmb_value( 'job_color' ); ?>">
		<h1><?php the_title() ?></h1>
	</div>

	<div class="content-wide job-single" role="main">

		<div class="job-info">
			<?php

			// display credit union name
			if ( has_cmb_value( 'job_company' ) ) { ?>
				<h5>Credit Union:</h5>
				<p><?php show_cmb_value( 'job_company' ); ?></p>
				<?php 
			}

			// display region
			if ( has_cmb_value( 'job_region' ) ) { ?>
				<h5>Region:</h5>
				<p><?php show_cmb_value( 'job_region' ) ?></p>
				<?php
			}

			// display job type
			if ( has_cmb_value( 'job_type' ) ) { ?>
				<h5>Type:</h5>
				<p><?php show_cmb_value( 'job_type' ) ?></p>
				<?php
			}

			// display job expiration date
			if ( has_cmb_value( 'job_expires' ) ) { ?>
				<h5>Closing:</h5>
				<p><?php print date( "n/j/Y", strtotime( get_cmb_value( 'job_expires' ) ) ) ?></p>
				<?php
			}

			// if we have a link, show that
			if ( has_cmb_value( 'job_apply_link' ) ) { ?>
				<div class="apply-link"><?php print do_shortcode( '[button url="' . get_cmb_value( 'job_apply_link' ) . '" class="' . get_cmb_value( 'job_color' ) . '" target="_blank"]Learn More[/button]' ); ?></div>
				<?php
			} else if ( has_cmb_value( 'job_contact_name' ) ) { // if there's no link, show contact information  ?>
				<h5>Apply</h5>
				<p><?php 
				print ( has_cmb_value( 'job_contact_name' ) ? "<strong>Contact:</strong> " . get_cmb_value( 'job_contact_name' ) . '<br>' : '' );
				print ( has_cmb_value( 'job_contact_email' ) ? '<strong>Email:</strong> <a href="mailto:' . get_cmb_value( 'job_contact_email' ) . '" target="_blank">' . get_cmb_value( 'job_contact_email' ) . '</a><br>' : '' );
				print ( has_cmb_value( 'job_contact_phone' ) ? '<strong>Phone:</strong> ' . get_cmb_value( 'job_contact_phone' ) . '<br>' : '' );
				print ( has_cmb_value( 'job_contact_fax' ) ? "<strong>Fax:</strong> " . get_cmb_value( 'job_contact_fax' ) . "<br>" : '' ); 
				?></p>
				<?php
			}

			?>

		</div>
		<p><strong>Job Description:</strong></p>
		<?php the_content(); ?>
		<br>
		<?php
		
		if ( has_cmb_value( 'job_education' ) ) { 
			print "<p><strong>Education/Experience Required:</strong></p>";
			print apply_filters( 'the_content', get_cmb_value( 'job_education' ) ) . "<br>";
		}

		if ( has_cmb_value( 'job_comments' ) ) { 
			print "<p><strong>Additional Comments:</strong></p>";
			print apply_filters( 'the_content', get_cmb_value( 'job_comments' ) ) . "<br>";
		}

		if ( user_owns_job( get_the_ID() ) ) { ?>
		<div class="job-editor">
			<?php edit_job_form(); ?>
		</div>
			<?php 
			}
			endwhile;
		endif;
		?>

	</div><!-- #primary -->
<?php

get_footer();

?>