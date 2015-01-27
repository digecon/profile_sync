<?php

namespace Digecon\ProfileSynchronizer\Slave;

/**
 * Single profile interface for slave services
 */
class ProfileInterface {
	
	/**
	 * Get current profile email
	 * @return string
	 */
	public function getEmail();
	
	/**
	 * Update profile properties
	 * @param array $properties Array of properties (property => value)
	 */
	public function updateProperties(array $properties);
	
	/**
	 * Update profile picture
	 * @param string $picture_url Url to picture or path to local file
	 */
	public function updateProfilePicture($picture_url);
}
