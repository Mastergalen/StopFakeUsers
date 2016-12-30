<?php
/**
 * Html form for account creation.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Templates
 */

/**
 * @defgroup Templates Templates
 */

if( !defined( 'MEDIAWIKI' ) ) die( -1 );

/**
 * @ingroup Templates
 */
class customUsercreateTemplate extends QuickTemplate {
	function addInputItem( $name, $value, $type, $msg, $helptext = false ) {
		$this->data['extraInput'][] = array(
			'name' => $name,
			'value' => $value,
			'type' => $type,
			'msg' => $msg,
			'helptext' => $helptext,
		);
	}

	function execute() {
		if( $this->data['message'] ) {
?>
	<div class="<?php $this->text('messagetype') ?>box">
		<?php if ( $this->data['messagetype'] == 'error' ) { ?>
			<strong><?php $this->msg( 'loginerror' )?></strong><br />
		<?php } ?>
		<?php $this->html('message') ?>
	</div>
	<div class="visualClear"></div>
<?php } ?>

<div id="signupstart"><?php $this->msgWiki( 'signupstart' ); ?></div>
<div id="userlogin">
	<div class="row">
		<div class="col-md-7">
			<form name="userlogin2" class="form-horizontal" id="userlogin2" method="post" action="<?php $this->text('action') ?>" role="form">
				<?php if( $this->haveData( 'languages' ) ) { ?><div id="languagelinks"><p><?php $this->html( 'languages' ); ?></p></div><?php } ?>
				<div class="form-group">
			    	<label for="wpName" class="col-sm-4 control-label"><?php $this->msg('yourname') ?></label>
			    	<div class="col-sm-8">
			      		<input type="text" class="form-control" id="wpName2" placeholder="<?php $this->msg('yourname') ?>" autofocus name="wpName">
			    	</div>
				</div>
				<div class="form-group">
			    	<label for="wpPassword" class="col-sm-4 control-label"><?php $this->msg('yourpassword') ?></label>
			    	<div class="col-sm-8">
			      		<input type="password" class="form-control" id="wpPassword2" name="wpPassword" placeholder="<?php $this->msg('yourpassword') ?>">
			    	</div>
				</div>
				<div class="form-group">
			    	<label for="wpPassword2" class="col-sm-4 control-label"><?php $this->msg('yourpasswordagain') ?></label>
			    	<div class="col-sm-8">
			      		<input type="password" class="form-control" id="wpRetype" name="wpRetype" placeholder="<?php $this->msg('yourpasswordagain') ?>">
			    	</div>
				</div>
				<div class="form-group">
			    	<label for="wpEmail" class="col-sm-4 control-label"><?php $this->msg('youremail') ?></label>
			    	<div class="col-sm-8">
			      		<input type="email" class="form-control" id="wpEmail" name="wpEmail" placeholder="<?php $this->msg('youremail') ?>">
			      		<span class="help-block">
							<?php  // duplicated in Preferences.php profilePreferences()
								if( $this->data['emailrequired'] ) {
									$this->msgWiki('prefs-help-email-required');
								} else {
									$this->msgWiki('prefs-help-email');
								}
								if( $this->data['emailothers'] ) {
									$this->msgWiki('prefs-help-email-others');
								} ?>
						</span>
			    	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php $this->html('extrafields') ?>
					</div>
				</div>
				<div class="form-group" style="display: none;">
					<label for="wpRealName" class="col-sm-4 control-label"><?php $this->msg('yourrealname') ?></label>
			    	<div class="col-sm-8">
						<input type="text" class="form-control" id="wpRealName" name="wpRealName" placeholder="<?php $this->msg('yourrealname') ?>" size="20">
			    	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php $this->html('header'); /* pre-table point for form plugins... */ ?>
					</div>
				</div>
				<?php if( $this->data['canremember'] ) : ?>
					<?php
					global $wgCookieExpiration;
					$expirationDays = ceil( $wgCookieExpiration / ( 3600 * 24 ) );
					?>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
				            <div class="checkbox">
				              	<label>
				                	<input type="checkbox" id="wpRemember" name="wpRemember" value="1"> <?php echo wfMessage( 'remembermypassword' )->numParams( $expirationDays )->text() ?>
				              	</label>
				            </div>
				        </div>
					</div>
				<?php endif; ?>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" id="wpCreateaccount" name="wpCreateaccount" class="btn btn-success"><?php $this->msg('createaccount') ?></button>
					</div>
				</div>
			<?php if( $this->haveData( 'uselang' ) ) { ?><input type="hidden" name="uselang" value="<?php $this->text( 'uselang' ); ?>" /><?php } ?>
			<?php if( $this->haveData( 'token' ) ) { ?><input type="hidden" name="wpCreateaccountToken" value="<?php $this->text( 'token' ); ?>" /><?php } ?>
			</form>
		</div>
		<div class="col-md-offset-1 col-md-4">
			<p class="lead">Create a wiki account and start editing articles.</p>
			<p id="userloginlink"><?php $this->html('UserLogin') ?></p>
		</div>
	</div>
</div>
<div id="signupend"><?php $this->html( 'signupend' ); ?></div>
<?php

	}
}
