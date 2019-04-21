<?php
/**
 * Integrate Tave and WPForms
 *
 * @package    Integrate_Tave_WPForms
 * @since      1.0.0
 * @copyright  Copyright (c) 2017, Bill Erickson
 * @license    GPL-2.0+
 */

class Integrate_Tave_WPForms {

    /**
     * Primary Class Constructor
     *
     */
    public function __construct() {

        add_filter( 'wpforms_builder_settings_sections', array( $this, 'settings_section' ), 20, 2 );
        add_filter( 'wpforms_form_settings_panel_content', array( $this, 'settings_section_content' ), 20 );
        add_action( 'wpforms_process_complete', array( $this, 'send_data_to_tave' ), 10, 4 );

    }

    /**
     * Add Settings Section
     *
     */
    function settings_section( $sections, $form_data ) {
        $sections['pb_tave'] = __( 'Tave Studio Manager', 'integrate-tave-wpforms' );
        return $sections;
    }


    /**
     * ConvertKit Settings Content
     *
     */
    function settings_section_content( $instance ) {
        echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-pb_tave">';
        echo '<div class="wpforms-panel-content-section-title">' . __( 'Tave Studio Manager', 'integrate-tave-wpforms' ) . '</div>';

        if( empty( $instance->form_data['settings']['pb_tave_api'] ) ) {
            printf(
                '<p>%s <a href="https://tave.com/" target="_blank" rel="noopener noreferrer">%s</a></p>',
                __( 'Don\'t have an account?', 'integrate-tave-wpforms' ),
                __( 'Sign up now!', 'integrate-tave-wpforms' )
            );
        }

        // API Key
        wpforms_panel_field(
            'text',
            'settings',
            'pb_tave_api',
            $instance->form_data,
            __( 'Tave Secret Key', 'integrate-tave-wpforms' )
        );

        // Studio ID
        wpforms_panel_field(
            'text',
            'settings',
            'pb_tave_studio_id',
            $instance->form_data,
            __( 'Tave Studio ID', 'integrate-tave-wpforms' )
        );

        // First Name
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_first_name',
            $instance->form_data,
            __( 'First Name', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'text', 'name' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        // Last Name
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_last_name',
            $instance->form_data,
            __( 'Last Name', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'text', 'name' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        // Email
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_email',
            $instance->form_data,
            __( 'Email Address', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'email' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        // Phone
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_phone',
            $instance->form_data,
            __( 'Mobile Number', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'phone', 'text' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        // Referal Source
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_source',
            $instance->form_data,
            __( 'Lead Source', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'select', 'radio' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        // Job Type
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_job_type',
            $instance->form_data,
            __( 'Job Type', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'select', 'radio' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        // Message
        wpforms_panel_field(
            'select',
            'settings',
            'pb_tave_field_message',
            $instance->form_data,
            __( 'Message', 'integrate-tave-wpforms' ),
            array(
                'field_map'   => array( 'textarea' ),
                'placeholder' => __( '-- Select Field --', 'integrate-tave-wpforms' ),
            )
        );

        echo '</div>';
    }

    /**
     * Integrate WPForms with ConvertKit
     *
     */
    function send_data_to_tave( $fields, $entry, $form_data, $entry_id ) {

        // Get API key and CK Form ID
        $api_key = $tave_studio_id = false;
        if( !empty( $form_data['settings']['pb_tave_api'] ) )
            $api_key = esc_html( $form_data['settings']['pb_tave_api'] );
        if( !empty( $form_data['settings']['pb_tave_studio_id'] ) )
            $tave_studio_id = esc_html( $form_data['settings']['pb_tave_studio_id'] );

        if( ! ( $api_key && $tave_studio_id ) )
            return;

        // Get field values
        $first_name_field_id = esc_html( $form_data['settings']['pb_tave_field_first_name'] );
        $last_name_field_id = esc_html( $form_data['settings']['pb_tave_field_last_name'] );
        $email_field_id = sanitize_email( $form_data['settings']['pb_tave_field_email'] );
        $phone_field_id = esc_html( $form_data['settings']['pb_tave_field_phone'] );
        $source_field_id = esc_html( $form_data['settings']['pb_tave_field_source'] );
        $job_field_id = esc_html( $form_data['settings']['pb_tave_field_job_type'] );
        $message_field_id = esc_html( $form_data['settings']['pb_tave_field_message'] );

        $args = array(
            'SecretKey'   => $api_key,
            'Email'       => $fields[$email_field_id]['value'],
            'FirstName'   => $fields[$first_name_field_id]['value'],
            'LastName'    => $fields[$last_name_field_id]['value'],
            'MobilePhone' => $fields[$phone_field_id]['value'],
            'JobType'     => $fields[$job_field_id]['value'],
            'Source'      => $fields[$source_field_id]['value'],
            'Message'     => $fields[$message_field_id]['value']
        );

        $url = 'https://tave.com/app/webservice/create-lead/' . $tave_studio_id;

        // Required Fields
        if( empty( $args['Email'] ) || empty( $args['FirstName'] ) || empty( $args['LastName'] ) )
            return;

		    // Filter for limiting integration
		    // @see https://www.billerickson.net/code/integrate-convertkit-wpforms-conditional-processing/
        if( ! apply_filters( 'pb_tave_process_form', true, $fields, $form_data ) )
            return;

        // Submit to ConvertKit
        $request = wp_remote_post( add_query_arg( $args, $url ) );

    }

}
new Integrate_Tave_WPForms;
