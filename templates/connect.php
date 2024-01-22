<div id="ee-connect">
    <div>
        <div class="logo">
            <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ); ?>assets/images/logo.svg" alt="Easy Email logo" width="180" height="37" />
        </div>
        <h1 class="screen-reader-text">
            <?php _e( 'Welcome to Easy Email!', 'easy-email' ); ?>
        </h1>
        <p>
            <?php _e( 'To get started, simply connect your site to Easy Email.', 'easy-email' ); ?>
        </p>
        <p class="action">
            <a class="ee-btn" href="<?php echo esc_url( $connect_url ); ?>">
                <?php _e( 'Connect to Easy Email', 'easy-email' ); ?>
            </a>
        </p>
        <p class="help">
            <?php echo sprintf( __( 'Need help? <a href="%s/contact">Contact us</a> and we\'ll be happy to help!', 'easy-email' ), esc_url( $site_url ) ); ?>
        </p>
    </div>
</div>   