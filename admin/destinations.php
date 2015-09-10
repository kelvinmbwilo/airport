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
            $sql = "SELECT * FROM destinations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['name'] = $row["name"];
                    $users[$i]['short_name'] = $row["short_name"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }
        //sving users
        if($_GET['page'] == "save"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $sql = "INSERT INTO destinations (name,short_name)
                VALUES ('".$data->name."','".$data->short_name."')";
            $conn->query($sql);
            $users = array();
            $sql = "SELECT * FROM destinations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['name'] = $row["name"];
                    $users[$i]['short_name'] = $row["short_name"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }
        //updateUser
        if($_GET['page'] == "update"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $conn->query("UPDATE destinations SET name='".$data->name."' WHERE id=".$data->id."");
            $conn->query("UPDATE destinations SET short_name='".$data->short_name."' WHERE id=".$data->id."");
            $users = array();
            $sql1 = "SELECT * FROM destinations WHERE id = ".$data->id."";
            $result = $conn->query($sql1);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users['id'] = $row["id"];
                    $users['name'] = $row["name"];
                    $users['short_name'] = $row["short_name"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }
        //sving users
        if($_GET['page'] == "delete"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $conn->query("DELETE FROM destinations WHERE id=".$data->id."");
            $users = array();
            $sql = "SELECT * FROM destinations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['name'] = $row["name"];
                    $users[$i]['short_name'] = $row["short_name"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }


    }

}
