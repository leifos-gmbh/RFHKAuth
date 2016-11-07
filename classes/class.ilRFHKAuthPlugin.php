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
		ilLoggerFactory::getLogger('auth')->debug('Plugin called for user');
		$user->setLogin('smeyer_shib');
		
		return $user;
	}

}
?>