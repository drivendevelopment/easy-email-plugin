<?php

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="wrap">
    <h1><?php esc_html_e( 'Easy Email Settings', 'easy-email' ); ?></h1>
    <?php if ( false === $api_key ) : ?>
        <p>
            <?php esc_html_e( 'Welcome to Easy Email! To get started, simply connect your site to Easy Email.', 'easy-email' ); ?>
        </p>
        <p>
            <a class="button button-primary" href="<?php echo esc_url( $connect_url ); ?>">
                <?php esc_html_e( 'Connect to Easy Email', 'easy-email' ); ?>
            </a>
        </p>
        <p style="margin-top: 40px;">
            <?php echo wp_kses_post( sprintf( __( 'Need help? <a href="%s/contact">Contact us</a> and we\'ll be happy to help!', 'easy-email' ), esc_url( $app_url ) ) ); ?>
        </p>
    <?php else : ?>
        <p>
            <?php echo wp_kses_post( sprintf( __( 'Your site is connected to Easy Email. <a href="%s" target="_blank">Log into your Easy Email account</a> to manage your site.', 'easy-email' ), esc_url( $app_url ) ) ); ?>
        </p>
        <p>
            <a class="button button-primary" href="<?php echo esc_url( $disconnect_url ); ?>">
                <?php esc_html_e( 'Disconnect from Easy Email', 'easy-email' ); ?>
            </a>
        </p>
    <?php endif; ?>
</div>