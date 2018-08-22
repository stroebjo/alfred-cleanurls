<?php

class Reddit implements URLCleaner
{

	public function isApplicable($host)
	{
		return preg_match('/(www\.)?reddit\.com/i', $host);
	}

	public function getShortURL($url_parts)
	{
		if (preg_match('#r/([a-z_]+)/comments/([a-z0-9]{6})#i', $url_parts['path'], $m)) {
			$shorter_url = 'https://redd.it/'.$m[2];
			return $shorter_url;
		}

		return null;

	}

}
