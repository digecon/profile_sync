<?php

namespace Digecon\ProfileSynchronizer\Master;

/**
 * Interface for single profile of master service
 */
class ProfileInterface {
	
	/**
	 * Get current profile email
	 * @return string
	 */
	public function getEmail();
	
	/**
	 * Get array of available profile`s properties
	 * @return array (property => value)
	 */
	public function getProperties();
	
	/**
	 * Is profile information changed since last access
	 * @return boolean
	 */
	public function isPropertiesChanged();
	
	/**
	 * Update profile properties changed state, so after calling this method, 
	 * the method isPropertiesChanged must return false till profile properties 
	 * will be changed
	 * @retrurn bool
	 */
	public function updatePropertiesChanged();
	
	/**
	 * Get url to profile picture
	 * @return string
	 */
	public function getProfilePictureUrl();

	/**
	 * Is profile picture changed since last access
	 * @return bool
	 */
	public function isProfilePictureChanged();	
	
	/**
	 * Update profile picture changd state. After calling this method, 
	 * the method isProfilePictureChanged must return false till profile picture 
	 * will be changed
	 */
	public function updateProfilePictureChanged();
}