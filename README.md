StopFakeUsers
=============

This [MediaWiki](https://www.mediawiki.org/) extension blocks spam bots from registering, since they will always fill out the real name input.

It will hide the real name input with CSS, however, bots will continue to fill out the real name input. If a real name is submitted, a bot is trying to register and no account is created.

Tested with MediaWiki v.1.21.1

***Note***: Bots will still be able to register via the Mediawiki API. You can only disable the create account API with:

    $wgAPIModules['createaccount'] = 'ApiDisabled';
