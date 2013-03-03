<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
$application_path = dirname(dirname(__DIR__));

$settings = array(
	/**
	 * maxActiveNewsletters tells Newsies how many newsletters
	 * will have a full listing.  If there are more newsletters
	 * than this number, those newsletters will be automatically
	 * added to the archives.
	 */
	'maxActiveNewsletters' 	 => 3,
	
	/**
	 * maxArchivedNewsletters tells Newsies how many newsletters
	 * to display in the archive section.
	 */
	'maxArchivedNewsletters' => 2,
		
	/**
	 * Directory to upload images
	 */
	'imageUploadDirectory' => $application_path . '/data/uploads/images/',
		
	/**
	 * Directory to upload documents
	 */
	'documentUploadDirectory' => $application_path . '/data/uploads/documents/',
);

return array(
	'newsies' => $settings,
);
