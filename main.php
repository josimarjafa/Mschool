<?php

require_once "src/App.php";

/// get the data

$jsonurl = "https://api.schooldigger.com/v1.2/schools?st=MA&page=2&perPage=50&appID=78329e3a&appKey=74c1b49ba5ed234c912ebb30a84324a0";
$json = file_get_contents($jsonurl);
$result = json_decode($json);

$list = [];
$pages = intval($result->numberOfPages);
$numShcool= $result->numberOfSchools;
echo "\n";
App::$logger->info("There is {$numShcool} school");
App::$logger->info("Retrieving 50 school (max) from {$pages} request ....");

foreach (range(1, 1) as $page) {

    $jsonurl = "https://api.schooldigger.com/v1.2/schools?st=MA&page={$page}&perPage=50&appID=78329e3a&appKey=74c1b49ba5ed234c912ebb30a84324a0";

    $json = file_get_contents($jsonurl);
    $result = json_decode($json);

    $list_json = $result->schoolList;

    $mapper = new JsonMapper();
    $mapper->bStrictNullTypes = false;
    $mapper->bRemoveUndefinedAttributes = true;

    $school_page_list= $mapper->mapArray(
        $list_json, array(), 'School'
    );

    $list = array_merge($list, $school_page_list);

    App::$logger->debug("Page {$page}, ".count($school_page_list)." school from {$jsonurl}");

}

App::$logger->info("Number of school retrieved $numShcool/".count($list));


/// save on database
echo "\n";
App::$logger->info("Saving on Database ....");

foreach ($list as $shool) {
    $shool->save();
    if($shool->rankHistory != null)
        foreach ($shool->rankHistory as $rank){
            if(intval($rank->year) >= 2015)
                $rank->save();
        }
}

// test

$savedSchool = App::$database->select("SELECT count(*) from ".School::class)[0]["count(*)"];
$savedRank= App::$database->select("SELECT count(*) from ".RankHistory::class)[0]["count(*)"];

App::$logger->info("Saved $numShcool/$savedSchool School and $savedRank ranks from the last 5 years");

echo "\n";
echo "Have a good day";




