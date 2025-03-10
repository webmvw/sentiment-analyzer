<?php

/**
 * Provide a admin area view for the plugin
 */
?>

<div class="wrap">
	<?php settings_errors(); ?>
	<form action="options.php" method="post">
		<?php
		settings_fields( 'primary_settings_group' );
		do_settings_sections( 'mr_primary_settings_page' );
		submit_button( 'Save Changes');
		?>
	</form>
</div>
