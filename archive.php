<?php
/**
 * @package WordPress
 */
 
get_header();  //the Header
get_template_part( 'menu', 'index' ); //the  menu + logo/site title
get_template_part( 'loop', 'archive' ); //the Loop
get_footer(); //the Footer ?>