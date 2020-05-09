<div class="wrap">
	
	<h1>Taxonomy Manager</h1>

	<?php 

		settings_errors(); 

		if( isset($_POST["edit_taxonomy"]) ) echo $_POST["edit_taxonomy"];
	
	?>

	<ul class="nav nav-tabs">
		<li class="<?php echo !isset( $_POST["edit_taxonomy"] ) ? 'active' : ''; ?>"><a href="#tab-1">Your Custom Taxonomy</a></li>
		<li class="<?php echo isset( $_POST["edit_taxonomy"] ) ? 'active' : ''; ?>">
			<a href="#tab-2">
				<?php echo isset( $_POST["edit_taxonomy"] ) ? 'Edit' : 'Add'?> Custom Taxonomy
			</a>
		</li>
		<li><a href="#tab-3">Export</a></li>
	</ul>

	<div class="tab-content">

		<div id="tab-1" class="tab-pane <?php echo !isset( $_POST["edit_taxonomy"] ) ? 'active' : '' ?>">
			<h3>Manage Your Custom Taxonomy</h3>

			<?php
				$options = get_option('magnet_plugin_tax') ?: array();

				echo '<table class="cpt-table"><tr class="text-center"><th >ID</th><th>Singular Name</th><th>Hierarchical</th><th>Actions</th></tr>';

				foreach ( $options as $option ) {

					$hierarchical = isset( $option['hierarchical'] ) ? "TRUE" : "FALSE";
					
					echo "<tr><td>{$option['taxonomy']}</td><td>{$option['singular_name']}</td><td class=\"text-center\">{$hierarchical}</td><td class=\"text-center\">";

					echo '<form method="post" action="" class="inline-block">';
					echo '<input type="hidden" name="edit_taxonomy" value="' . $option['taxonomy'] . '">';
					submit_button( 'Edit', 'primary small', 'submit', false );
					echo '</form> ';

					echo '<form method="post" action="options.php" class="inline-block">';
					settings_fields( 'magnet_plugin_tax_settings' );
					echo '<input type="hidden" name="remove" value="' . $option['taxonomy'] . '">';
					submit_button( 'Delete', 'delete small', 'submit', false, array(
						'onclick' => 'return confirm("Are you sure you want to delete this Taxonomy? The data associated with it will not be deleted.");'
					)); 
					echo '</form></td></tr>';
				}
				echo '</table>';
			?>

		</div> 

		<div id="tab-2" class="tab-pane <?php echo isset( $_POST['edit_taxonomy'] ) ? 'active' : '' ?> ">
			<h3>Create a new Custom Taxonomy</h3>
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'magnet_plugin_tax_settings' );
					do_settings_sections( 'magnet_taxonomy' );
					submit_button();
				?>
			</form>			
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>Export your Custom Taxonomy </h3>
				
			

		</div>

	</div>

</div>