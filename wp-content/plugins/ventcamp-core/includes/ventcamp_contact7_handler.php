<?php

/* Custom Contact 7 Form Handler */
if( !function_exists('ventcamp_wpcf7_on_success_send_mail') ) {
	function ventcamp_wpcf7_on_success_send_mail($WPCF7_ContactForm) {
		$email = $fullname = $hide_after_send = $redirect_after_send = $use_mailchimp = '';
		$on_sent_ok_array = array();

		$submission = WPCF7_Submission::get_instance();
		$data = $submission->get_posted_data();
		$api_key = get_option('ventcamp_mailchimp_api_key', '');

		if ( !empty($data['_wpcf7_vsc_hide_after_send']) ) {
			$hide_after_send = $data['_wpcf7_vsc_hide_after_send'];
		}

		if ( !empty($data['_wpcf7_vsc_use_mailchimp']) ) {
			$use_mailchimp = $data['_wpcf7_vsc_use_mailchimp'];
		}

		if ( !empty($data['_wpcf7_vsc_redirect_after_send']) ) {
			$redirect_after_send = $data['_wpcf7_vsc_redirect_after_send'];
		}

		if ( !empty($data['_wpcf7_unit_tag']) ) {
			$unit_id = $data['_wpcf7_unit_tag'];
		}

		if ( !empty($data['EMAIL']) ) {
			$email = $data['EMAIL'];
		}

		if ( !empty($data['FULLNAME']) ) {
			$fullname = $data['FULLNAME'];
		}

		$hide_after_send = (filter_var($hide_after_send, FILTER_VALIDATE_BOOLEAN) === true);
		$use_mailchimp = (filter_var($use_mailchimp, FILTER_VALIDATE_BOOLEAN) === true);
		$redirect_after_send = (filter_var($redirect_after_send, FILTER_VALIDATE_BOOLEAN) === true);

		$wpcf7 = WPCF7_ContactForm::get_current();
		$on_sent_ok = $wpcf7->additional_setting('on_sent_ok', false);
		//error_log( print_r($on_sent_ok, true) ); // simple write data to wp-content/debug.log. Check it!!!

		foreach( $on_sent_ok as $action ) {
			$on_sent_ok_array[] = "on_sent_ok: $action";
		}

		// check if form should be hidden on successful submit
		if( $hide_after_send ) {
			$on_sent_ok_array[] = "on_sent_ok: \"$('#$unit_id .form').hide();\"";
		}

		if( $use_mailchimp && !empty($api_key) ) { // code for mailchimp here
			$list_id = $data['_wpcf7_vsc_mailchimp_list_id'];
			$dopt = (filter_var($data['_wpcf7_vsc_double_opt'], FILTER_VALIDATE_BOOLEAN) === true); // check this!!
			require_once ( WP_PLUGIN_DIR . '/ventcamp-core/includes/lib/mailchimp/inc/MCAPI.class.php' );

			// grab an API Key from http://admin.mailchimp.com/account/api/
			$api = new MCAPI($api_key);

			//check if we receive merged input field and process new data for API call
			if ($fullname != ''){

				$tmp = explode (" ", $fullname, 2); // for name as Alex Victor Maria
				$fname = $tmp[0];
				$lname = $tmp[1];

			} else {

				$fname = $data['FNAME'];
				$lname =  $data['LNAME'];

			}

			$merge_vars = Array(
					'email' => $email,
					'FNAME' => $fname, //$fname
					'LNAME' => $lname  //$lname
			);

			$data['mailchimp_result'] = ($api->listSubscribe($list_id, $email, $merge_vars, '', $dopt) === true) ? 'Success! Check your email to confirm sign up.' : 'Error: ' . $api->errorMessage;

			//error_log( print_r( $data, true ) ); // simple write data to wp-content/debug.log. Check it!!!
		}

		if( $redirect_after_send && !empty($data['_wpcf7_vsc_redirect_url']) ) { // code for redirect here
			$redirect_url = base64_decode( $data['_wpcf7_vsc_redirect_url'] );
			$on_sent_ok_array[] = "on_sent_ok: \"window.location.href='{$redirect_url}';\"";

		}

		if( count($on_sent_ok_array) > 0 ) {
			$properties = array('additional_settings' => implode("\n", $on_sent_ok_array));
			$wpcf7->set_properties($properties);

		}

	}
}

add_action("wpcf7_mail_sent", "ventcamp_wpcf7_on_success_send_mail");

?>
