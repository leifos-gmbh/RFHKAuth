<?php

/* Copyright (c) 1998-2010 ILIAS open source, Extended GPL, see docs/LICENSE */

include_once './Services/AuthShibboleth/classes/class.ilShibbolethAuthenticationPlugin.php';
/**
 * Description of class class 
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
		global $ilSetting;
		
		ilLoggerFactory::getLogger('auth')->debug('Before user creation (shib): ' . $user->getExternalAccount());
		
		$shib_uid_field = $ilSetting->get('shib_uid');
		if(array_key_exists($shib_uid_field, $_SERVER))
		{
			$user->setLogin($_SERVER[$shib_uid_field]);
			$user->setExternalAccount($_SERVER[$shib_uid_field]);
		}
		return $user;
	}
}
?>