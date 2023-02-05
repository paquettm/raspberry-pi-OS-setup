<?php
function parse_url_pattern($url, $pattern, &$result) {
    $replacements = ['/'=> '\/',
    	'{'=> '(?P<',
    	'}'=> '>[^\/]+)'];
    $regex = '/^' . strtr($pattern,$replacements) . '$/';
    $match = preg_match($regex, $url, $values);
    $result= array_filter($values, "is_string", ARRAY_FILTER_USE_KEY);
    return $match;
}

$parsed_url = null;

$url = '/users/edit/42';
$pattern = '/{controller}/{method}/{id}';
$match = parse_url_pattern($url, $pattern, $parsed_url);

echo "URL    : $url\n", "Pattern: $pattern\n", ($match?"match":"no match"), "\n";
print_r($parsed_url);

$url = '/users/edit/42';
$pattern = '/users/{method}/{id}';
$match = parse_url_pattern($url, $pattern, $parsed_url);

echo "URL    : $url\n", "Pattern: $pattern\n", ($match?"match":"no match"), "\n";
print_r($parsed_url);

$url = '/users/edit/42';
$pattern = '/friends/{method}/{id}';
$match = parse_url_pattern($url, $pattern, $parsed_url);

echo "URL    : $url\n", "Pattern: $pattern\n", ($match?"match":"no match"), "\n";
print_r($parsed_url);

//function register($pattern, $settings = []){
//
//}
