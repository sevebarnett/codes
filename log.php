<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent) {
    $browser = "Unknown";
    $browser_array = array(
        '/(opera|opr)[\/\s](\S+)/i' => 'Opera',
        '/(edge|edg)/i' => 'Edge',
        '/(chrome|crios)[\/\s](\S+)/i' => 'Chrome',
        '/(safari)[\/\s](\S+)/i' => 'Safari',
        '/(firefox|fxios)[\/\s](\S+)/i' => 'Firefox',
        '/(msie|trident)/i' => 'Internet Explorer',
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
            break;
        }
    }
    return $browser;
}

function getOS($user_agent) {
    $os = "Unknown";
    $os_array = array(
        '/windows/i' => 'Windows',
        '/android/i' => 'Android',
        '/macintosh|mac os x/i' => 'Mac OS',
        '/ios/i' => 'iOS',
        '/linux/i' => 'Linux',
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os = $value;
            break;
        }
    }
    return $os;
}

function getDeviceType($user_agent) {
    $device_type = "Unknown";
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $user_agent)) {
        $device_type = 'Tablet';
    } elseif (preg_match('/Mobile|Android|iPhone|iPod|IEMobile|Opera Mini/i', $user_agent)) {
        $device_type = 'Mobile';
    } else {
        $device_type = 'Desktop';
    }
    return $device_type;
}

$browser = getBrowser($user_agent);
$os = getOS($user_agent);
$device_type = getDeviceType($user_agent);

// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Make a request to ipinfo.io
$details_json = file_get_contents("https://ipinfo.io/{$ip_address}/json");
$details = json_decode($details_json);

// Get the country from the response
$country = isset($details->country) ? $details->country : "Unknown";
$city = isset($details->city) ? $details->city : "Unknown";

//get the folder
$folder = basename(dirname(__FILE__));
//get the page
$page = basename($_SERVER['PHP_SELF'], '.php');

//create file per month
$month = date('Ym'); //202403

// Get visitor's current time
$visit_time = date('Y-m-d H:i:s');

// File path to store the visit log 202403log.txt
$logFile = $month.'log.txt';

// Format the log entry
$log_entry = "$visit_time - $ip_address - $country - $city - $browser - $os - $device_type - $folder - $page\n";

// Append the log entry to the log file
file_put_contents($logFile, $log_entry, FILE_APPEND | LOCK_EX);
?>
