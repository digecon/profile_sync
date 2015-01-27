<?php

namespace Digecon\ProfileSynchronizer;

/**
 * Main synchronizer class 
 */
class Synchronizer {
	
	/**
	 * Master service provider
	 * @var Master\ServiceInterface
	 */
	protected $master_service;
	
	/**
	 * Array of slave services provider
	 * @var array
	 */
	protected $slave_services = array();
	
	protected $master_emails = array();
	
	public function __construct(Master\ServiceInterface $master_service) {
	
		$this->master_service = $master_service;
		
	}
	
	public function addSlave(Slave\ServiceInterface $slave_service)
	{
		$this->slave_services[] = $slave_service;		
	}
	
	public function run()
	{
		$this->master_emails = $this->master_service->getAllProfileEmails();
		
		foreach($this->slave_services as $slave_service)
		{
			/* @var $slave_service Slave\ServiceInterface */
			$slave_emails = $slave_service->getAllProfileEmails();			
			$this->checkProfilesExistance($slave_service, $slave_emails);						
		}
		
		foreach($this->master_emails as $email)
		{
			$this->synchonizeProfile($email);
		}
	}
	
	protected function checkProfilesExistance(Slave\ServiceInterface $slave_service)
	{
		$slave_emails = $slave_service->getAllProfileEmails();	
		
		//Add new profiles
		$new_emails = array_diff($this->master_emails, $slave_emails);		
		foreach($new_emails as $email)
		{
			$slave_service->createProfile($email);
		}
		
		//Remove profiles, that not exists in 
		$emails_to_delete = array_diff($slave_emails, $this->master_emails);
		foreach($emails_to_delete as $email)
		{
			$slave_service->removeProfile($email);
		}		
	}
	
	protected function synchonizeProfile($master_email)
	{
		$master_profile = $this->master_service->getProfile($master_email);
		$picture_changed = $master_profile->isProfilePictureChanged();
		$properties_changes = $master_profile->isPropertiesChanged();
		
		if(false == ($picture_changed || $properties_changes))
		{
			return;
		}
		
		$picture_url = $master_profile->getProfilePictureUrl();
		$properties = $master_profile->getProperties();

		foreach($this->slave_services as $slave_service)
		{
			/* @var $slave_service Slave\ServiceInterface */					
			$slave_profile = $slave_service->getProfile($master_email);
			
			if($picture_changed)
			{
				$slave_profile->updateProfilePicture($picture_url);
			}
			
			if($properties_changes)
			{
				$slave_profile->updateProperties($properties);
			}
		}			
	}
	
	
	
}
