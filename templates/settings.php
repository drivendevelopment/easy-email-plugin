<div class="wrap">
    <h1><?php _e( 'Easy Email Settings', 'easy-email' ); ?></h1>
    <?php if ( false === $api_key ) : ?>
        <p>
            <?php _e( 'Welcome to Easy Email! To get started, simply connect your site to Easy Email.', 'easy-email' ); ?>
        </p>
        <p>
            <a class="button button-primary" href="<?php echo esc_url( $connect_url ); ?>">
                <?php _e( 'Connect to Easy Email', 'easy-email' ); ?>
            </a>
        </p>
        <p style="margin-top: 40px;">
            <?php echo sprintf( __( 'Need help? <a href="%s/contact">Contact us</a> and we\'ll be happy to help!', 'easy-email' ), esc_url( $app_url ) ); ?>
        </p>
    <?php else : ?>
        <p>
            <?php echo sprintf( __( 'Your site is connected to Easy Email. <a href="%s" target="_blank">Log into your Easy Email account</a> to manage your site.', 'easy-email' ), esc_url( $app_url ) ); ?>
        </p>
        <p>
            <a class="button button-primary" href="<?php echo esc_url( $disconnect_url ); ?>">
                <?php _e( 'Disconnect from Easy Email', 'easy-email' ); ?>
            </a>
        </p>
    <?php endif; ?>
</div>