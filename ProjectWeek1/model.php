

<?php


$conn = mysqli_connect('localhost', 'ppapadopoulos', 'takip12', 'C354_ppapadopoulos');


function list_topics(){
    global $conn;

    $sql = "select * from TestTopics";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        while($rows = mysqli_fetch_assoc($result)){

        if($rows['response'] == 0){
            echo '<div class="comment">';
            echo "<p><h1>{$rows['subject']}</h1></p>";
            echo "<p>{$rows['message']}</p>";
            echo "<br />by {$rows['user']} <a href='#' class='getComment'>Comments</a><hr />";
            echo "<div class='comments'>";
            echo "<form id='form'>";
            echo "<textarea name='comment' class = 'comment' cols=30 rows=10>Enter message</textarea><br />";
            echo "<input type=hidden name='username' value={$rows['user']}>";
            echo "<input type=hidden name='subject' value={$rows['subject']}>";
            echo "<input type=hidden name='response' value=1>";
            echo "<input type=hidden name='message' value={$rows['message']}>";
            echo "<input type=hidden name='topicId' value={$rows['topicId']}>";
            echo "<button type='button' id='theButton'>Post</button></form></div>";
        
        }else {
            echo "<div class='comments'>";
            echo "{$rows['message']}<br />";
            echo "by {$rows['user']}<br /><hr />";
            echo "</div>";
        }
    }
    }

}



/*

function list_topics($term){


    global $conn;
    
    $sql = "SELECT * FROM TestTopics where (id like '%$term%')";

    $result = mysqli_query($conn, $sql);
    
    $data = array();
    $i = 0;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            
            $data[$i++] = $row;
            
            
        }
        echo json_encode($data);
       
    }
    
    return;
}
*/


function list_members($term){
    global $conn;
    
    $sql = "SELECT * FROM TestMembers where (id like '%$term%')";

    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $data[$i++] = $row;
        }
        echo json_encode($data);
    }
    return;
}


?>