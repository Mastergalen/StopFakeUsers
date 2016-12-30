<?php
class StopFakeUsersHooks {
	public static function confirmUserCreate( $u, &$message ) {
		$nameField = $u->mRealName;

		//If user filled out real name
		if ( $nameField != null ) {
			echo "Detected as spam bot! Go away!";
			return false;
		}

		//always return false while testing
		return true;
	}

	public static function hideRealName(&$out) {
		$out->addInlineStyle('#userlogin #wpRealName{display:none;}');
		# $out->addInlineStyle('#userlogin tr:first-child+tr+tr+tr+tr+tr{display: none;}');
		return true;
	}
}
