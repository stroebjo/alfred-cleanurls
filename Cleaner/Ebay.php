<?php

class Ebay implements URLCleaner
{

	public function isApplicable($host)
	{
		return preg_match('/(www\.)?ebay\.([a-z]{2,3})/i', $host);
	}

	public function getShortURL($url_parts)
	{
		if (preg_match('/(itm)\/(.+)\/([0-9]+)/i', $url_parts['path'], $m)) {
			$shorter_url = $url_parts['scheme'].'://'.$url_parts['host'].'/itm/'.$m[3];
			return $shorter_url;
		}

		return null;

	}

}
