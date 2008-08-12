<?php
  /*
    Plugin Name: KISS CMS Admin
    Plugin URI:
    Version: 1.0
    Description: KISS Wordpress Admin Menu for simple Page-only installations. Removes all "clutter" from the menus.
    Author: Bjørn Arild Mæland
    Author URI: http://obvcode.blogspot.com/
  */

if (!function_exists('change_post_links')) {
     function change_post_links() {
          global $userdata;
          get_currentuserinfo();
          if ($userdata->user_level == 10) return; // Don't change anything for administrators

          global $menu, $submenu;

          $unwanted_post_submenu = array(
               5,  // Remove write posts
               15  // Remove write links
               );

          $unwanted_edit_submenu = array(
               5,  // Remove change posts
               15, // Remove change links
               20, // Remove categories
               25, // Remove tags
               30  // Remove link categories
               );

          unset($menu[20]); // Remove comments tab

          // Unset unwanted submenu links
          foreach ($unwanted_post_submenu as $i) unset($submenu['post-new.php'][$i]);
          foreach ($unwanted_edit_submenu as $i) unset($submenu['edit.php'][$i]);
     }
}

add_action('admin_menu', 'change_post_links');
?>
