<div class="wrap">
    <h1><?php _e( 'Easy Email Settings', 'easy-email' ); ?></h1>
    <p>
        <?php echo sprintf( __( 'Your site is connected to Easy Email. <a href="%s" target="_blank">Log into your Easy Email account</a> to manage your site.', 'easy-email' ), esc_url( $app_url ) ); ?>
    </p>
    <p>
        <a id="ee-disconnect" class="button button-primary" href="<?php echo esc_url( $disconnect_url ); ?>">
            <?php _e( 'Disconnect from Easy Email', 'easy-email' ); ?>
        </a>
    </p>
</div>
<script>
    ( function( $ ){
        $( function(){
            $( '#ee-disconnect' ).click( function( e ){
                if ( ! confirm( '<?php _e( 'Are you sure you want to disconnect your site from Easy Email?', 'easy-email' ); ?>' ) ) {
                    e.preventDefault();
                }
            } );
        } );
    } )( jQuery );
</script>