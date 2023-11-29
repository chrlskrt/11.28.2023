<?php

session_start();

// users JSON
$usersJSON = '../data/users.json';

// posts JSON
$postsJSON = '../data/posts.json';

// comments JSON
$commentsJSON = '../data/comments.json';

$currentUser = null;

// to store current user using the forum
if (isset($_SESSION["username"])){
    $currentUser = json_decode($_SESSION["username"], true);
}

// function that will check if a user exists
function isExistingUser($username){
    $users = getUsersData();
    foreach($users as $user){
        if($user["username"] == $username){
            return $user["id"];
        }
    }

    return -1;
}
// function that will handle log in
function handleLogIn(){
    $result = isExistingUser($_POST["username"]);
    if ($result === -1){
        return 0; // user not found
    }

    $users = getUsersData();
    echo '<script>console.log("'.$users[$result].'"); </script>'; 
    if ($users[$result - 1]["password"] == $_POST["password"]){
        $_SESSION["username"] = json_encode($_POST["username"], true);
        return 1; // success
    }

    return -1; // password unmatch
}


// function that will handle sign up
function handleSignUp(){
    global $usersJSON;
    $users = getUsersData();

    if (isExistingUser($_POST["username"]) !== -1){
        return false; // already exists
    }

    $new_id = count($users) + 1;

    $users[] = array(
        "id" => $new_id,
        "name" => $_POST['name'],
        "username" => $_POST['username'],
        "password" => $_POST["password"],
        "email" => $_POST['email'],
        "address" => [
            "street" => $_POST['street'],
            "barangay" => $_POST['barangay'],
            "city" => $_POST['city']
        ]
    );
    

    file_put_contents($usersJSON, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION["username"] = json_encode($_POST["username"], true);
    
    return true;
}

// function get users from json
function getUsersData() {
    global $usersJSON;
    if (!file_exists($usersJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($usersJSON);
    return json_decode($data, true);
}

// function get posts from json
function getPostsData() {
    global $postsJSON;
    if (!file_exists($postsJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($postsJSON);
    return json_decode($data, true);
}

// function get comments from json
function getCommentsData() {
    global $commentsJSON;
    if (!file_exists($commentsJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($commentsJSON);
    return json_decode($data, true);
}


function getPosts(){
    
    $users = getUsersData();
    
    $posts = getPostsData();
    
    $comments = getCommentsData();
    
    $postsarr = array();
    
    foreach($posts as $post){
        foreach($users as $user){
            if($user['id'] == $post['uid']){
                $post['uid'] = $user;
                
                break;
            }
        }
        $post['comments'] = array();
        foreach($comments as $comment){
            if($post['id']==$comment['postId']){
                $post['comments'][] = $comment;
            }
        }
        $postarr[] = $post;
    }
    $str = "";
    foreach($postarr as $parr){
        
    
 $str.='<!-- start of post -->
    <div class="row">
        <div class="col-md-12">
            <div class="post-content">

              <div class="post-container">
                <img src="https://ui-avatars.com/api/?rounded=true&name='.$parr['uid']['name'].'" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">'. $parr['uid']['name'] .'</a></h5>
                  </div>
                  <div class="reaction">
                    <!--<a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>-->
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <h3>'.$parr['title'].'</h3>
                    <p>'.$parr['body'].'</p>
                  </div>
                  <div class="line-divider"></div>';
        foreach($parr['comments'] as $comm)
                $str .=  '<div class="post-comment">
                    <img src="https://ui-avatars.com/api/?rounded=true&name='.$comm['name'].'" alt="" class="profile-photo-sm">
                    <p>'.$comm['body'].'</p>
                  </div>';
                 
                  
    $str.='</div>
              </div>
            </div>
        </div>
    </div>';
    }
return $str;
}

?>