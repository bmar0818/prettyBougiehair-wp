<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/**
 * Template Video
 * 
 * Access original fields: $args['mod_settings']
 * @author Themify
 */
if (TFCache::start_cache($args['mod_name'], self::$post_id, array('ID' => $args['module_ID']))):

    $fields_default = array(
        'mod_title_video' => '',
        'style_video' => '',
        'url_video' => '',
        'autoplay_video' => 'no',
        'width_video' => '',
        'unit_video' => 'px',
        'title_video' => '',
        'title_link_video' => false,
        'caption_video' => '',
        'css_video' => '',
        'animation_effect' => '',
	'o_i_c'=>'',
	'o_i'=>'',
	'o_w'=>'',
	'o_h' => '',
    );

    $fields_args = wp_parse_args($args['mod_settings'], $fields_default);
    unset($args['mod_settings']);
    $animation_effect = self::parse_animation_effect($fields_args['animation_effect'], $fields_args);
    if($fields_args['o_i_c']!==''){
	$fields_args['o_i_c'] = self::get_checkbox_data($fields_args['o_i_c']);
    }
    $video_maxwidth = $fields_args['width_video'] !== '' ? $fields_args['width_video'] . $fields_args['unit_video'] : '';
    $video_autoplay_css = $fields_args['autoplay_video'] === 'yes' ? 'video-autoplay' : '';
    $container_class = apply_filters('themify_builder_module_classes', array(
        'module', 'module-' . $args['mod_name'], $args['module_ID'], $fields_args['style_video'], $fields_args['css_video'], $animation_effect, $video_autoplay_css
                    ), $args['mod_name'], $args['module_ID'], $fields_args);
    if(!empty($args['element_id'])){
	$container_class[] = 'tb_'.$args['element_id'];
    }
    $container_props = apply_filters('themify_builder_module_container_props', array(
        'class' => implode(' ', $container_class),
            ), $fields_args, $args['mod_name'], $args['module_ID']);
    
    add_filter('oembed_result', array('TB_Video_Module', 'modify_youtube_embed_url'), 10, 3);
    ?>

    <!-- module video -->
    <div <?php echo self::get_element_attributes(self::sticky_element_props($container_props,$fields_args)); ?>>
        <?php if ($fields_args['mod_title_video'] !== ''): ?>
            <?php echo $fields_args['before_title'] . apply_filters('themify_builder_module_title', $fields_args['mod_title_video'], $fields_args). $fields_args['after_title']; ?>
        <?php endif; ?>
        <div class="video-wrap"<?php echo '' !== $video_maxwidth ? ' style="max-width:' . $video_maxwidth . ';"' : ''; ?>>
	    <?php
	    $url = esc_url( $fields_args['url_video'] );
	    if($fields_args['o_i_c']!=='1' || $fields_args['o_i']===''){
		$video = wp_oembed_get( $url);
		if ($video) {
		    $video = str_replace(array('frameborder="0"','?&'), array('','&'), $video );
		    if ($fields_args['autoplay_video'] === 'yes') {
			$video = preg_replace_callback('/src=["\'](http[^"\']*)["\']/', array('TB_Video_Module', 'autoplay_callback'), $video);
		    }
		    echo $video;
		} else {
		    global $wp_embed;
		    $video = $wp_embed->run_shortcode('[embed]' . $fields_args['url_video'] . '[/embed]');
		    if ($video) {
			if ($fields_args['autoplay_video'] === 'yes') {
			    $video = str_replace('src', 'autoplay="on" src', $video);
			}
		       echo apply_filters('themify_builder_module_content',$video);
		    }
		}
	    }
	    else{
		?>
		    <div class="tb_video_overlay" data-href="<?php echo $url?>">
			<span class="tb_video_play"></span>
			<?php echo themify_get_image(array('src'=>$fields_args['o_i'],'w' => $fields_args['o_w'],'alt'=>$fields_args['title_video'], 'h' => $fields_args['o_h'], 'ignore' => true))?>
		    </div>
		<?php
	    }
            ?>
        </div>
        <!-- /video-wrap -->

        <?php if ('' !== $fields_args['title_video'] || '' !== $fields_args['caption_video']): ?>
            <div class="video-content">
                <?php if ('' !== $fields_args['title_video']): ?>
                    <h3 class="video-title"<?php if(Themify_Builder::$frontedit_active && !$fields_args['title_link_video']):?> contenteditable="false" data-name="title_video"<?php endif;?>>
                        <?php if ($fields_args['title_link_video']) : ?>
                            <a<?php if(Themify_Builder::$frontedit_active):?> contenteditable="false" data-name="title_video"<?php endif;?> href="<?php echo esc_url($fields_args['title_link_video']); ?>"><?php echo $fields_args['title_video']; ?></a>
                        <?php else: ?>
                        <?php echo $fields_args['title_video']; ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ('' !== $fields_args['caption_video']): ?>
                    <div class="video-caption tb_text_wrap"<?php if(Themify_Builder::$frontedit_active):?> contenteditable="false" data-name="caption_video"<?php endif;?>>
                        <?php echo apply_filters('themify_builder_module_content', $fields_args['caption_video']); ?>
                    </div>
                    <!-- /video-caption -->
                <?php endif; ?>
            </div>
            <!-- /video-content -->
        <?php endif; ?>
    </div>
    <!-- /module video -->
    <?php remove_filter('oembed_result', array('TB_Video_Module', 'modify_youtube_embed_url'), 10, 3); ?>
<?php endif; ?>
<?php TFCache::end_cache(); ?>