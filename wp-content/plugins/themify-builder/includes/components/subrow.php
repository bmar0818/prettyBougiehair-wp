<?php

class Themify_Builder_Component_Subrow extends Themify_Builder_Component_Base {

    public function get_name() {
	return 'subrow';
    }

    public function get_form_settings($onlyStyle=false) {
	$styles = $this->get_styling();
	if($onlyStyle===true){
	    return $styles;
	}
	$row_form_settings = array(
	    'styling' => array(
		'name' => __('Sub Row Styling', 'themify'),
		'options' => $styles
	    ),
	    'visibility' => true,
	    'animation' => true
	);
	return apply_filters('themify_builder_subrow_lightbox_form_settings', $row_form_settings);
    }

    /**
     * Get template Sub-Row.
     * 
     * @param int $rows 
     * @param int $cols 
     * @param int $index 
     * @param array $mod 
     * @param string $builder_id 
     * @param boolean $echo 
     */
    public static function template($rows, $cols, $index, $mod, $builder_id, $echo = false) {
	$print_sub_row_classes = $subrow_tag_attrs =  array();
	$count = 0;
	$video_data = '';
	$is_styling = !empty($mod['styling']);
	if ($is_styling) {
	    if (!empty($mod['styling']['background_repeat'])) {
		$print_sub_row_classes[] = $mod['styling']['background_repeat'];
	    }
	    if (isset($mod['styling']['background_type']) && $mod['styling']['background_type'] === 'image' && isset($mod['styling']['background_zoom']) && $mod['styling']['background_zoom'] === 'zoom' && $mod['styling']['background_repeat'] === 'repeat-none') {
		$print_sub_row_classes[] = 'themify-bg-zoom';
	    }
	    $class_fields = array('custom_css_subrow', 'background_repeat', 'animation_effect', 'row_height', 'hover_animation_effect');
	    $is_active = !Themify_Builder::$frontedit_active && Themify_Builder_Model::is_animation_active();
	    foreach ($class_fields as $field) {
		if (!empty($mod['styling'][$field])) {
		    if ($is_active === false) {
			$print_sub_row_classes[] = $mod['styling'][$field];
		    } else {
			if ('animation_effect' === $field) {
			    $print_sub_row_classes[] = 'wow';
			    $print_sub_row_classes[] = $mod['styling']['animation_effect'];
			} elseif ('hover_animation_effect' === $field) {
			    $print_sub_row_classes[] = 'hover-wow hover-animation-' . $mod['styling'][$field];
			}
		    }
		}
	    }
	    if (!empty($mod['styling']['animation_effect_delay'])) {
		$print_sub_row_classes[] = 'animation_effect_delay_' . $mod['styling']['animation_effect_delay'];
	    }
	    if (!empty($mod['styling']['animation_effect_repeat'])) {
		$print_sub_row_classes[] = 'animation_effect_repeat_' . $mod['styling']['animation_effect_repeat'];
	    }
	    // background video
	    $video_data = self::get_video_background($mod['styling']);
	}
	if (!Themify_Builder::$frontedit_active) {
	    $count = !empty($mod['cols']) ? count($mod['cols']) : 0;
	    $print_sub_row_classes[] = 'sub_row_' . $rows . '-' . $cols . '-' . $index;
	    $row_content_classes = array();
	    if (!empty($mod['gutter']) && $mod['gutter'] !== 'gutter-default') {
		$row_content_classes[] = $mod['gutter'];
	    }
	    if (!empty($mod['column_h'])) {
		$row_content_classes[] = 'col_auto_height';
	    }
	    $row_content_classes[] = !empty($mod['column_alignment']) ? $mod['column_alignment'] : (function_exists('themify_theme_is_fullpage_scroll') && themify_theme_is_fullpage_scroll() ? 'col_align_middle' : 'col_align_top');

	    if ($count > 0) {
		$row_content_attr = self::get_directions_data($mod, $count);
		$order_classes = self::get_order($count);
		$is_phone = themify_is_touch('phone');
		$is_tablet = !$is_phone && themify_is_touch('tablet');
		$is_right = false;
		if ($is_tablet) {
		    $is_right = isset($row_content_attr['data-tablet_dir']) || isset($row_content_attr['data-tablet_landscape_dir']);
		    if (isset($row_content_attr['data-col_tablet']) || isset($row_content_attr['data-col_tablet_landscape'])) {
			$row_content_classes[] = isset($row_content_attr['data-col_tablet_landscape']) ? $row_content_attr['data-col_tablet_landscape'] : $row_content_attr['data-col_tablet'];
		    }
		} elseif ($is_phone) {
		    $is_right = isset($row_content_attr['data-mobile_dir']);
		    if (isset($row_content_attr['data-col_mobile'])) {
			$row_content_classes[] = $row_content_attr['data-col_mobile'];
		    }
		} else {
		    $is_right = isset($row_content_attr['data-desktop_dir']);
		}
		if ($is_right) {
		    $row_content_classes[] = 'direction-rtl';
		    $order_classes = array_reverse($order_classes);
		}
	    }

	    $row_content_classes = implode(' ', $row_content_classes);
	    if (isset($mod['element_id'])) {
		$print_sub_row_classes[] = 'tb_' . $mod['element_id'];
	    }
	    if($is_styling){
		$subrow_tag_attrs = self::sticky_element_props($subrow_tag_attrs,$mod['styling']);
	    }
	    
	}
	$print_sub_row_classes = apply_filters('themify_builder_subrow_classes', $print_sub_row_classes, $mod, $builder_id);
	$print_sub_row_classes = implode(' ', $print_sub_row_classes);
	$subrow_tag_attrs['class'] = 'themify_builder_sub_row module_subrow clearfix ' . esc_attr($print_sub_row_classes);
	$subrow_tag_attrs = apply_filters('themify_builder_subrow_attributes',$subrow_tag_attrs , $is_styling ? $mod['styling'] : array(), $builder_id);



	if (!$echo) {
	    $output = PHP_EOL; // add line break
	    ob_start();
	}
	// Start Sub-Row Render ######
	?>
	<div <?php echo self::get_element_attributes($subrow_tag_attrs); ?> <?php echo $video_data ?>>
	    <?php
	    if ($is_styling) {
		$mod['row_order'] = $index;
		$sub_row_order = $rows . '-' . $cols . '-' . $index;
		do_action('themify_builder_background_styling', $builder_id, $mod, $sub_row_order, 'subrow');
		self::background_styling($mod, 'subrow');
		self::show_frame($mod['styling']);
	    }
	    ?>
	    <div class="subrow_inner<?php if (!Themify_Builder::$frontedit_active): ?> <?php echo $row_content_classes ?><?php endif; ?>" <?php if (!empty($row_content_attr)): ?> <?php echo self::get_element_attributes($row_content_attr) ?><?php endif; ?>>
		<?php
		if ($count > 0) {
		    foreach ($mod['cols'] as $col_key => $sub_col) {
			Themify_Builder_Component_Column::template_sub_column($rows, $cols, $index, $col_key, $sub_col, $builder_id, $order_classes, true);
		    }
		}
		?>
	    </div>
	</div><!-- /themify_builder_sub_row -->
	<?php
	// End Sub-Row Render ######

	if (!$echo) {
	    $output .= ob_get_clean();
	    // add line break
	    $output .= PHP_EOL;
	    return $output;
	}
    }

}
