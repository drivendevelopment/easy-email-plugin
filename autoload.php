<?php

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) exit;

spl_autoload_register( function( $class ){
    $path       = strtolower( $class );
    $path       = str_replace( '_', '-', $path );
    $base_dir   = dirname( __FILE__ );

    // Convert to an array
    $path = explode( '\\', $path );
    
    // Nothing to do if we don't have anything
    if ( empty( $path[0] ) ) return;
    
    // Only worry about our namespace
    if ( 'easy-email' != $path[0] ) return;
    
    // Remove the root namespace
    unset( $path[0] );
    
    // Get the class name
    $class = array_pop( $path );
    
    // Glue it back together
    $path = join( DIRECTORY_SEPARATOR, $path );
    $path = $base_dir . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $class . '.php';
    
    include_once( $path );
} );