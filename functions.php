<?php
function my_theme_enqueue_styles() {
    // Enqueue parent theme stylesheet
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue child theme stylesheet
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), filemtime(get_stylesheet_directory() . '/style.css'));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
?>

/*** Hook filter ****/
<?php
function add_admin_link_to_menu($items, $args) {
   
    if (is_user_logged_in() && current_user_can('administrator'))  // Vérifiez si l'utilisateur est connecté et s'il est administrateur
    
    { // Split the menu items into an array
        $menu_items = explode('</li>', $items);

        // Ajoutez l'élément "ADMIN" à la fin du menu
        $admin_link = '<li class="menu-item admin-link"><a class="admin" href="' . admin_url() . '">ADMIN</a></li>';
         // Insert the custom item into the middle of the menu
         $position = 1; // Insert after the second item (index 2)
         if (count($menu_items) > 1) {
             array_splice($menu_items, $position, 0, $admin_link);
         }
         // Rebuild the menu items string
         $items = implode('</li>', $menu_items);
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_admin_link_to_menu', 10, 2); /*ajoute le filtre à

?>