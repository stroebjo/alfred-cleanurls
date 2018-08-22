<?php

class Heise implements URLCleaner
{

	public function isApplicable($host)
	{
		return preg_match('/(www\.)?heise\.de/i', $host);
	}

	public function getShortURL($url_parts)
	{
		if (preg_match('#-([0-9]+)\.html$#i', $url_parts['path'], $m)) {
			$shorter_url = 'https://heise.de/-'.$m[1];
			return $shorter_url;
		}

		return null;

	}

}

