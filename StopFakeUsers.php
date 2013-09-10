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
