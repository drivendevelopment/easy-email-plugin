<?php

namespace Easy_Email;

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) exit;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer {

    public const INVALID_API_KEY_ERROR = 1;

    public const QUOTA_EXCEEDED_ERROR = 2;

    public const SERVICE_ERROR_ERROR = 3;

    public $easy_email_api_url;

    public $easy_email_api_key;

    public function send() {
        try {
            $request = array(
                'From'      => $this->From,
                'FromName'  => $this->FromName,
                'To'        => $this->getToAddresses(),
                'Cc'        => $this->getCcAddresses(),
                'Bcc'       => $this->getBccAddresses(),
                'Subject'   => $this->Subject,
                'HtmlBody'  => $this->isHTML() ? $this->Body : '',
                'TextBody'  => $this->isHTML() ? '' : $this->Body,
                'ReplyTo'   => $this->getReplyToAddresses(),
                'Headers'   => $this->getCustomHeaders(),
            );

            $response = wp_remote_post( "{$this->easy_email_api_url}/api/email", array(
                'headers' => array(
                    'Content-Type'          => 'application/json',
                    'X-Easy-Email-API-Key'  => $this->easy_email_api_key,
                ),
                'body' => wp_json_encode( $request ),
            ) );

            // We got an error. Fall back to the parent method.
            if ( is_wp_error( $response ) ) {
                return parent::send();
            }

            $response = json_decode( wp_remote_retrieve_body( $response ) );

            if ( $response->success ) {
                // Use this opportunity to update stats
                update_option( 'easy_email_quota', $response->quota );
                update_option( 'easy_email_emails_sent', $response->emails_sent );

                // All good
                return true;
            } else {
                // Something went wrong. Fall back to the parent method.
                return parent::send();
            }
        } catch ( Exception $e ) {
            // Something when wrong. Fall back to the parent method.
            return parent::send();
        }

        return true;
    }

    /**
     * Update the instances properties from a PHPMailer instance.
     * 
     * @param PHPMailer $phpmailer
     *  An instance of PHPMailer.
     */
    public function init_from_phpmailer( $phpmailer ) {
        // Copy public properties
        foreach ( $phpmailer as $key => $value ) {
            $this->$key = $value;
        }

        // Copy recipients
        $to_addresses       = $phpmailer->getToAddresses();
        $cc_addresses       = $phpmailer->getCcAddresses();
        $bcc_addresses      = $phpmailer->getBccAddresses();
        $reply_to_addresses = $phpmailer->getReplyToAddresses();

        foreach ( $to_addresses as $address ) {
            $this->addAddress( $address[0], $address[1] );
        }

        foreach ( $cc_addresses as $address ) {
            $this->addCc( $address[0], $address[1] );
        }

        foreach ( $to_addresses as $address ) {
            $this->addBcc( $address[0], $address[1] );
        }

        foreach ( $reply_to_addresses as $address ) {
            $this->addReplyTo( $address[0], $address[1] );
        }        
    }
}