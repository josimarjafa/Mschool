<?php


require "ActiveRecord.php";


class LatLong
{
    public $latitude; //double
    public $longitude; //double
}

class Address
{
    /**
     * @var LatLong|null
     */
    public $latLong; //LatLong
    public $street; //String
    public $city; //String
    public $state; //String
    public $stateFull; //String
    public $zip; //String
    public $zip4; //String
    public $cityURL; //String
    public $zipURL; //String
    public $html; //String
}


class RankHistory extends \ActiveRecord
{
    public $year; //int
    public $rank; //int
    public $rankOf; //int
    public $rankStars; //int
    public $rankLevel; //String
    public $rankStatewidePercentage; //double
    public $averageStandardScore; //double


    protected function getTable(){
        return get_class($this);
    }

    protected function getData(){
        return get_object_vars($this);
    }
}


class School extends \ActiveRecord
{
    public $schoolid; //String
    public $schoolName; //String
    public $phone; //String
    public $url; //String
    public $urlCompare; //String

    /**
     * @var Address|null
     */
    public $address; //Address
    public $lowGrade; //String
    public $highGrade; //String
    public $schoolLevel; //String
    public $isCharterSchool; //String
    public $isMagnetSchool; //String
    public $isVirtualSchool; //String
    public $isTitleISchool; //String
    public $isTitleISchoolwideSchool; //String
    public $district; //District
    public $county; //County

    /**
     * @var RankHistory[]|null
     */
    public $rankHistory;

    /**
     * @var int|null
     */
    public $rankMovement;
    public $isPrivate; //boolean

    protected function getTable(){
        return get_class($this);
    }

    protected function getData(){
        return get_object_vars($this);
    }
}