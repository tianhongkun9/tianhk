<?php
/*
* Plugin Options
*/
function dew_admin_options() 
{
	add_menu_page("Advanced Dewplayer", "Advanced Dewplayer", "manage_options", "dew_player_options", "dew_admin");
}

add_action('admin_menu', 'dew_admin_options');

function dew_options_enqueue_scripts( $page ) {

		wp_register_script( 'dew-upload', plugins_url('admin-panel/upload.js',dirname(__FILE__)), array('jquery','media-upload','thickbox') );
		wp_enqueue_script('jquery');	
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('dew-upload');
		 
		 if(function_exists(' get_current_screen'))
		 {
			if (is_dew_screen())
			{        
				wp_enqueue_style('dew-css',plugins_url('admin-panel/dew-design.css',dirname(__FILE__)), false, '1.0', 'screen' );
			}
		}
		else if(isset($_GET['page']) && ($_GET['page'] == 'dew_player_options'))
		{
			wp_enqueue_style('dew-css',plugins_url('admin-panel/dew-design.css',dirname(__FILE__)), false, '1.0', 'screen' );
		}
		else
		{}
}
add_action('admin_enqueue_scripts', 'dew_options_enqueue_scripts');

function is_dew_screen() {
	$screen = get_current_screen();
	if (is_object($screen) && $screen->id == 'toplevel_page_dew_player_options') {
		return true;
	} else {
		return false;
	}
}


function dew_admin()
{
?>
<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Advanced Dewplayer Settings'); ?></h2>
		<?php settings_errors(); ?>
		
		<form method="post" action="options.php">
			<?php
			
					settings_fields( 'dew_display_options' );
					do_settings_sections( 'dew_display_options' );
							
				submit_button();
			
			?>
		</form>
		<div style="float:right; padding-right: 10px; font-family:calibri; color: #0066FF; font-size:14px;">Developed By <a href="" target="_blank" title="visit westerndeal" style="text-decoration:none; ">WesternDeal</a></div>
	</div><!-- /.wrap -->
		
<?php
}

function dew_default_display_options() {
	
	$defaults = array(
		'max_rows'		=>	'',
		'table_width'		=>	'',
		'header_height'		=>	'',
		'row_height'		=>	'',
		'table_header_color'		=>	'',
		'primary_row_color' => '',
		'alt_row_color' => '',
		'show_no_column' => '1',
		'show_size_column' => '1',
		'show_duration_column' => '1',
		'header_name_for_no' => 'No',
		'header_name_for_name' => 'Name',
		'header_name_for_player' => 'Play',
		'header_name_for_size' => 'Size',
		'header_name_for_duration' => 'Length',
		'header_name_for_download' => 'Download',
		 'download_img' => plugins_url('admin-panel/img/download.png',dirname(__FILE__)),
		'img_preview' => '',
	);
	
	return apply_filters( 'dew_default_display_options', $defaults );
	
}


function dew_initialize_theme_options() {	
 
 	// If the theme options don't exist, create them.
	if( false == get_option( 'dew_display_options' ) ) {	
		add_option( 'dew_display_options', apply_filters( 'dew_default_display_options', dew_default_display_options() ) );
	} // end if

	add_settings_section(
		'dew_settings_section',	
		'',	
		'dew_options_callback',
		'dew_display_options'
	);
	
//	add_settings_field(	
//		'folder_path',	
//		'Folder Path',
//		'folder_path_callback',
//		'dew_display_options',
//		'dew_settings_section',
//		array(
//			__( 'define folder path to play songs', 'dew' ),
//		)
//	);
	
	add_settings_field(	
		'max_rows',	
		'Maximum Rows',
		'max_rows_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'define max. number of rows in table', 'dew' ),
		)
	);
	
	add_settings_field(	
		'table_width',	
		'Table Width',
		'table_width_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'define width for table in % or px (include % or px with value)', 'dew' ),
		)
	);
	
	add_settings_field(	
		'header_height',	
		'Header Height',
		'header_height_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'define height for table header in % or px (include % or px with value)', 'dew' ),
		)
	);

	add_settings_field(	
		'row_height',	
		'Row Height',
		'row_height_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'define height for table rows in % or px (include % or px with value)', 'dew' ),
		)
	);
	
	add_settings_field(	
		'table_header_color',						
		'Table Header Color',				
		'table_header_color_callback',	
		'dew_display_options',		
		'dew_settings_section',			
		array(								
			__( 'define color for table header', 'dew' ),
		)
	);
	
	add_settings_field(	
		'primary_row_color',						
		'Primary Row Color',				
		'primary_row_color_callback',	
		'dew_display_options',		
		'dew_settings_section',			
		array(								
			__( 'define color for alternate table rows', 'dew' ),
		)
	);


	add_settings_field(	
		'alt_row_color',						
		'Alt Row Color',				
		'alt_row_color_callback',	
		'dew_display_options',		
		'dew_settings_section',			
		array(								
			__( 'define color for alternate table rows', 'dew' ),
		)
	);
	

	add_settings_field(	
		'show_no_column',						
		'Show Number Column',				
		'show_no_column_callback',	
		'dew_display_options',					
		'dew_settings_section',			
		array(								
			__( 'check if to show number column in table', 'dew' ),
		)
	);
	
	add_settings_field(	
		'show_size_column',						
		'Show Size Column',				
		'show_size_column_callback',	
		'dew_display_options',					
		'dew_settings_section',			
		array(								
			__( 'check if to show size column in table', 'dew' ),
		)
	);

	add_settings_field(	
		'show_duration_column',						
		'Show Duration Column',				
		'show_duration_column_callback',	
		'dew_display_options',					
		'dew_settings_section',			
		array(								
			__( 'check if to show duration column in table', 'dew' ),
		)
	);

	add_settings_field(	
		'header_name_for_no',
		'Number Column Header',
		'header_name_for_no_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'name for number column header', 'dew' ),
		)
	);

	add_settings_field(	
		'header_name_for_name',	
		'Name Column Header',
		'header_name_for_name_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'name for "name" column header', 'dew' ),
		)
	);


	add_settings_field(	
		'header_name_for_player',
		'Player Column Header',
		'header_name_for_player_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'name for player column header', 'dew' ),
		)
	);


	add_settings_field(	
		'header_name_for_size',
		'Size Column Header',	
		'header_name_for_size_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'name for size column header', 'dew' ),
		)
	);


	add_settings_field(	
		'header_name_for_duration',	
		'Duration Column Header',
		'header_name_for_duration_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'name for duration column header', 'dew' ),
		)
	);

	add_settings_field(	
		'header_name_for_download',
		'Download Column Header',
		'header_name_for_download_callback',
		'dew_display_options',
		'dew_settings_section',
		array(
			__( 'name for duration column header', 'dew' ),
		)
	);
	
	add_settings_field(	
		'download_img',						
		'Download Image',				
		'download_img_callback',	
		'dew_display_options',		
		'dew_settings_section',			
		array(
			__( 'upload download link image', 'dew' ),							
		)
	);
	
	add_settings_field(
	'img_preview',  
	'Download Image Preview', 
	'img_preview_callback', 
	'dew_display_options', 
	'dew_settings_section',
	array(								
			__( 'uploaded imge preview', 'dew' ),
		)
	);  


	// Finally, we register the fields with WordPress
	register_setting(
		'dew_display_options',
		'dew_display_options'
	);
	
} 
add_action( 'admin_init', 'dew_initialize_theme_options' );

function dew_options_callback()
{
}

//function folder_path_callback($args) {
//    $options = get_option( 'dew_display_options' );
//    echo '<input type="text" id="folder_path" name="dew_display_options[folder_path]" value="' . $options['folder_path'] . '" class="nice" />';
//    echo '<div class="descr">'.$args[0].'</div>';
//}

function max_rows_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	

	echo '<input type="text" id="max_rows" name="dew_display_options[max_rows]" value="' . $options['max_rows'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function table_width_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="table_width" name="dew_display_options[table_width]" value="' . $options['table_width'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function header_height_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_height" name="dew_display_options[header_height]" value="' . $options['header_height'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function row_height_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="row_height" name="dew_display_options[row_height]" value="' . $options['row_height'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function table_header_color_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	echo '<input type="text" id="table_header_color" name="dew_display_options[table_header_color]" value="' . $options['table_header_color'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function alt_row_color_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	echo '<input type="text" id="alt_row_color" name="dew_display_options[alt_row_color]" value="' . $options['alt_row_color'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function primary_row_color_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	echo '<input type="text" id="primary_row_color" name="dew_display_options[primary_row_color]" value="' . $options['primary_row_color'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function show_no_column_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	$html = '<input type="checkbox" id="show_no_column" name="dew_display_options[show_no_column]" value="1"' . checked( 1, $options['show_no_column'], false ) . '/>';
	echo $html;
	echo '<span class="descr">'.$args[0].'</span>';

} 

function show_size_column_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	$html = '<input type="checkbox" id="show_size_column" name="dew_display_options[show_size_column]" value="1"' . checked( 1, $options['show_size_column'], false ) . '/>';
	echo $html;
	echo '<span class="descr">'.$args[0].'</span>';

} 


function show_duration_column_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	$html = '<input type="checkbox" id="show_duration_column" name="dew_display_options[show_duration_column]" value="1"' . checked( 1, $options['show_duration_column'], false ) . '/>';
	echo $html;
	echo '<span class="descr">'.$args[0].'</span>';

} 

function header_name_for_no_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_name_for_no" name="dew_display_options[header_name_for_no]" value="' . $options['header_name_for_no'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function header_name_for_name_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_name_for_name" name="dew_display_options[header_name_for_name]" value="' . $options['header_name_for_name'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 


function header_name_for_player_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_name_for_player" name="dew_display_options[header_name_for_player]" value="' . $options['header_name_for_player'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 


function header_name_for_size_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_name_for_size" name="dew_display_options[header_name_for_size]" value="' . $options['header_name_for_size'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 


function header_name_for_duration_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_name_for_duration" name="dew_display_options[header_name_for_duration]" value="' . $options['header_name_for_duration'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 


function header_name_for_download_callback($args) {
	
	$options = get_option( 'dew_display_options' );
	
	
	echo '<input type="text" id="header_name_for_download" name="dew_display_options[header_name_for_download]" value="' . $options['header_name_for_download'] . '" class="nice" />';
	echo '<div class="descr">'.$args[0].'</div>';
} 

function download_img_callback($args) {
	
  $options = get_option( 'dew_display_options' );  
   ?>  
        <input type="text" id="download_img" name="dew_display_options[download_img]" value="<?php echo esc_url( $options['download_img'] ); ?>" class="nice" />
        <input id="upload_logo_button" type="button" class="button" value="<?php echo 'Upload Image'; ?>"/><span class="descr"><?php echo $args[0]; ?></span>
<?php  
	}  
	
	function img_preview_callback($args) {
	$options = get_option( 'dew_display_options' );  ?>
	<div id="img_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $options['download_img'] ); ?>" />
		<span class="descr"><?php echo $args[0]; ?></span>
	</div>
	<?php
	
}

// uploading...
function dew_options_setup() {
	global $pagenow;

	if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
		// Now we'll replace the 'Insert into Post Button' inside Thickbox
		add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
	}
}
add_action( 'admin_init', 'dew_options_setup' );

function replace_thickbox_text($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos( wp_get_referer(), 'dew_player_options' );
		if ( $referer != '' ) {
			return __('yep ! use this image', 'dew' );
		}
	}
	return $translated_text;
}
?>