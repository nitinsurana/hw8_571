<?php
//error_reporting(E_ALL ^ E_NOTICE);
define('API_KEY', '682b365f52874343b644bc3d6a0149e4');
?>
<?php
if (isset($_REQUEST['submit'])) {
    $db = $apiBase = $_REQUEST['db'];
    $apiUrl = "";
    switch ($apiBase) {
        case "Legislators":
            if (isset($_REQUEST['bioguide_id'])) {
                $bioguideId = $_REQUEST['bioguide_id'];
                $apiUrl = "http://congress.api.sunlightfoundation.com/legislators?bioguide_id=$bioguideId&all_legislators=true&apikey=" . API_KEY;
                $pjson = callApi($apiUrl);

                //Fetching Committees
                $cUrl = "http://congress.api.sunlightfoundation.com/committees?per_page=5&member_ids=$bioguideId&apikey=" . API_KEY;
                $cjson = callApi($cUrl);

                //Fetching Bills
                $bUrl = "http://congress.api.sunlightfoundation.com/bills?per_page=5&sponsor_id=$bioguideId&apikey=" . API_KEY;
                $bjson = callApi($bUrl);

                //Merge all 3
                $obj = array();
                $obj['legislator'] = json_decode($pjson);
                $obj['committees'] = json_decode($cjson);
                $obj['bills'] = json_decode($bjson);
                $pjson = json_encode($obj);
            } else {
                $apiUrl = "http://congress.api.sunlightfoundation.com/legislators?per_page=all&apikey=" . API_KEY;
                $pjson = callApi($apiUrl);
            }
            break;
        case "Committees":
            $apiUrl = "http://congress.api.sunlightfoundation.com/committees?per_page=all&apikey=" . API_KEY;
            $pjson = callApi($apiUrl);
            break;
        case "Bills":
            if (isset($_REQUEST['bill_id'])) {
                $billId = $_REQUEST['bill_id'];
                $apiUrl = "http://congress.api.sunlightfoundation.com/bills?bill_id=$billId&apikey=" . API_KEY;
                $pjson = callApi($apiUrl);
            } else {
                $apiUrl = "http://congress.api.sunlightfoundation.com/bills?per_page=50&history.active=true&apikey=" . API_KEY;
                $activeJson = callApi($apiUrl);

                $apiUrl = "http://congress.api.sunlightfoundation.com/bills?per_page=50&history.active=false&apikey=" . API_KEY;
                $newJson = callApi($apiUrl);
                $obj = array();
                $obj['active'] = json_decode($activeJson);
                $obj['new'] = json_decode($newJson);
                $pjson = json_encode($obj);
            }
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