<?php
/*
Plugin Name: FC Google Plus One Button
Description: Add Google +1 to your site with schema.org description generated from single post title, excerpt and thumbnail
Version: 1.1
Author: Fanatical Code - Kamil Skrzypiński
Author URI: http://www.fanaticalcode.com/

*/

function fc_google_plus_one_button($content)
{
  $button = '<div class="google_plus_one" style="float: right;"><g:plusone></g:plusone></div>';
  if (is_single())
  {
    $content = $button.$content.$button;
    return $content;
  }
  else return $content;
}
add_filter('the_content', 'fc_google_plus_one_button');

function google_plusone_script() {
  wp_enqueue_script('fc_google_plus_one_button', 'https://apis.google.com/js/plusone.js', false, null, true);
}
add_action ('wp_enqueue_scripts', 'google_plusone_script');

function fc_google_plus_one_button_schema_org()
{
  if (is_single())
  {
    echo "<meta itemprop=\"name\" content=\"". esc_attr(get_the_title())."\">\n".
         "<meta itemprop=\"description\" content=\"". esc_attr(get_the_excerpt())."\">\n".
         "<meta itemprop=\"image\" content=\"". esc_attr(get_the_post_thumbnail())."\">\n".
         "<script type=\"text/javascript\">".
         "  (function() {".
         "    var html = document.getElementsByTagName('html');".
         "    if (html.length == 1 && ! (html.itemscope || html.itemtype) ) {".
         "      html[0].setAttribute('itemprop', '');".
				 "      html[0].setAttribute('itemtype', 'http://schema.org/');".
				 "    }".
         "  })();".
         "</script>";
  }
}
add_action('wp_head', 'fc_google_plus_one_button_schema_org');
