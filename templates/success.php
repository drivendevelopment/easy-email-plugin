<div id="ee-connect">
    <div>
        <div class="logo">
            <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ); ?>assets/images/logo.svg" alt="Easy Email logo" width="180" height="37" />
        </div>
        <h1 class="screen-reader-text">
            <?php _e( 'Success', 'easy-email' ); ?>
        </h1>
        <p>
            <?php _e( 'Success! Your site has been connected to Easy Email. Happy sending.', 'easy-email' ); ?>
        </p>
        <p class="action">
            <a class="ee-btn" href="<?php echo esc_url( $settings_page_url ); ?>">
                <?php _e( 'Continue', 'easy-email' ); ?>
            </a>
        </p>
        <p class="confetti">
            (P.S. Like the confetti? <a href="https://wpsunshine.com/plugins/confetti/" target="_blank">Get the plugin here</a>.)
        </p>
    </div>
</div>
<script>
    ( function( $ ){
        $( function(){
            wps_run_confetti( {
				style: 'cannon_real',
				particleCount: 200
			} );
        } );
    } )( jQuery );
</script>