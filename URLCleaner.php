<?php

interface URLCleaner {

	/**
	 * Check's if this class can handle the given hostname.
	 *
	 */
	public function isApplicable($host);

	public function getShortURL($url_parts);
}
