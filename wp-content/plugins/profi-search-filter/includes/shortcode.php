<?php
	$fields = get_option( 'sf-fields' );
	foreach( $fields as $field )
		if( $field['name'] == $attr['id'] )
			break;
			
?>
<!-- Search Filter: <?php echo $attr['id']; ?>-->
<div class="sf-wrapper">
	<style>
	<?php if( isset( $field['columns'] ) ): ?>
	<?php if( $field['columns'] == 2 ): ?>
	ul.sf-result > li{
		margin: 2% 0;
		margin-right: 2%;
		float: left; 
		width: 49%;
	}

	ul.sf-result > li:nth-child(2n){
		margin-right: 0;
	}

	
	ul.sf-result > li:nth-child(2n+1){
		clear: both;
	}
	<?php elseif( $field['columns'] == 3 ): ?>
	ul.sf-result > li{
		margin: 2% 0;
		margin-right: 2%;
		float: left; 
		width: 32%;
	}

	ul.sf-result > li:nth-child(3n){
		margin-right: 0;
	}

	
	ul.sf-result > li:nth-child(3n+1){
		clear: both;
	}
	<?php elseif( $field['columns'] == 4 ): ?>
	ul.sf-result > li{
		margin: 2% 0;
		margin-right: 2%;
		float: left; 
		width: 23.5%;
	}

	ul.sf-result > li:nth-child(4n){
		margin-right: 0;
	}

	
	ul.sf-result > li:nth-child(4n+1){
		clear: both;
	}
	<?php endif; ?>
	<?php endif; ?>
	<?php if( isset( $field['border'] ) ): ?>
	.sf-result li{
		border: 1px solid <?php echo $field['border']; ?>;
	}
	<?php endif; ?>
	<?php if( isset( $field['background'] ) ): ?>
	.sf-result li{
		background: <?php echo $field['background']; ?>;
	}
	
	ul.sf-nav > li > span.sf-nav-click{
		background: <?php echo $field['background']; ?>;
	}
	<?php endif; ?>
	<?php if( isset( $field['highlightcolor'] ) ): ?>
	.sf-selected{
		background-color: <?php echo $field['highlightcolor']; ?>;
	}
	<?php endif; ?>
	
	
	ul.sf-result > li.sf-noresult{
		float: none;
		width: 100%;
		margin: 0;
	}
	
	<?php 
	if( isset( $field['custom_css'] ) && trim( $field['custom_css'] ) != '' ):
		echo stripslashes( $field['custom_css'] );
	endif;
	?>
	</style>
	<script>
		var sf_columns = <?php if( isset( $field['columns'] ) ) echo $field['columns']; else echo 1;?>;
	</script>
	<div class="sf-filter">
		<?php apply_filters( 'sf-before-form', '' ); ?>
		<?php if( defined( 'ICL_LANGUAGE_CODE' )  ):
			global $sitepress; ?>
			<input type="hidden" name="wpml" value="<?php echo $sitepress->get_current_language(); ?>" />
		<?php endif; ?>
		<input type="hidden" name="search-id" value="<?php echo $field['name']; ?>" />
		<?php foreach( $field['fields'] as $key => $element ):
			if( $element['type'] == 'hidden' )
				continue;
				
			if( isset( $element['datasource'] ) ):
				preg_match_all( '^(.*)\[(.*)\]^', $element['datasource'], $match );
				$data_type = $match[1][0];
				$data_value = $match[2][0];
			else:
				$data_type = '';
				$data_value = '';
			endif;
		
		$class_hide = "";
		$style_hide = "";
		$cond_key = "";
		$cond_value = "";
		if( isset( $element['cond_key'] ) ):
			$cond_key = $element['cond_key'];
			$cond_value = $element['cond_value'];
			if( ( $element['cond_key'] != -1 || !empty( $element['cond_key'] ) ) && !empty( $element['cond_value'] ) ):
				$class_hide= "-hide";
				$style_hide = 'style="display:none;"';
			endif;
		endif;
			
		?>
		<?php
		if( $element['type'] == 'btnsearch' || $element['type'] == 'btnreset' ):
		?><button class="sf-button-<?php echo $element['type']; ?>"><?php echo $element['fieldname']; ?></button>
		<?php
		else:
		?>
		<fieldset data-id="<?php echo $key; ?>" <?php  echo $style_hide . 'data-condkey="' . $cond_key . '" data-condval="'  . $cond_value .  '"'; ?> class="sf-element<?php echo $class_hide; ?> <?php echo $element['type']; ?>">
			<legend><?php echo $element['fieldname']; ?></legend>	
		<?php	
			if( $element['type'] == 'hierarchical-taxonomies' ):
					$args = array(
						'orderby'		=> 'name', 
						'order'			=> 'ASC',
						'hide_empty'	=> true
					);
					$terms = get_terms( $data_value, $args );
					$terms = create_hierarchical_select( $terms );
					ksort( $terms );
					foreach( $terms as $tkey => $tval ):
						if( $tkey != 0 ):
							$n = get_term_by( 'id', $tkey, $data_value );
							$n = $n->name;
						endif;
						
						if( isset( $n ) ):
							$select_label = preg_replace( '^%name%^', $n, $element['select_label'] );
						else:
							$select_label = preg_replace( '^%name%^', $element['fieldname'], $element['select_label'] );
						endif;
						
					?>
						<select id="sf-field-<?php echo $key; ?>" data-taxkey="<?php echo $tkey; ?>" name="<?php echo $key; ?>" <?php if( $tkey != 0 ): echo 'style="display:none;"'; endif; ?>>
							<option value=""><?php echo $select_label; ?></option><?php echo $tval; ?>
						</select>
					<?php
					endforeach;
			
			elseif( $element['type'] == 'select' ):
			?>
			<select id="sf-field-<?php echo $key; ?>" name="<?php echo $key; ?>"><option value=""><?php if( isset( $element['all_options'] ) ) echo $element['all_options']; ?></option><?php
				if( $data_type == 'tax' && $element['options'] == 'auto' ):
					$args = array(
						'orderby'		=> 'name', 
						'order'			=> 'ASC',
						'hide_empty'	=> true
					);
					$terms = get_terms( $data_value, $args );
					if( isset( $element['hierarchical'] ) && $element['hierarchical'] == 1 ):
						$terms = order_terms_hierarchical( $terms, $element['hierarchical_symbol_to_indent'] );
					endif;
					
					
					foreach( $terms as $term ):
					?><option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option><?php
					endforeach;
				elseif( $data_type == 'meta' && $element['options'] == 'auto' ):
					$values = get_postmeta_values( $data_value );
					foreach( $values as $val ):
					?>
					<option value="<?php echo $val->meta_value; ?>"><?php echo $val->meta_value; ?></option>					
					<?php
					endforeach;
				elseif( $element['options'] == 'individual' ):
					foreach( $element['option_key'] as $option_key => $val ):
					?>
					<option value="<?php echo $val; ?>"><?php echo $element['option_val'][$option_key]; ?></option>
					<?php
					endforeach;
				elseif( $data_type == 'others' ):
					if( $data_value == 'author' ):
						$args = array(
							'who'	=>	'authors'
						);
						$authors = apply_filters( 'sf-get-authors', get_users( $args ) );
						foreach( $authors as $author ):
						?>
						<option value="<?php echo $author->ID; ?>"><?php echo $author->data->display_name; ?></option>
						<?php
						endforeach;
					endif;
					if( $data_value == 'pub_d' ):
						$days = sf_get_all_dates( $field['posttype'], 'DAY', 'post_date' );
						foreach( $days as $d ):
						?>
						<option value="<?php echo $d->date; ?>"><?php echo $d->date; ?></option>
						<?php
						endforeach;
					endif;
					if( $data_value == 'pub_m' ):
						$months = sf_get_all_dates( $field['posttype'], 'MONTH', 'post_date' );
						foreach( $months as $m ):
						?>
						<option value="<?php echo $m->date; ?>"><?php echo $m->date; ?></option>
						<?php
						endforeach;
					endif;
					if( $data_value == 'pub_y' ):
						$years = sf_get_all_dates( $field['posttype'], 'YEAR', 'post_date' );
						foreach( $years as $y ):
						?>
						<option value="<?php echo $y->date; ?>"><?php echo $y->date; ?></option>
						<?php
						endforeach;
					endif;
					
					
					if( $data_value == 'mod_d' ):
						$days = sf_get_all_dates( $field['posttype'], 'DAY', 'post_modified' );
						foreach( $days as $d ):
						?>
						<option value="<?php echo $d->date; ?>"><?php echo $d->date; ?></option>
						<?php
						endforeach;
					endif;
					if( $data_value == 'mod_m' ):
						$months = sf_get_all_dates( $field['posttype'], 'MONTH', 'post_modified' );
						foreach( $months as $m ):
						?>
						<option value="<?php echo $m->date; ?>"><?php echo $m->date; ?></option>
						<?php
						endforeach;
					endif;
					if( $data_value == 'mod_y' ):
						$years = sf_get_all_dates( $field['posttype'], 'YEAR', 'post_modified' );
						foreach( $years as $y ):
						?>
						<option value="<?php echo $y->date; ?>"><?php echo $y->date; ?></option>
						<?php
						endforeach;
					endif;
				endif;
				
			?></select><?php
			elseif( $element['type'] == 'map' ):
				?>
				<script id="google-script"></script>
				<script>
					window.onload = function(){
						if( typeof google == 'undefined' ){
							document.getElementById( 'google-script' ).src = "http://maps.googleapis.com/maps/api/js?key=<?php echo $element['apikey']; ?>&sensor=false&callback=sf_loadmap"
						} else {
							sf_loadmap();
						}
					};
				</script>
				<div class="sf-map-wrapper" data-index="<?php echo $key; ?>" data-lat="<?php echo $element['center_lat']; ?>" data-style="<?php echo $element['style']; ?>" data-lon="<?php echo $element['center_lon']; ?>" data-zoom="<?php echo $element['zoom']; ?>"></div>
				<?php
			elseif( $element['type'] == 'input' ):
				?>
				<input placeholder="<?php echo $element['fieldname']; ?>" id="sf-field-<?php echo $key; ?>" name="<?php echo $key; ?>" />
				<?php	
			elseif( $element['type'] == 'checkbox' ):
			?>
				<div class="sf-checkbox-wrapper">
				<?php 
					if( $element['options'] == 'individual' ): ?>
						<?php foreach( $element['option_key'] as $option_key => $val ):
						?>
						<label><input type="checkbox" value="<?php echo $val; ?>" name="<?php echo $key; ?>[]" /> <?php echo $element['option_val'][$option_key]; ?></label>
						<?php
						endforeach;
			
					elseif( $data_type == 'tax' && $element['options'] == 'auto' ):
						$args = array(
							'orderby'       => 'name', 
							'order'         => 'ASC',
							'hide_empty'    => true
						);
						$terms = get_terms( $data_value, $args );
						foreach( $terms as $term ): 
							?>
							<label><input type="checkbox" value="<?php echo $term->term_id; ?>" name="<?php echo $key; ?>[]" /> <?php echo $term->name; ?></label>
							<?php 
						endforeach;
					elseif( $data_type == 'meta' && $element['options'] == 'auto' ):
						$values = get_postmeta_values( $data_value );
						foreach( $values as $val ):
						?>
						<label><input type="checkbox" value="<?php echo $val->meta_value; ?>" name="<?php echo $key; ?>[]" /> <?php echo $val->meta_value; ?></label>
						<?php
						endforeach;
					elseif( $data_type == 'others' ):
						if( $data_value == 'author' ):
							$args = array(
								'who'	=>	'authors'
							);
							$authors = apply_filters( 'sf-get-authors', get_users( $args ) );
							foreach( $authors as $author ):
							?>
							<label><input type="checkbox" value="<?php echo $author->ID; ?>" name="<?php echo $key; ?>[]" /> <?php echo $author->data->display_name ?></label>
							<?php
							endforeach;
						endif;
					endif; ?>
				</div>
			<?php
			elseif( $element['type'] == 'fulltext' ):
			?>
				<div class="sf-fulltext-wrapper">
					<input placeholder="<?php echo $element['fieldname']; ?>" name="<?php echo $key; ?>" />
				</div>
			<?php
			elseif( $element['type'] == 'orderby' ): ?>
				<select name="orderby">
				<?php foreach( $element['orderby'] as $ek => $e ): ?>
					<option value="<?php echo $e; ?>"><?php echo $element['orderbylabel'][ $ek ]; ?></option>
				<?php endforeach; ?>				
				</select>
			<?php
			elseif( $element['type'] == 'radiobox' ):
			?>
				<div class="sf-radiobox-wrapper">
				<?php 
					if( $element['options'] == 'individual' ): ?>
						<?php foreach( $element['option_key'] as $option_key => $val ):
						?>
						<label><input type="radio" value="<?php echo $val; ?>" name="<?php echo $key; ?>" /> <?php echo $element['option_val'][$option_key]; ?></label>
						<?php
						endforeach;
			
					elseif( $data_type == 'tax' && $element['options'] == 'auto' ):
						$args = array(
							'orderby'       => 'name', 
							'order'         => 'ASC',
							'hide_empty'    => true
						);
						$terms = get_terms( $data_value, $args );
						foreach( $terms as $term ): 
							?>
							<label><input type="radio" value="<?php echo $term->term_id; ?>" name="<?php echo $key; ?>" /> <?php echo $term->name; ?></label>
							<?php 
						endforeach;
					elseif( $data_type == 'meta' && $element['options'] == 'auto' ):
						$values = get_postmeta_values( $data_value );
						foreach( $values as $val ):
						?>
						<label><input type="radio" value="<?php echo esc_attr( $val->meta_value ); ?>" name="<?php echo $key; ?>" /> <?php echo $val->meta_value; ?></label>					
						<?php
						endforeach;
					
					elseif( $data_type == 'others' ):
						if( $data_value == 'author' ):
							$args = array(
								'who'	=>	'authors'
							);
							$authors = apply_filters( 'sf-get-authors', get_users( $args ) );
							foreach( $authors as $author ):
							?>
							<label><input type="radio" value="<?php echo $author->ID; ?>" name="<?php echo $key; ?>[]" /> <?php echo $author->data->display_name ?></label>
							<?php
							endforeach;
						endif;
					endif; ?>
				</div>
			<?php
			elseif( $element['type'] == 'date' ):
				wp_enqueue_script( 'jquery-ui-datepicker' );
				if( isset( $element['ui'] ) && $element['ui'] != 'none' )
					wp_enqueue_style('sf-datepicker-css',
						'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/' . $element['ui'] . '/jquery-ui.css',
						false,
						SF_CURRENT_VERSION,
						false);
			?>
				<input placeholder="<?php _e( 'From', 'sf' );?>" data-dateformat="<?php echo $element['dateformat']; ?>" class="sf-date <?php if( isset( $element['searchtype'] ) && $element['searchtype'] == 'between' ): echo 'sf-date2 first'; endif; ?>" name="<?php echo $key; ?>[]" />
			<?php
				if( isset( $element['searchtype'] ) && $element['searchtype'] == 'between' ):
				?>
				<input placeholder="<?php _e( 'To', 'sf' );?>" data-dateformat="<?php echo $element['dateformat']; ?>" class="sf-date sf-date2 second" name="<?php echo $key; ?>[]" />
				<?php
				endif;
			elseif( $element['type'] == 'range' ):
			?>
			<div class="sf-range-wrapper" data-title="<?php echo esc_attr( $element['fieldname'] ); ?>" data-source="<?php echo $key; ?>" data-step="<?php if( isset( $element['step'] ) ) echo $element['step']; else echo '1'; ?>" data-start="<?php echo $element['start_range']; ?>" data-unitfront="<?php if( isset( $element['unit_front'] ) && $element['unit_front'] == 1 ) echo '1'; else echo '0'; ?>" data-end="<?php echo $element['end_range']; ?>" data-unit="<?php echo $element['unit']; ?>"></div>
			<?php
			endif;
		?>
		</fieldset>
		<?php
		endif;
		endforeach; ?>		
	</div>
	<?php apply_filters( 'sf-after-form', '' ); ?>
			<?php
			if( isset( $attr['showall'] ) ):
				unset( $_POST['data'] );
				$_POST['data']['search-id'] = $attr['id'];
				$results = sf_do_search();
			endif;
		?>
		
	<?php if( !isset( $field['head'] ) || $field['head'] == 1 ): ?>
	<div class="sf-result-head">
		<?php
			if( isset( $results ) ):				
					echo $results['head'];
			endif;
		?>
	
	</div>
	<?php apply_filters( 'sf-after-result-head', '' ); ?>
	<?php endif; ?>
	<ul class="sf-result">
		<?php
			if( isset( $results ) ):				
				foreach( $results['result'] as $r )
					echo $r;
			endif;
		?>
	</ul>	
	<?php apply_filters( 'sf-after-results', '' ); ?>
	<ul class="sf-nav">
		<?php
			if( isset( $results ) ):				
				foreach( $results['nav'] as $r )
					echo $r;
			endif;
		?>
	
	</ul>	
	<?php apply_filters( 'sf-after-navigation', '' ); ?>
</div>

		<?php
			if( isset( $results ) ):				
				?>
				<script>sf_adjust_elements_waitimg();</script>
				<?php
			endif;
		?>
		
	<?php
		if( isset( $results['args'] ) ):
	?><p>Debug Mode</p>
	<pre>Args:
<?php print_r( $results['args'] ); ?>
Query:
<?php print_r( $results['query'] ); ?></pre>
	<?php endif; ?>