<?php
error_reporting(E_ALL);

// get clipboard from STDIN (piped in Alfred Script Filter)
$url = fgets(STDIN);
$shorter_url = null;
$response = ['items' => []];


// check if message is an URL and if so get it's <title>
if (filter_var($url, FILTER_VALIDATE_URL)) {

	// load all cleaner classes
	require_once('URLCleaner.php');
	foreach (glob("Cleaner/*.php") as $filename) {
		require_once $filename;
	}

	$cleaners = array_filter(
        get_declared_classes(),
        function ($className) {
            return in_array('URLCleaner', class_implements($className));
        }
	);

	// check if we can handle the URL
	$url_parts = parse_url($url);

	foreach($cleaners as $c) {
		$cleaner = new $c();

		if ($cleaner->isApplicable($url_parts['host'])) {
			$shorter_url = $cleaner->getShortURL($url_parts);
			break;
		}
	}

	if (!is_null($shorter_url)) {
		$response['items'][] = [
			'arg'      => $shorter_url,
			'title'    => $shorter_url,
			'subtitle' => sprintf('New URL is %s chars shorter.', (  strlen($url) - strlen($shorter_url)  )),
			'text' => [
				'copy' => $shorter_url,
			]
		];
	} else {
		$response['items'][] = [
			'arg'      => 'new_url',
			'title'    => 'Sorry, I don\'t know this URL yet.',
			'subtitle' => 'Hit enter for infos on how to add a new URL.',
		];
	}

} else {

	// clipboard doesnt contain a valid URL.
	$response['items'][] = [
		'arg'      => '',
		'title'    => 'Sorry, in your clipboard is no URL',
	];

}

// Report back to Alfred
echo json_encode($response);

