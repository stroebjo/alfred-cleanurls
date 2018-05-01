<?php

class Amazon implements URLCleaner
{
	public function isApplicable($host)
	{
		return preg_match('/(www\.)?amazon\.([a-z]{2,3})/i', $host);
	}

	public function getShortURL($url_parts)
	{
		// get ASIN from the path segement
		if (preg_match('/(dp|gp\/product)\/([a-z]+\/)?([a-z0-9]{10})/i', $url_parts['path'], $m)) {
			$shorter_url = $url_parts['scheme'].'://'.$url_parts['host'].'/dp/'.$m[3];
			return $shorter_url;
		}

		return null;
	}

}
