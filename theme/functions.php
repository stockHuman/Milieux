<?php
// Theme support options
require_once(get_template_directory().'/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php');

// Register Customizer function
require_once(get_template_directory().'/functions/customizer.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php');

// Adds support for multiple languages
// require_once(get_template_directory().'/translation/translation.php');

// Remove 4.2 Emoji Support
require_once(get_template_directory().'/functions/disable-emoji.php');

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/functions/editor-styles.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php');

// Related post function - no need to rely on plugins
require_once(get_template_directory().'/functions/plugins.php');

// Use this as a template for custom post types
require_once(get_template_directory().'/functions/custom-post-types.php');

// Bylines feature to not have to create new users for every author
require_once(get_template_directory().'/functions/bylines.php');

// Customize the WordPress login menu
require_once(get_template_directory().'/functions/login.php');

// Customize the WordPress admin
require_once(get_template_directory().'/functions/admin.php');

// Add in misc function
require_once(get_template_directory().'/functions/theme-functions.php');
