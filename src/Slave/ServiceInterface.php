<?php

namespace Digecon\ProfileSynchronizer\Slave;

/**
 * Interface for slave service
 */
interface ServiceInterface {		
	
	/**
	 * Returns array of all profile emails, registered in master service
	 * @return array
	 */
	public function getAllProfileEmails();
	
	/**
	 * Get profile by email
	 * @param string $email profile email
	 * @return ProfileInterface
	 */
	public function getProfile($email);
	
	/**
	 * Remove or deactivate profile by email
	 * @param string $email
	 */
	public function removeProfile($email);
	
	/**
	 * Create new profile.
	 * @param string $email
	 * @return ProfileInterface
	 */
	public function createProfile($email);
	
	
}
