<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 4/12/15
 * Time: 10:59 AM
 */
require_once("connection.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{

    if(isset($_GET['page'])){
        if($_GET['page'] == "fetch"){
            $users = array();
            $sql = "SELECT * FROM arrivals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['flight'] = $row["flight"];
                    $users[$i]['flightname'] = getFlightName($row["flight"],$conn);
                    $users[$i]['picture'] = getFlightPicture($row["flight"],$conn);
                    $users[$i]['source'] = $row["source"];
                    $users[$i]['sourcename'] = getSourceName($row["source"],$conn);;
                    $users[$i]['date'] = $row["date"];
                    $users[$i]['time'] = $row["time"];
                    $users[$i]['usetime'] = prepareTime($row["date"],$row["time"]);
                    $users[$i]['type'] = $row["type"];
                    $users[$i]['status'] = $row["status"];
                    $users[$i]['gate'] = $row["gate"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }

        }
        //sving users
        if($_GET['page'] == "save"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $sql = "INSERT INTO arrivals (flight,source,date,time,type,status,gate)
                VALUES ('".$data->flight."','".$data->source."','".$data->date."','".$data->time."','".$data->type."','".$data->status."','".$data->gate."')";
            $conn->query($sql);
            $users = array();
            $sql = "SELECT * FROM arrivals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['flight'] = $row["flight"];
                    $users[$i]['flightname'] = getFlightName($row["flight"],$conn);
                    $users[$i]['picture'] = getFlightPicture($row["flight"],$conn);
                    $users[$i]['source'] = $row["source"];
                    $users[$i]['sourcename'] = getSourceName($row["source"],$conn);;
                    $users[$i]['date'] = $row["date"];
                    $users[$i]['time'] = $row["time"];
                    $users[$i]['usetime'] = prepareTime($row["date"],$row["time"]);
                    $users[$i]['type'] = $row["type"];
                    $users[$i]['status'] = $row["status"];
                    $users[$i]['gate'] = $row["gate"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }
        //updateUser
        if($_GET['page'] == "update"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $conn->query("UPDATE arrivals SET flight    ='".$data->flight."' WHERE id=".$data->id."");
            $conn->query("UPDATE arrivals SET source    ='".$data->source."' WHERE id=".$data->id."");
            $conn->query("UPDATE arrivals SET date      ='".$data->date."' WHERE id=".$data->id."");
            $conn->query("UPDATE arrivals SET time      ='".$data->time."' WHERE id=".$data->id."");
            $conn->query("UPDATE arrivals SET type      ='".$data->type."' WHERE id=".$data->id."");
            $conn->query("UPDATE arrivals SET status    ='".$data->status."' WHERE id=".$data->id."");
            $conn->query("UPDATE arrivals SET gate    ='".$data->gate."' WHERE id=".$data->id."");
            $users = array();
            $sql1 = "SELECT * FROM arrivals WHERE id = ".$data->id."";
            $result = $conn->query($sql1);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users['id'] = $row["id"];
                    $users['flight'] = $row["flight"];
                    $users['flightname'] = getFlightName($row["flight"],$conn);
                    $users[$i]['picture'] = getFlightPicture($row["flight"],$conn);
                    $users['source'] = $row["source"];
                    $users['sourcename'] = getSourceName($row["source"],$conn);;
                    $users['date'] = $row["date"];
                    $users['time'] = $row["time"];
                    $users[$i]['usetime'] = prepareTime($row["date"],$row["time"]);
                    $users['type'] = $row["type"];
                    $users['status'] = $row["status"];
                    $users['gate'] = $row["gate"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }
        //sving users
        if($_GET['page'] == "delete"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $conn->query("DELETE FROM arrivals WHERE id=".$data->id."");
            $users = array();
            $sql = "SELECT * FROM arrivals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['flight'] = $row["flight"];
                    $users[$i]['flightname'] = getFlightName($row["flight"],$conn);
                    $users[$i]['source'] = $row["source"];
                    $users[$i]['picture'] = getFlightPicture($row["flight"],$conn);
                    $users[$i]['sourcename'] = getSourceName($row["source"],$conn);
                    $users[$i]['date'] = $row["date"];
                    $users[$i]['time'] = $row["time"];
                    $users[$i]['usetime'] = prepareTime($row["date"],$row["time"]);
                    $users[$i]['type'] = $row["type"];
                    $users[$i]['status'] = $row["status"];
                    $users[$i]['gate'] = $row["gate"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }
    }

}

function prepareTime($date,$time){
    $useDate = substr($date,0,10);
    $useTime = substr($time,10);
    return $useDate.$useTime;
}

function getFlightName($id,$conn){
    $sql1 = "SELECT * FROM flights WHERE id = ".$id."";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $name = $row["code"];
        }
        return $name;
    } else {
        return "";
    }
}

function getFlightPicture($id,$conn){
    $sql1 = "SELECT * FROM flights WHERE id = ".$id."";
    $result = $conn->query($sql1);
    $name = "fastjet.png";
//    return $sql1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $name = $row["picture"];
        }
        return $name;
    } else {
        return $name;
    }
}

function getSourceName($id,$conn){
    $sql1 = "SELECT * FROM  destinations WHERE id = ".$id."";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $name = $row["name"]."(".$row["short_name"].")";
        }
        return $name;
    } else {
        return "";
    }
}
