<?php

class YouTube implements URLCleaner
{
	public function isApplicable($host)
	{
		return preg_match('/(www\.)?youtube\.com/i', $host);
	}

	public function getShortURL($url_parts)
	{
		if (preg_match('#v=([a-zA-Z0-9_-]{11})#i', $url_parts['query'], $m)) {
			$shorter_url = 'https://youtu.be/'.$m[1];
			return $shorter_url;
		}

		return null;
	}
}
