<?php
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

$wgExtensionCredits['stopfakeusers'][] = array(
	'path' => __FILE__,
	'name' => 'StopFakeUsers',
	'author' => array( 'Galen Han' ),
	'url' => 'http://galenhan.com',
	'version' => '0.1',
	'descriptionmsg' => 'Stop Fake Users from signing up, by hiding the real name field. Bots will fill out this field. If they do, abort login. '
);

$wgHooks['AbortNewAccount'][] = 'StopFakeUsersHooks::confirmUserCreate';
$wgHooks['BeforePageDisplay'][] = 'StopFakeUsersHooks::hideRealName';
$wgAutoloadClasses['StopFakeUsersHooks'] = "$IP/extensions/StopFakeUsers/StopFakeUsersHooks.php";

//Modify UserCreate form
$wgHooks['UserCreateForm'][] = 'customUserCreateForm';

function customUserCreateForm( &$template ) {

    // include the request global so we can grab the return page from it
    global $wgRequest;

    // grab the return to page if this exists
    $mReturnTo = $wgRequest->getVal( 'returnto' );

    // Grab data from the existing template before we destory it when creating a new template
    $tempData = $template->data ;

    // include our custom create account template
    include( 'templates/customUsercreate.php' );

    // create a new template object using the custom template
    $template = new customUsercreateTemplate();
    $q = 'action=submitlogin&type=signup';
    $linkq = 'type=login';
    $linkmsg = 'gotaccount';

    // if there is a return to page adjust relevant links
    if ( !empty( $mReturnTo ) ) {
        $returnto = '&returnto=' . wfUrlencode( $mReturnTo );
        $q .= $returnto;
        $linkq .= $returnto;
    }

    // add the old template data to the new template
    foreach ($tempData as $key => $value) {
        $template->set( $key, $value ) ;
    }

    // unset the temporary data var
    unset ($tempData) ;

    return true ;
}
