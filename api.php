<?php
//error_reporting(E_ALL ^ E_NOTICE);
define('API_KEY', '682b365f52874343b644bc3d6a0149e4');
$allStates = array(
    "Alabama" => "AL",
    "Montana" => "MT",
    "Alaska" => "AK",
    "Nebraska" => "NE",
    "Arizona" => "AZ",
    "Arkansas" => "AR",
    "Colorado" => "CO",
    "Nevada" => "NV",
    "New Hampshire" => "NH",
    "California" => "CA",
    "New Jersey" => "NJ",
    "New Mexico" => "NM",
    "Connecticut" => "CT",
    "New York" => "NY",
    "Delaware" => "DE",
    "North Carolina" => "NC",
    "District Of Columbia" => "DC",
    "North Dakota" => "ND",
    "Florida" => "FL",
    "Ohio" => "OH",
    "Georgia" => "GA",
    "Oklahoma" => "OK",
    "Hawaii" => "HI",
    "Oregon" => "OR",
    "Idaho" => "ID",
    "Pennsylvania" => "PA",
    "Illinois" => "IL",
    "Rhode Island" => "RI",
    "Indiana" => "IN",
    "South Carolina" => "SC",
    "Iowa" => "IA",
    "South Dakota" => "SD",
    "Kansas" => "KS",
    "Tennessee" => "TN",
    "Kentucky" => "KY",
    "Texas" => "TX",
    "Louisiana" => "LA",
    "Utah" => "UT",
    "Maine" => "ME",
    "Vermont" => "VT",
    "Maryland" => "MD",
    "Virginia" => "VA",
    "Massachusetts" => "MA",
    "Washington" => "WA",
    "Michigan" => "MI",
    "West Virginia" => "WV",
    "Minnesota" => "MN",
    "Wisconsin" => "WI",
    "Mississippi" => "MS",
    "Wyoming" => "WY",
    "Missouri" => "MO"
);
?>
<?php
if (isset($_REQUEST['submit'])) {
    $db = $apiBase = $_REQUEST['db'];
    $chamber = $_REQUEST['chamber'];
    $rawKeyword = trim($_REQUEST['keyword']);
    $keyword = ucwords(strtolower($rawKeyword));
    $page = $_REQUEST['page'] || 1;
    if (array_key_exists($keyword, $allStates)) {
        $state = "&state=" . $allStates[$keyword];
    } else {
        $splitArr = preg_split("/\s+/", $rawKeyword, 2);
        if (count($splitArr) == 2) {
            //If all uppercase or all lowercase
            if (ctype_upper(str_replace(' ', '', $rawKeyword)) || ctype_lower(str_replace(' ', '', $rawKeyword))) {
                $state = "&first_name=" . urlencode(ucwords(strtolower($splitArr[0]))) . "&last_name=" . urlencode(ucwords(strtolower($splitArr[1])));
            } else {
                $state = "&first_name=" . urlencode($splitArr[0]) . "&last_name=" . urlencode($splitArr[1]);
            }
        } else {
            $state = "&query=" . urlencode($rawKeyword);
        }
    }
    $apiUrl = "";
    switch ($apiBase) {
        case "Legislators":
            $apiUrl = "http://congress.api.sunlightfoundation.com/legislators?per_page=all&apikey=" . API_KEY;     //chamber=" . $chamber . $state . "&apikey=" . API_KEY;
            $pjson = callApi($apiUrl);
            break;
        case "Committees":
            $apiUrl = "http://congress.api.sunlightfoundation.com/committees?committee_id=" . strtoupper($rawKeyword) . "&chamber=" . $chamber . "&apikey=" . API_KEY;
            $pjson = callApi($apiUrl);
            break;
        case "Bills":
            $apiUrl = "http://congress.api.sunlightfoundation.com/bills?bill_id=" . strtolower($rawKeyword) . "&chamber=" . $chamber . "&apikey=" . API_KEY;
            $pjson = callApi($apiUrl);
            break;
        case "Amendments":
            $apiUrl = 'http://congress.api.sunlightfoundation.com/amendments?amendment_id=' . strtolower($rawKeyword) . '&chamber=' . $chamber . '&apikey=' . API_KEY;
            $pjson = callApi($apiUrl);
            break;
    }
    header('Content-type: application/json; charset=UTF-8');
    echo $pjson;
}
function callApi($apiUrl)
{
    return $json = file_get_contents($apiUrl);
}

?>