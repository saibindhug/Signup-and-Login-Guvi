<?php

use MongoDB\Operation\InsertOne;
require_once '../vendor/autoload.php';
//$databaseConnection= new MongoDB\Client;
$databaseConnection=new MongoDB\Client('mongodb://localhost:27017');
$myDatabase=$databaseConnection->profiledb;
$userCollection=$myDatabase->userprofile;
/*if($userCollection)
{
    echo "Collection".$userCollection."connected";
}
else{
    echo "Failed to connect to database";
}*/
if(isset($_POST['save']))
{
    $name=$_POST['profile-name'];
    $email=$_POST['profile-email'];
    $dob=$_POST['profile-dob'];
    $age=$_POST['profile-age'];
    $contact=$_POST['profile-contact'];
}
$data=array(
    "Name" => $name ,
    "Email"=>$email,
    "DOB"=>$dob,
    "Age"=>$age,
    "Contact"=>$contact

);

$insert=$userCollection->insertOne($data);

if($insert)
{
    // Fetch and display the profile details after successful insertion
    $profile = $userCollection->findOne(['_id' => $insert->getInsertedId()]);
    if($profile) {
        echo '<style>
                body {
                    margin: 0;
                    padding: 0;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    font-family: "Roboto", sans-serif !important;
                    font-weight: bold;
                    background-color: #A9C9FF;
                    background-image: linear-gradient(180deg, #A9C9FF 0%, #FFBBEC 100%);
                    background-attachment: fixed;
                    background-size: cover;
                }
                .profile-details {
                    width:30%;
                    margin-top:5%;
                    margin-left:20%;
                    padding: 1.5rem 2.5rem;
                    border-radius: 0.6rem;
                    background-color: #ffffff;
                    display: -ms-grid !important;
                    display: grid !important;
                    text-align: left;
                }
                .profile-details h2 {
                    font: italic bold 25px "Tangerine";
                    letter-spacing: -1px;
                    margin-bottom: 0.5rem;
                }
                .profile-details p {
                    margin-bottom: 1rem;
                }
                .profile-field {
                    padding: 0.5rem;
                    border: 1px solid #ccc;
                    border-radius: 0.3rem;
                    margin-bottom: 1rem;
                }
              </style>';

              echo '<div class="profile-details">';
              echo '<h2>Profile Details</h2>';
              echo '<br>';
              echo '<div class="profile-field">Name: ' . $profile['Name'] . '</div>';
              echo '<div class="profile-field">Email: ' . $profile['Email'] . '</div>';
              echo '<div class="profile-field">DOB: ' . $profile['DOB'] . '</div>';
              echo '<div class="profile-field">Age: ' . $profile['Age'] . '</div>';
              echo '<div class="profile-field">Contact: ' . $profile['Contact'] . '</div>';
              echo '</div>';
    } else {
        echo "Failed to fetch the profile details.";
    }
}