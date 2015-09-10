<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 4/12/15
 * Time: 10:59 AM
 */
require_once("connection.php");
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{

    if(isset($_GET['page'])){
        if($_GET['page'] == "logout"){
            session_destroy();
            header("Location: login.php"); /* Redirect browser */
        }
        if($_GET['page'] == "login"){
            $result = $conn->query("SELECT * FROM users WHERE username ='".$_POST['username']."'");
            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    if($row['password'] == $_POST['password']){
                        $_SESSION["name"] = $row['first_name']." ".$row['last_name'];
                        $_SESSION['login'] = "success";
                        header("Location: index.php"); /* Redirect browser */
                        exit();
                    }else{
                        $_SESSION['login'] = "falue";
                        header("Location: login.php?login=falue"); /* Redirect browser */
                    }
                }
            } else {
                $_SESSION['login'] = "falue";
                header("Location: login.php?login=falue"); /* Redirect browser */
            }
        }
        if($_GET['page'] == "fetch"){
            $users = array();
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['first_name'] = $row["first_name"];
                    $users[$i]['last_name'] = $row["last_name"];
                    $users[$i]['email'] = $row["email"];
                    $users[$i]['username'] = $row["username"];
                    $users[$i]['password'] = $row["password"];
                    $users[$i]['phone'] = $row["phone"];
                    $i++;
                }
                echo json_encode($users);
            } else {

                }

            }

        //sving users
        if($_GET['page'] == "save"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $sql = "INSERT INTO users (first_name, last_name, email,username,password,phone)
                VALUES ('".$data->first_name."','".$data->last_name."','".$data->email."','".$data->username."','".$data->password."','".$data->phone."')";
                $conn->query($sql);
                $users = array();
                $sql1 = "SELECT * FROM users";
                $result = $conn->query($sql1);

                if ($result->num_rows > 0) {
                    // output data of each row
                    $i = 0;
                    while($row = $result->fetch_assoc()) {
                        $users[$i]['id'] = $row["id"];
                        $users[$i]['first_name'] = $row["first_name"];
                        $users[$i]['last_name'] = $row["last_name"];
                        $users[$i]['email'] = $row["email"];
                        $users[$i]['username'] = $row["username"];
                        $users[$i]['password'] = $row["password"];
                        $users[$i]['phone'] = $row["phone"];
                        $i++;
                    }
                    echo json_encode($users);
                } else {

                }
            }
        //updateUser
        if($_GET['page'] == "update"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $conn->query("UPDATE users SET first_name='".$data->first_name."' WHERE id=".$data->id."");
            $conn->query("UPDATE users SET last_name='".$data->last_name."' WHERE id=".$data->id."");
            $conn->query("UPDATE users SET email='".$data->email."' WHERE id=".$data->id."");
            $conn->query("UPDATE users SET phone='".$data->phone."' WHERE id=".$data->id."");
            $users = array();
                $sql1 = "SELECT * FROM users WHERE id = ".$data->id."";
                $result = $conn->query($sql1);

                if ($result->num_rows > 0) {
                    // output data of each row
                    $i = 0;
                    while($row = $result->fetch_assoc()) {
                        $users['id'] = $row["id"];
                        $users['first_name'] = $row["first_name"];
                        $users['last_name'] = $row["last_name"];
                        $users['email'] = $row["email"];
                        $users['username'] = $row["username"];
                        $users['password'] = $row["password"];
                        $users['phone'] = $row["phone"];
                        $i++;
                    }
                    echo json_encode($users);
                } else {

                }
            }
        //sving users
        if($_GET['page'] == "delete"){;
            $data = json_decode($HTTP_RAW_POST_DATA);
            $conn->query("DELETE FROM users WHERE id=".$data->id."");
            $users = array();
            $sql1 = "SELECT * FROM users";
            $result = $conn->query($sql1);

            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $users[$i]['id'] = $row["id"];
                    $users[$i]['first_name'] = $row["first_name"];
                    $users[$i]['last_name'] = $row["last_name"];
                    $users[$i]['email'] = $row["email"];
                    $users[$i]['username'] = $row["username"];
                    $users[$i]['password'] = $row["password"];
                    $users[$i]['phone'] = $row["phone"];
                    $i++;
                }
                echo json_encode($users);
            } else {

            }
        }


        }

}
