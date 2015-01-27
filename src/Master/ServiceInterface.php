<?php

namespace Digecon\ProfileSynchronizer\Master;

/**
 * Interface for master service
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
	
}
