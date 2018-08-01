<?php

/* Copyright (c) 1998-2010 ILIAS open source, Extended GPL, see docs/LICENSE */

include_once './Services/AuthShibboleth/classes/class.ilShibbolethAuthenticationPlugin.php';
/**
 * Shibboleth authentication plugin for username generation
 *
 * @author Stefan Meyer <smeyer.ilias@gmx.de> 
 *
 **/
class ilRFHKAuthPlugin extends ilShibbolethAuthenticationPlugin
{
	const PLNAME = 'RFHKAuth';
	
	/**
	 * Get plugin name
	 * @return type
	 */
	public function getPluginName()
	{
		return static::PLNAME;
	}
	
	/**
	 * @param ilObjUser $user
	 *
	 * @return ilObjUser
	 */
	public function beforeCreateUser(ilObjUser $user) 
	{
		global $DIC;

		$logger = $DIC->logger()->auth();
		$ilSetting = $DIC->settings();

		$logger->debug('Before user creation (shib): ' . $user->getExternalAccount());
		$shib_uid_field = $ilSetting->get('shib_login');
		$logger->debug('UID field: ' . $shib_uid_field);
		if(strlen($shib_uid_field))
		{
			if(array_key_exists($shib_uid_field, $_SERVER))
			{
				$login = ilAuthUtils::_generateLogin($_SERVER[$shib_uid_field]);
				$user->setExternalAccount($_SERVER[$shib_uid_field]);
				$user->setLogin($login);
			}
		}
		return $user;
	}
}
?>