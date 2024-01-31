<?php

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="wrap">
    <h1><?php esc_html_e( 'Easy Email Settings', 'easy-email' ); ?></h1>
    <p>
        <?php echo wp_kses_post( sprintf( __( 'Your site is connected to Easy Email. <a href="%s" target="_blank">Log into your Easy Email account</a> to manage your site.', 'easy-email' ), esc_url( $app_url ) ) ); ?>
    </p>
    <p>
        <a id="ee-disconnect" class="button button-primary" href="<?php echo esc_url( $disconnect_url ); ?>">
            <?php esc_html_e( 'Disconnect from Easy Email', 'easy-email' ); ?>
        </a>
    </p>
</div>
<script>
    ( function( $ ){
        $( function(){
            $( '#ee-disconnect' ).click( function( e ){
                if ( ! confirm( '<?php esc_html_e( 'Are you sure you want to disconnect your site from Easy Email?', 'easy-email' ); ?>' ) ) {
                    e.preventDefault();
                }
            } );
        } );
    } )( jQuery );
</script>
