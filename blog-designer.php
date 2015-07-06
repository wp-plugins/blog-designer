<?php
/**
  Plugin Name: Blog Designer
  Plugin URI:http://www.solwininfotech.com/
  Description: To make your blog design more attractive and colorful.
  Author: Solwin Infotech
  Author URI: http://www.solwininfotech.com/
  Version: 1.5
  License: GPLv2 or later
 */
add_action('admin_menu', 'wp_blog_designer_add_menu');
add_action('admin_init', 'wp_blog_designer_reg_function');
add_action('admin_init', 'wp_blog_designer_admin_stylesheet');
add_action('init', 'wp_blog_designer_front_stylesheet');
add_action('admin_init', 'wp_blog_designer_scripts');
add_action('wp_head', 'wp_blog_designer_stylesheet', 20);
add_shortcode('wp_blog_designer', 'wp_blog_designer_views');

register_activation_hook(__FILE__, 'wp_blog_designer_activate');

function wp_blog_designer_add_menu() {
    add_menu_page('Blog designer', 'Blog designer', 'administrator', 'designer_settings', 'wp_blog_designer_menu_function');
    add_submenu_page('designer_settings', 'Blog designer Settings', 'Settings', 'manage_options', 'designer_settings', 'wp_blog_designer_add_menu');
}

function wp_blog_designer_reg_function() {

    if ('posts' == get_option('show_on_front') && '0' == get_option('page_on_front')) {
        update_option("show_on_front", 'page');
        update_option("page_on_front", 2);

        $templates = array();
        $templates['ID'] = 2;
        $templates['post_content'] = '[wp_blog_designer]';
        wp_update_post($templates);
    }

    $settings = get_option("wp_blog_designer_settings");
    if (empty($settings)) {
        $settings = array(
            'template_category' => '',
            'template_name' => 'classical',
            'template_bgcolor' => '#ffffff',
            'template_ftcolor' => '#58d658',
            'template_titlecolor' => '#1fab8e',
            'template_contentcolor' => '#7b95a6',
            'template_readmorecolor' => '#2376ad',
            'template_readmorebackcolor' => '#dcdee0',
            'template_alterbgcolor' => '#ffffff',
            'template_titlebackcolor' => '#ffffff'
        );

        add_option("wp_blog_designer_settings", $settings, '', 'yes');
    }
}

if ($_REQUEST['action'] === 'save' && $_REQUEST['updated'] === 'true') {

    update_option("page_on_front", $_POST['page_on_front']);
    update_option("posts_per_page", $_POST['posts_per_page']);
    update_option("rss_use_excerpt", $_POST['rss_use_excerpt']);
    update_option("display_date", $_POST['display_date']);
    update_option("display_author", $_POST['display_author']);
    update_option("display_category", $_POST['display_category']);
    update_option("display_tag", $_POST['display_tag']);

    update_option("excerpt_length", $_POST['txtExcerptlength']);    
    update_option("read_more_text", $_POST['txtReadmoretext']);
    
    update_option("template_alternativebackground", $_POST['template_alternativebackground']);
    
    update_option("social_icon_style", $_POST['social_icon_style']);
    update_option("facebook_link", $_POST['facebook_link']);
    update_option("twitter_link", $_POST['twitter_link']);
    update_option("google_link", $_POST['google_link']);
    update_option("dribble_link", $_POST['dribble_link']);
    update_option("pinterest_link", $_POST['pinterest_link']);
    update_option("instagram_link", $_POST['instagram_link']);
    update_option("linkedin_link", $_POST['linkedin_link']);


    $o_templates = array();
    $o_templates['ID'] = 2;
    $o_templates['post_content'] = '';
    wp_update_post($o_templates);

    $templates = array();
    $templates['ID'] = $_POST['page_on_front'];
    $templates['post_content'] = '[wp_blog_designer]';
    wp_update_post($templates);

    $settings = $_POST;
    $settings = is_array($settings) ? $settings : unserialize($settings);
    $updated = update_option("wp_blog_designer_settings", $settings);
}

function wp_blog_designer_activate() {
    
}

function wp_blog_designer_admin_stylesheet() {

    $adminstylesheetURL = plugins_url('css/admin.css', __FILE__);
    $adminstylesheet = dirname(__FILE__) . '/css/admin.css';

    $colorpickerstylesheetURL = plugins_url('css/colorpicker.css', __FILE__);
    $colorpickerstylesheet = dirname(__FILE__) . '/css/colorpicker.css';

    
    if (file_exists($adminstylesheet)) {

        wp_register_style('wp-blog-designer-admin-stylesheets', $adminstylesheetURL);
        wp_enqueue_style('wp-blog-designer-admin-stylesheets');
    }

    if (file_exists($colorpickerstylesheet)) {

        wp_register_style('wp-blog-designer-colorpicker-stylesheets', $colorpickerstylesheetURL);
        wp_enqueue_style('wp-blog-designer-colorpicker-stylesheets');
    }

    
}
function wp_blog_designer_front_stylesheet(){
        
    $fontawesomeiconURL = plugins_url('css/font-awesome.min.css', __FILE__);
    $fontawesomeicon = dirname(__FILE__) . '/css/font-awesome.min.css';
    
    if (file_exists($fontawesomeicon)) {

        wp_register_style('wp-blog-designer-fontawesome-stylesheets', $fontawesomeiconURL);
        wp_enqueue_style('wp-blog-designer-fontawesome-stylesheets');
    }
    
}

function wp_blog_designer_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('cpicker', plugins_url('/js/cpicker.js', __FILE__), '1.2');
    wp_enqueue_script('eye', plugins_url('/js/eye.js', __FILE__), '2.0');    
    wp_enqueue_script('designer', plugins_url('/js/designer.js', __FILE__), '1.0.2');
}

function wp_blog_designer_stylesheet() {

    if (!is_admin()) {
        $stylesheetURL = plugins_url('css/designer_css.php', __FILE__);
        $stylesheet = dirname(__FILE__) . '/css/designer_css.php';

        if (file_exists($stylesheet)) {
            wp_register_style('wp-blog-designer-stylesheets', $stylesheetURL);
            wp_enqueue_style('wp-blog-designer-stylesheets');
        }
    }
}

function continue_reading_link_temp() {
    return ' <a href="' . esc_url(get_permalink()) . '">' . __('Read more', 'twentyeleven') . '</a>';
}

function auto_excerpt_more_template($more) {
    return ' &hellip;' . continue_reading_link_temp();
}

add_filter('excerpt_more', 'auto_excerpt_more_template');

function custom_excerpt_length($length) {
    
    if (get_option('excerpt_length') != '') {
        
        return get_option('excerpt_length');
        
    } else {
        
        return 50;
    }
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function wp_blog_designer_views() {

    $settings = get_option("wp_blog_designer_settings");

    if (!isset($settings['template_name']) || empty($settings['template_name'])) {
        return '[wp_blog_designer] ' . __('Invalid shortcode', 'wp_blog_designer') . '';
    }

    $theme = $settings['template_name'];
    $cat = $settings['template_category'];

    if (!empty($cat)) {
        foreach ($cat as $catObj):
            $category .= $catObj . ',';
        endforeach;
        $cat = rtrim($category, ',');
    }else {
        $cat = '';
    }

    $posts_per_page = get_option('posts_per_page');
    $paged = lumiapaged();

    $posts = query_posts(array('cat' => $cat, 'posts_per_page' => $posts_per_page, 'paged' => $paged));
    $alter= 1;
    while (have_posts()) : the_post();
        if ($theme == 'classical') {
            wp_classical_template();
        } elseif ($theme == 'lightbreeze') {            
            if(get_option('template_alternativebackground') == 0){
                if($alter % 2 == 0){
                        $alter_class = ' alternative-back';
                }else{
                    $alter_class = ' ';
                }
            }
            $class = ' lightbreeze';
            wp_lightbreeze_template($alter_class);
            $alter ++;
        } elseif ($theme == 'spektrum') {
            
            $class = ' spektrum';
            wp_spektrum_template();
        } elseif ($theme == 'evolution') {
            if(get_option('template_alternativebackground') == 0){
                if($alter % 2 == 0){
                        $alter_class = ' alternative-back';
                }else{
                    $alter_class = ' ';
                }
            }
            $class = ' evolution';
            wp_evolution_template($alter_class);
            $alter ++;
        }
    endwhile;

    echo '<div class="wl_pagination_box' . $class . '">';
    lumia_pagination();
    echo '</div>';

    wp_reset_query();
}

/* * **************************** display function for classical layout ************************************ */

function wp_classical_template() {
    ?>

    <div class="blog_template classical">
        <div class="blog_header">
            <?php the_post_thumbnail('full'); ?>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <div class="metadatabox">                            
                <?php
                $display_date = get_option('display_date');
                $display_author = get_option('display_author');
                if ($display_author == 0 && $display_date == 0) {
                    ?> 

                    <div class="icon-date"></div>Posted by <span><?php the_author(); ?></span> on <?php the_time(__('F d, Y')); ?>

                <?php } elseif ($display_author == 1 && $display_date == 1) { ?>                                                                                                           
                <?php } elseif ($display_author == 0) { ?>
                    <div class="icon-date"></div>Posted by <span><?php the_author(); ?></span>
                <?php } elseif ($display_date == 0) { ?>
                    <div class="icon-date"></div>Posted on <?php the_time(__('F d, Y')); ?>
                <?php }
                ?>
                <div class="metacomments">
                    <i class="fa fa-comment"></i><?php comments_popup_link('0', '1', '%'); ?>
                </div>
            </div>
            <?php if (get_option('display_category') == 0) { ?>
                <span class="category-link">
                    Category: 
                    <?php
                    $categories_list = get_the_category_list(__(', ', 'twentyeleven'));
                    if ($categories_list):
                        printf(__(' %2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $categories_list);
                        $show_sep = true;
                    endif;
                    ?>
                </span>
            <?php } ?>
            <?php
            if (get_option('display_tag') == 0) {
                $tags_list = get_the_tag_list('', __(', ', 'twentyeleven'));
                if ($tags_list):
                    ?>
                    <div class="tags">
                        <div class="icon-tags"></div>
                        <?php
                        printf(__('%2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list);
                        $show_sep = true;
                        ?>
                    </div>
                <?php endif;
            } ?>
        </div>
        <div class="post_content">
            <?php if (get_option('rss_use_excerpt') == 0): ?>
                <?php the_content(); ?>
            <?php else: ?>
                <?php
                the_excerpt(__('Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve'));
                if (get_option('read_more_text') != '') {
                    echo '<a class="more-tag" href="' . get_permalink($post->ID) . '">' . get_option('read_more_text') . ' </a>';
                } else {
                    echo ' <a class="more-tag" href="' . get_permalink($post->ID) . '">Read More</a>';
                }
                ?>

            <?php endif; ?>
        </div>
        <div class="social-component">
            <?php if (get_option('facebook_link') == 0): ?>
                <a href="<?php echo 'https://www.facebook.com/dialog/share?&href=' . get_the_permalink(); ?>" target= _blank class="facebook-share"><i class="fa fa-facebook"></i></a>
            <?php endif; ?>
            <?php if (get_option('twitter_link') == 0): ?>
                <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="twitter"><i class="fa fa-twitter"></i></a>
            <?php endif; ?>
            <?php if (get_option('google_link') == 0): ?>
                <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="google"><i class="fa fa-google-plus"></i></a>
            <?php endif; ?>
            <?php if (get_option('linkedin_link') == 0): ?>
                <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="linkedin"><i class="fa fa-linkedin"></i></a>
            <?php endif; ?>
            <?php if (get_option('instagram_link') == 0): ?>
                <a href="<?php echo 'mailto:enteryour@addresshere.com?subject=Share and Follow&body=' . get_the_permalink(); ?>" target= _blank class="instagram"><i class="fa fa-envelope-o"></i></a>
            <?php endif; ?>        
            <?php if (get_option('pinterest_link') == 0): ?>
                <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="pinterest"> <i class="fa fa-pinterest"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/* * **************************** display function for lightbreeze layout ************************************ */

function wp_lightbreeze_template($alterclass) {
    ?>

    <div class="blog_template box-template active <?php echo $alterclass; ?>">
        <div class="blog_header">
            <?php the_post_thumbnail('full'); ?>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <div class="meta_data_box">

                <?php
                $display_date = get_option('display_date');
                $display_author = get_option('display_author');
                if ($display_author == 0) {
                    ?> 
                    <div class="metadate">
                        <i class="fa fa-user"></i>Posted by <span><?php the_author(); ?></span><br />                        
                    </div>

                    <?php
                }
                if ($display_date == 0) {
                    ?> 


                    <div class="metauser">
                        <span class="mdate"><i class="fa fa-calendar"></i> <?php the_time(__('F d, Y')); ?></span>
                    </div>
                <?php } ?>   

                <?php if (get_option('display_category') == 0) { ?>
                    <div class="metacats">
                        <div class="icon-cats"></div>
                        <?php
                        $categories_list = get_the_category_list(__(', ', 'twentyeleven'));
                        if ($categories_list):
                            printf(__('%2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $categories_list);
                            $show_sep = true;
                        endif;
                        ?>
                    </div>
                <?php } ?>
                <div class="metacomments">
                    <div class="icon-comment"></div>
                    <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
                </div>
            </div></div>
        <div class="post_content">
            <?php if (get_option('rss_use_excerpt') == 0): ?>
                <?php the_content(); ?>
            <?php else: ?>
                <?php
                the_excerpt(__('Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve'));
                if (get_option('read_more_text') != '') {
                    echo '<a class="more-tag" href="' . get_permalink($post->ID) . '">' . get_option(read_more_text) . ' </a>';
                } else {
                    echo ' <a class="more-tag" href="' . get_permalink($post->ID) . '">Read More</a>';
                }
                ?>
            <?php endif; ?>
        </div>
        <?php
        if (get_option('display_tag') == 0) {
            $tags_list = get_the_tag_list('', __(', ', 'twentyeleven'));
            if ($tags_list):
                ?>
                <div class="tags">
                    <div class="icon-tags"></div>
                    <?php
                    printf(__('%2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list);
                    $show_sep = true;
                    ?>
                </div>
            <?php endif;
        } ?>
        <div class="social-component">
            <?php if (get_option('facebook_link') == 0): ?>
                <a href="<?php echo 'https://www.facebook.com/dialog/share?&href=' . get_the_permalink(); ?>" target= _blank class="facebook-share"><i class="fa fa-facebook"></i></a>
            <?php endif; ?>
            <?php if (get_option('twitter_link') == 0): ?>
                <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="twitter"><i class="fa fa-twitter"></i></a>
            <?php endif; ?>
            <?php if (get_option('google_link') == 0): ?>
                <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="google"><i class="fa fa-google-plus"></i></a>
            <?php endif; ?>
            <?php if (get_option('linkedin_link') == 0): ?>
                <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="linkedin"><i class="fa fa-linkedin"></i></a>
            <?php endif; ?>
            <?php if (get_option('instagram_link') == 0): ?>
                <a href="<?php echo 'mailto:enteryour@addresshere.com?subject=Share and Follow&body=' . get_the_permalink(); ?>" target= _blank class="instagram"><i class="fa fa-envelope-o"></i></a>
            <?php endif; ?>        
            <?php if (get_option('pinterest_link') == 0): ?>
                <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="pinterest"> <i class="fa fa-pinterest"></i></a>
    <?php endif; ?>
        </div>
    </div>
    <?php
}

/* * **************************** display function for spektrum layout ************************************ */

function wp_spektrum_template() {
    ?>

    <div class="blog_template spektrum">
            <?php the_post_thumbnail('full'); ?>
        <div class="blog_header">
            <?php if (get_option('display_date') == 0) { ?>
                <span class="date"><span class="number-date"><?php the_time(__('d')); ?></span><?php the_time(__('F')); ?></span>
    <?php } ?>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        </div>
        <div class="post_content">
            <?php if (get_option('rss_use_excerpt') == 0): ?>
                <?php the_content(); ?>
            <?php else: ?>
                <?php the_excerpt(); ?>
    <?php endif; ?>
        </div>
        <div class="post-bottom">
                <?php if (get_option('display_category') == 0) { ?>
                <span class="categories">
                    <?php
                    $categories_list = get_the_category_list(__(', ', 'twentyeleven'));
                    if ($categories_list):
                        printf(__('Catrgories : %2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $categories_list);
                        $show_sep = true;
                    endif;
                    ?>
                </span>
            <?php } ?>
    <?php if (get_option('display_author') == 0) { ?>
                <span class="post-by">
                    <div class="icon-author"></div>Posted by <span><?php the_author(); ?></span>
                </span>
            <?php } ?>
            <?php
            if (get_option('display_tag') == 0) {
                $tags_list = get_the_tag_list('', __(', ', 'twentyeleven'));
                if ($tags_list):
                    ?>
                    <span class="tags">
                        <div class="icon-tags"></div>
                        <?php
                        printf(__('%2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list);
                        $show_sep = true;
                        ?>
                    </span>
                <?php endif;
            } ?>
                <?php if (get_option('rss_use_excerpt') == 1): ?>
                <span class="details">
                    <?php
                    if (get_option('read_more_text') != '') {
                        echo '<a href="' . get_permalink($post->ID) . '">' . get_option(read_more_text) . ' </a>';
                    } else {
                        echo ' <a href="' . get_permalink($post->ID) . '">Read More</a>';
                    }
                    ?>                    
                </span>
    <?php endif; ?>
        </div>
        <div class="social-component spektrum-social">
        <?php if (get_option('facebook_link') == 0): ?>
            <a href="<?php echo 'https://www.facebook.com/dialog/share?&href=' . get_the_permalink(); ?>" target= _blank class="facebook-share"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>
        <?php if (get_option('twitter_link') == 0): ?>
            <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="twitter"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>
        <?php if (get_option('google_link') == 0): ?>
            <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="google"><i class="fa fa-google-plus"></i></a>
        <?php endif; ?>
        <?php if (get_option('linkedin_link') == 0): ?>
            <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="linkedin"><i class="fa fa-linkedin"></i></a>
        <?php endif; ?>
        <?php if (get_option('instagram_link') == 0): ?>
            <a href="<?php echo 'mailto:enteryour@addresshere.com?subject=Share and Follow&body=' . get_the_permalink(); ?>" target= _blank class="instagram"><i class="fa fa-envelope-o"></i></a>
        <?php endif; ?>        
        <?php if (get_option('pinterest_link') == 0): ?>
            <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="pinterest"> <i class="fa fa-pinterest"></i></a>
    <?php endif; ?>
    </div>   
    </div>
     
    <?php
}

/* * **************************** display function for evolution layout ************************************ */

function wp_evolution_template($alterclass) {
    ?>

    <div class="blog_template marketer <?php echo $alterclass; ?>">
        <div class="post-category"> 
            <?php
            if (get_option('display_category') == 0) {                
                ?>                                    
                <?php
                $categories_list = get_the_category_list(__(', ', 'twentyeleven'));
                if ($categories_list):
                    printf(__('%2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $categories_list);
                    $show_sep = true;
                endif;
            }
            ?>
        </div>
        <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div class="post-entry-meta">
            <?php if (get_option('display_date') == 0) { ?>
                <span class="date"><span class="number-date"><?php the_time(__('d')); ?></span><?php the_time(__('F')); ?></span>
            <?php } ?>
                
            <?php if (get_option('display_author') == 0) { ?>
               <span class="author"> Posted by <?php the_author(); ?></span>
                <?php
            }
            if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                ?>
               <span class="comment"><span class="icon_cnt"><i class="fa fa-comment"></i><?php comments_popup_link('0', '1', '%'); ?></span></span>
            <?php endif; ?>     
            <?php
            if (get_option('display_tag') == 0) {
                $tags_list = get_the_tag_list('', __(', ', 'twentyeleven'));
                if ($tags_list):
                    ?>
                    <span class="tags">
                        <div class="icon-tags"></div>
                        <?php
                        printf(__('%2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list);
                        $show_sep = true;
                        ?>
                    </span>
                    <?php
                endif;
            }
            ?>
        </div>
        <div class="post-image">
                <?php the_post_thumbnail('full'); ?>
        </div>
        <div class="post-content-body">
            <?php if (get_option('rss_use_excerpt') == 0): ?>
                <?php the_content(); ?>
            <?php else: ?>
                <?php the_excerpt(); ?>
        <?php endif; ?>
        </div>
            <?php if (get_option('rss_use_excerpt') == 1): ?>
            <div class="post-bottom">
                <?php
                if (get_option('read_more_text') != '') {
                    echo '<a href="' . get_permalink($post->ID) . '">' . get_option(read_more_text) . ' </a>';
                } else {
                    echo ' <a href="' . get_permalink($post->ID) . '">Read more &raquo;</a>';
                }
                ?>         
            </div>
        <?php endif; ?>
        <div class="social-component">
            <?php if (get_option('facebook_link') == 0): ?>
                <a href="<?php echo 'https://www.facebook.com/dialog/share?&href=' . get_the_permalink(); ?>" target= _blank class="facebook-share"><i class="fa fa-facebook"></i></a>
            <?php endif; ?>
            <?php if (get_option('twitter_link') == 0): ?>
                <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="twitter"><i class="fa fa-twitter"></i></a>
            <?php endif; ?>
            <?php if (get_option('google_link') == 0): ?>
                <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="google"><i class="fa fa-google-plus"></i></a>
            <?php endif; ?>
            <?php if (get_option('linkedin_link') == 0): ?>
                <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="linkedin"><i class="fa fa-linkedin"></i></a>
            <?php endif; ?>
            <?php if (get_option('instagram_link') == 0): ?>
                <a href="<?php echo 'mailto:enteryour@addresshere.com?subject=Share and Follow&body=' . get_the_permalink(); ?>" target= _blank class="instagram"><i class="fa fa-envelope-o"></i></a>
            <?php endif; ?>        
            <?php if (get_option('pinterest_link') == 0): ?>
                <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="pinterest"> <i class="fa fa-pinterest"></i></a>
        <?php endif; ?>
        </div>
    </div>
    <?php
}

function wp_blog_designer_menu_function() {
    ?>

    <div class="wrap">
        <h2><?php _e('Blog Desiner Settings', 'wp-blog-desiner') ?></h2>
    <?php if ('true' == esc_attr($_GET['updated'])) echo '<div class="updated" ><p>Designer Settings updated.</p></div>'; ?>
    <?php $settings = get_option("wp_blog_designer_settings"); ?>
        <form method="post" action="?page=designer_settings&action=save&updated=true">
            <!--script type="text/javascript">jQuery( window ).load( function() { jQuery( "#template_category" ).attr( "multiple", "multiple" );});</script-->
            <div class="wl-pages" >
                <div class="wl-page wl-settings active">
                    <div class="wl-box wl-settings">
                        <h3 class="header"><?php _e('General Settings', 'wp-blog-desiner') ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e('Blog page displays', 'wp-blog-desiner') ?></td>
                                    <td>
    <?php printf(__('%s'), wp_dropdown_pages(array('name' => 'page_on_front', 'echo' => 0, 'show_option_none' => __('&mdash; Select &mdash;'), 'option_none_value' => '0', 'selected' => get_option('page_on_front')))); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Blog pages show at most', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input name="posts_per_page" type="number" step="1" min="1" id="posts_per_page" value="<?php echo get_option('posts_per_page'); ?>" class="small-text" /> <?php _e('posts'); ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php _e('Display Category ', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input name="display_category" type="radio" value="0" <?php checked(0, get_option('display_category')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="display_category" type="radio" value="1" <?php checked(1, get_option('display_category')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Display Tag ', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input name="display_tag" type="radio" value="0" <?php checked(0, get_option('display_tag')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="display_tag" type="radio" value="1" <?php checked(1, get_option('display_tag')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Display author ', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input name="display_author" type="radio" value="0" <?php checked(0, get_option('display_author')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="display_author" type="radio" value="1" <?php checked(1, get_option('display_author')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Display date ', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input name="display_date" type="radio" value="0" <?php checked(0, get_option('display_date')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="display_date" type="radio" value="1" <?php checked(1, get_option('display_date')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h3 class="header"><?php _e('Standard Settings', 'wp-blog-desiner') ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e('Blog page categories', 'wp-blog-desiner') ?></td>
                                    <td>
                                            <?php $categories = get_categories(array('child_of' => '', 'hide_empty' => 1)); ?>
                                        <select name="template_category[]" id="template_category" multiple="multiple">
                                            <option><?php echo '&mdash; Select &mdash;'; ?></option>
                                            <?php foreach ($categories as $categoryObj): ?>
                                                <option value="<?php echo $categoryObj->term_id; ?>" <?php
                                                        if (@in_array($categoryObj->term_id, $settings['template_category'])) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>><?php echo $categoryObj->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Blog Designs', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <select name="template_name" id="template_name">
                                            <option value="">---select---</option>
                                            <option value="classical" <?php if ($settings["template_name"] == 'classical') { ?> selected="selected"<?php } ?>>Design 1</option>
                                            <option value="lightbreeze" <?php if ($settings["template_name"] == 'lightbreeze') { ?> selected="selected"<?php } ?>>Design 2</option>
                                            <option value="spektrum" <?php if ($settings["template_name"] == 'spektrum') { ?> selected="selected"<?php } ?>>Design 3</option>
                                            <option value="evolution" <?php if ($settings["template_name"] == 'evolution') { ?> selected="selected"<?php } ?>>Design 4</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="blog-template-tr">
                                    <td><?php _e('Choose a background color for blog design', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <div id="bgcolorSelector"><div style="background-color:<?php echo $settings["template_bgcolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_bgcolor" id="template_bgcolor" value="<?php echo $settings["template_bgcolor"]; ?>"/>
                                        Alternative background color: <input type="radio" value="0" name="template_alternativebackground" <?php checked(0, get_option('template_alternativebackground')); ?>	/> <?php _e('Yes'); ?>
                                        <input type="radio" value="1" name="template_alternativebackground" <?php checked(1, get_option('template_alternativebackground')); ?>	/> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr class="alternative-color-tr">
                                    <td><?php _e('Choose alternative background color', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <div id="alterbgcolorSelector"><div style="background-color:<?php echo $settings["template_alterbgcolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_alterbgcolor" id="template_alterbgcolor" value="<?php echo $settings["template_alterbgcolor"]; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Choose font color for anchor tag in blog design', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <div id="ftcolorSelector"><div style="background-color:<?php echo $settings["template_ftcolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_ftcolor" id="template_ftcolor" value="<?php echo $settings["template_ftcolor"]; ?>"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <h3 class="header"><?php _e('Title Settings', 'wp-blog-desiner') ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e('Title color', 'wp-blog-desiner') ?></td>
                                    <td>                                        
                                        <div id="titlecolorSelector"><div style="background-color:<?php echo $settings["template_titlecolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_titlecolor" id="template_titlecolor" value="<?php echo $settings["template_titlecolor"]; ?>"/>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td><?php _e('Title background color', 'wp-blog-desiner') ?></td>
                                    <td>                                        
                                        <div id="titlebackcolorSelector"><div style="background-color:<?php echo $settings["template_titlebackcolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_titlebackcolor" id="template_titlebackcolor" value="<?php echo $settings["template_titlebackcolor"]; ?>"/>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <h3 class="header"><?php _e('Content Settings', 'wp-blog-desiner') ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e('For each article in a feed, show ', 'wp-blog-desiner') ?></td>
                                    <td class="rss_use_excerpt">
                                        <input name="rss_use_excerpt" type="radio" value="0" <?php checked(0, get_option('rss_use_excerpt')); ?>	/> <?php _e('Full text'); ?>
                                        <input name="rss_use_excerpt" type="radio" value="1" <?php checked(1, get_option('rss_use_excerpt')); ?> /> <?php _e('Summary'); ?>
                                    </td>
                                </tr>
                                <tr class="excerpt_length">
                                    <td><?php _e('Content length', 'wp-blog-desiner') ?></td>
                                    <td >
                                        <input type="text" name="txtExcerptlength" value="<?php echo get_option('excerpt_length'); ?>" placeholder="Enter excerpt length">
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Content color', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <div id="contentcolorSelector"><div style="background-color:<?php echo $settings["template_contentcolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_contentcolor" id="template_contentcolor" value="<?php echo $settings["template_contentcolor"]; ?>"/>
                                    </td>
                                </tr>
                                <tr class="read_more_text">
                                    <td><?php _e('Read more text', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input type="text" name="txtReadmoretext" value="<?php echo get_option('read_more_text'); ?>" placeholder="Enter read more text">
                                    </td>
                                </tr>
                                <tr class="read_more_text_color">
                                    <td><?php _e('Read more text color', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <div id="readmorecolorSelector"><div style="background-color:<?php echo $settings["template_readmorecolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_readmorecolor" id="template_readmorecolor" value="<?php echo $settings["template_readmorecolor"]; ?>"/>
                                    </td>
                                </tr>
                                <tr class="read_more_text_background">
                                    <td><?php _e('Read more background', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <div id="readmorebackcolorSelector"><div style="background-color:<?php echo $settings["template_readmorebackcolor"]; ?>"></div></div>
                                        <input type="hidden" name="template_readmorebackcolor" id="template_readmorebackcolor" value="<?php echo $settings["template_readmorebackcolor"]; ?>"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h3 class="header"><?php _e('Social Settings', 'wp-blog-desiner') ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e('Social icon style', 'wp-blog-desiner') ?></td>
                                    <td>                                        
                                        <input name="social_icon_style" type="radio" value="0" checked="checked" <?php checked(0, get_option('social_icon_style')); ?>	/> <?php _e('Style1'); ?>
                                        <input name="social_icon_style" type="radio" value="1" <?php checked(1, get_option('social_icon_style')); ?> /> <?php _e('Style2'); ?>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Facebook link', 'wp-blog-desiner') ?></td>
                                    <td>                                        
                                        <input name="facebook_link" type="radio" value="0" <?php checked(0, get_option('facebook_link')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="facebook_link" type="radio" value="1" <?php checked(1, get_option('facebook_link')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Twitter link', 'wp-blog-desiner') ?></td>
                                    <td>                                        
                                        <input name="twitter_link" type="radio" value="0" <?php checked(0, get_option('twitter_link')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="twitter_link" type="radio" value="1" <?php checked(1, get_option('twitter_link')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Google+ link', 'wp-blog-desiner') ?></td>
                                    <td>                                        
                                        <input name="google_link" type="radio" value="0" <?php checked(0, get_option('google_link')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="google_link" type="radio" value="1" <?php checked(1, get_option('google_link')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Linkedin link', 'wp-blog-desiner') ?></td>
                                    <td>

                                        <input name="linkedin_link" type="radio" value="0" <?php checked(0, get_option('linkedin_link')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="linkedin_link" type="radio" value="1" <?php checked(1, get_option('linkedin_link')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Using mail', 'wp-blog-desiner') ?></td>
                                    <td>

                                        <input name="instagram_link" type="radio" value="0" <?php checked(0, get_option('instagram_link')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="instagram_link" type="radio" value="1" <?php checked(1, get_option('instagram_link')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>                                

                                <tr>
                                    <td><?php _e('Pinterest link', 'wp-blog-desiner') ?></td>
                                    <td>
                                        <input name="pinterest_link" type="radio" value="0" <?php checked(0, get_option('pinterest_link')); ?>	/> <?php _e('Yes'); ?>
                                        <input name="pinterest_link" type="radio" value="1" <?php checked(1, get_option('pinterest_link')); ?> /> <?php _e('No'); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                             
            <div class="inner">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'wp-blog-desiner'); ?>" />
                <p class="wl-saving-warning"></p>
                <div class="clear"></div>
            </div>            
        </form>
    </div>

    <?php
}

function lumia_pagination($args = array()) {

    if (!is_array($args)) {
        $argv = func_get_args();
        $args = array();
        foreach (array('before', 'after', 'options') as $i => $key)
            $args[$key] = $argv[$i];
    }
    $args = wp_parse_args($args, array(
        'before' => '',
        'after' => '',
        'options' => array(),
        'query' => $GLOBALS['wp_query'],
        'type' => 'posts',
        'echo' => true
    ));

    extract($args, EXTR_SKIP);
    $instance = new LBNavi_Call($args);

    list( $posts_per_page, $paged, $total_pages ) = $instance->get_pagination_args();

    if (1 == $total_pages && !$options['always_show'])
        return;

    $pages_to_show = 100;
    $larger_page_to_show = 3;
    $larger_page_multiple = 10;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;

    if ($start_page <= 0)
        $start_page = 1;

    $end_page = $paged + $half_page_end;

    if (( $end_page - $start_page ) != $pages_to_show_minus_1)
        $end_page = $start_page + $pages_to_show_minus_1;

    if ($end_page > $total_pages) {
        $start_page = $total_pages - $pages_to_show_minus_1;
        $end_page = $total_pages;
    }

    if ($start_page < 1)
        $start_page = 1;

    $out = '';
    $options['style'] = 1;
    $options['pages_text'] = 'Page %CURRENT_PAGE% of %TOTAL_PAGES%';
    $options['current_text'] = '%PAGE_NUMBER%';
    $options['page_text'] = '%PAGE_NUMBER%';
    $options['first_text'] = '&laquo; First';
    $options['last_text'] = 'Last &raquo;';
    $options['prev_text'] = '';
    $options['next_text'] = '';
    $options['dotright_text'] = '';

    switch (intval($options['style'])) {


        // Normal
        case 1:
            // Text
            if (!empty($options['pages_text'])) {
                $pages_text = str_replace(
                        array("%CURRENT_PAGE%", "%TOTAL_PAGES%"), array(number_format_i18n($paged), number_format_i18n($total_pages)), $options['pages_text']);
                $out .= "<span class='pages'>$pages_text</span>";
            }

            if ($start_page >= 2 && $pages_to_show < $total_pages) {
                // First
                $first_text = str_replace('%TOTAL_PAGES%', number_format_i18n($total_pages), $options['first_text']);
                $out .= $instance->get_single(1, 'first', $first_text, '%TOTAL_PAGES%');
            }

            // Previous
            if ($paged > 1 && !empty($options['prev_text']))
                $out .= $instance->get_single($paged - 1, 'previouspostslink', $options['prev_text']);

            if ($start_page >= 2 && $pages_to_show < $total_pages) {
                if (!empty($options['dotleft_text']))
                    $out .= "<span class='extend'>{$options['dotleft_text']}</span>";
            }

            // Smaller pages
            $larger_pages_array = array();
            if ($larger_page_multiple)
                for ($i = $larger_page_multiple; $i <= $total_pages; $i+= $larger_page_multiple)
                    $larger_pages_array[] = $i;

            $larger_page_start = 0;
            foreach ($larger_pages_array as $larger_page) {
                if ($larger_page < ($start_page - $half_page_start) && $larger_page_start < $larger_page_to_show) {
                    $out .= $instance->get_single($larger_page, 'smaller page', $options['page_text']);
                    $larger_page_start++;
                }
            }

            if ($larger_page_start)
                $out .= "<span class='extend'>{$options['dotleft_text']}</span>";

            // Page numbers
            $timeline = 'smaller';
            foreach (range($start_page, $end_page) as $i) {
                if ($i == $paged && !empty($options['current_text'])) {
                    $current_page_text = str_replace('%PAGE_NUMBER%', number_format_i18n($i), $options['current_text']);
                    $out .= "<span class='current'>$current_page_text</span>";
                    $timeline = 'larger';
                } else {
                    $out .= $instance->get_single($i, "page $timeline", $options['page_text']);
                }
            }

            // Large pages
            $larger_page_end = 0;
            $larger_page_out = '';
            foreach ($larger_pages_array as $larger_page) {
                if ($larger_page > ($end_page + $half_page_end) && $larger_page_end < $larger_page_to_show) {
                    $larger_page_out .= $instance->get_single($larger_page, 'larger page', $options['page_text']);
                    $larger_page_end++;
                }
            }

            if ($larger_page_out) {
                $out .= "<span class='extend'>{$options['dotright_text']}</span>";
            }
            $out .= $larger_page_out;

            if ($end_page < $total_pages) {
                if (!empty($options['dotright_text']))
                    $out .= "<span class='extend'>{$options['dotright_text']}</span>";
            }

            // Next
            if ($paged < $total_pages && !empty($options['next_text']))
                $out .= $instance->get_single($paged + 1, 'nextpostslink', $options['next_text']);

            if ($end_page < $total_pages) {
                // Last
                $out .= $instance->get_single($total_pages, 'last', $options['last_text'], '%TOTAL_PAGES%');
            }
            break;

        // Dropdown
        case 2:
            $out .= '<form action="" method="get">' . "\n";
            $out .= '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";

            foreach (range(1, $total_pages) as $i) {
                $page_num = $i;
                if ($page_num == 1)
                    $page_num = 0;

                if ($i == $paged) {
                    $current_page_text = str_replace('%PAGE_NUMBER%', number_format_i18n($i), $options['current_text']);
                    $out .= '<option value="' . esc_url($instance->get_url($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
                } else {
                    $page_text = str_replace('%PAGE_NUMBER%', number_format_i18n($i), $options['page_text']);
                    $out .= '<option value="' . esc_url($instance->get_url($page_num)) . '">' . $page_text . "</option>\n";
                }
            }

            $out .= "</select>\n";
            $out .= "</form>\n";
            break;
    }
    $out = $before . "<div class='wl_pagination'>\n$out\n</div>" . $after;

    $out = apply_filters('lumia_pagination', $out);

    if (!$echo)
        return $out;

    echo $out;
}

class LBNavi_Call {

    protected $args;

    function __construct($args) {
        $this->args = $args;
    }

    function __get($key) {
        return $this->args[$key];
    }

    function get_pagination_args() {
        global $numpages;

        $query = $this->query;

        switch ($this->type) {
            case 'multipart':
                // Multipart page
                $posts_per_page = 1;
                $paged = max(1, absint(get_query_var('page')));
                $total_pages = max(1, $numpages);
                break;
            case 'users':
                // WP_User_Query
                $posts_per_page = $query->query_vars['number'];
                $paged = max(1, floor($query->query_vars['offset'] / $posts_per_page) + 1);
                $total_pages = max(1, ceil($query->total_users / $posts_per_page));
                break;
            default:
                // WP_Query
                $posts_per_page = intval($query->get('posts_per_page'));
                $paged = max(1, absint($query->get('paged')));
                $total_pages = max(1, absint($query->max_num_pages));
                break;
        }

        return array($posts_per_page, $paged, $total_pages);
    }

    function get_single($page, $class, $raw_text, $format = '%PAGE_NUMBER%') {
        if (empty($raw_text))
            return '';

        $text = str_replace($format, number_format_i18n($page), $raw_text);

        return "<a href='" . esc_url($this->get_url($page)) . "' class='$class'>$text</a>";
    }

    function get_url($page) {
        return ( 'multipart' == $this->type ) ? get_multipage_link($page) : get_pagenum_link($page);
    }

}

function lumiapaged() {
    if (strstr($_SERVER['REQUEST_URI'], 'paged') || strstr($_SERVER['REQUEST_URI'], 'page')) {
        if (isset($_REQUEST['paged'])) {
            $paged = $_REQUEST['paged'];
        } else {
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            $uri = array_reverse($uri);
            $paged = $uri[1];
        }
    } else {
        $paged = 1;
    }

    return $paged;
}
?>