<?php

// Database Connection
require 'dbh.inc.php';

$user__id = $_SESSION['user_id']; // Assign id of current user using a session variable

// If user clicks the 'like' or 'dislike'
if (isset($_POST['action'])) {

    // Declare variables   
    $idea_id = $_POST['idea_id'];
    $action = $_POST['action'];

    switch ($action) {
        // Insert into rating table if user likes an idea
        case 'like':
            $sql="INSERT INTO rating (idea_id, user__id, vote) 
                   VALUES ($idea_id, $user__id, 'like') 
                   ON DUPLICATE KEY UPDATE vote = 'like'";
            break;
        // Insert into rating table if user dislikes an idea
        case 'dislike':
            $sql="INSERT INTO rating (idea_id, user__id, vote) 
                   VALUES ($idea_id, $user__id, 'dislike') 
                   ON DUPLICATE KEY UPDATE vote = 'dislike'";
            break;
        // Remove from rating table if user unlikes an idea
        case 'unlike':
            $sql="DELETE FROM rating WHERE user__id = $user__id AND idea_id = $idea_id";
            break;
        // Remove from rating table if user un-dislikes an idea
        case 'undislike':
            $sql="DELETE FROM rating WHERE user__id = $user__id AND idea_id = $idea_id";
            break;
        default:
            break;
    }
    
    // Execute query
    mysqli_query($conn, $sql);
    echo getVotes($idea_id);
    exit(0);

}

// Get the total number of likes for a particular idea
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating 
  		  WHERE idea_id = $id AND vote = 'like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get the total number of dislikes for a particular idea
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating 
  		  WHERE idea_id = $id AND vote = 'dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular idea
function getVotes($id)
{
  global $conn;
  $votes = array();
  $likes_query = "SELECT COUNT(*) FROM rating WHERE idea_id = $id AND vote = 'like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating WHERE idea_id = $id AND vote = 'dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $votes = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  // Encode an associative array 'votes' into a JSON object
  return json_encode($votes);
}

// Check whether or not the user has already liked the idea
function userLiked($idea_id)
{
  global $conn;
  global $user__id;
  $sql = "SELECT * FROM rating WHERE user__id = $user__id 
  		  AND idea_id = $idea_id AND vote = 'like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check whether or not the user has already disliked the idea
function userDisliked($idea_id)
{
  global $conn;
  global $user__id;
  $sql = "SELECT * FROM rating WHERE user__id = $user__id 
          AND idea_id = $idea_id AND vote = 'dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}