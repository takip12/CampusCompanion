<!DOCTYPE html>

<html>
    <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        #blanket{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            opacity: 0.5;
            background-color: blue;
            z-index: 999;
        }

        .modal-window{
            display: none;
            width: 400px;
            height: 200px;
            position: absolute;
            top: 150px;
            left: calc(50% - 201px);
            border: 1px solid black;
            background-color: white;
            padding: 20px;
            z-index: 1000;
        }

        .modal-label{
            display: inline-block;
            width: 80px;
        }
    </style>

    <title>Message Board</title>

    <script>
    
    window.addEventListener('load', function(){
        document.getElementById('menu-signin').addEventListener('click', show_signin_modal_window);
        document.getElementById('menu-members').addEventListener('click', show_signin_modal_window);
        document.getElementById('menu-calendar').addEventListener('click', show_signin_modal_window);
        document.getElementById('menu-join').addEventListener('click', show_join_modal_window);
        document.getElementById('blanket').addEventListener('click', hide_all_modal_window);
        document.getElementById('cancel-signin').addEventListener('click', hide_all_modal_window);
        document.getElementById('cancel-join').addEventListener('click', hide_all_modal_window);

        <?php
            if(isset($display_type))
                if($display_type == 'signin')
                    echo 'show_signin_modal_window();';
                else if($display_type == 'join')
                    echo 'show_join_modal_window();';
                else
                    ;
        ?>
    });

    function show_signin_modal_window(){
        document.getElementById('blanket').style.display = 'block';
        document.getElementById('signin').style.display = 'block';
    }

    function show_join_modal_window(){
        document.getElementById('blanket').style.display = 'block';
        document.getElementById('join').style.display = 'block';
    }

    function hide_all_modal_window(){
        document.getElementById('blanket').style.display = 'none';
        document.getElementById('signin').style.display = 'none';
        document.getElementById('join').style.display = 'none';
    }

    </script>


    </head>

    <body>
    
<h1>Test Messssage Board</h1>
<hr>

<ul>
<li id='menu-signin'>Sign In</li>
<li id='menu-join'>Join</li>
<li id='menu-list'>List Topics</li>
<li id='menu-members'>View Members</li>
<li id='menu-calendar'>View Community Calendar</li>
</ul>

<div id='content'>
hi
<button>Test</button>
</div>

<div id='blanket'></div>

<div id='signin' class='modal-window'>
<h2>Sign In</h2>
<br>
<form method='post' action='controller.php'>
<input type='hidden' name='page' value='StartPage'>
<input type='hidden' name='command' value='SignIn'>
<label class='modal-label'>Username:</label>
<input type='text' name='username' placeholder='Enter username' required>
<?php if(!empty($error_msg_username)) echo $error_msg_username; ?>

<br>

<label class='modal-label'>Password:</label>
<input type='password' name='password' placeholder='Enter password' required>
<?php if(!empty($error_msg_password)) echo $error_msg_password; ?>
<br>
<br>
<button type='submit' value='Submit'>Submit</button>
<button type='reset' value='Reset'>Reset</button>
<button id='cancel-signin' type='cancel' value='Cancel'>Cancel</button>

</form>
</div>
    
<div id='join' class='modal-window'>
<h2>Join</h2>
<br>
<form method='post' action='controller.php'>
<input type='hidden' name='page' value='StartPage'>
<input type='hidden' name='command' value='Join'>

<label class='modal-label'>Username:</label>
<input type='text' name='username' placeholder='Enter username' required>
<?php if(!empty($error_msg_username)) echo $error_msg_username; ?>

<br>

<label class='modal-label'>Password:</label>
<input type='password' name='password' placeholder='Enter password' required>
<?php if(!empty($error_msg_password)) echo $error_msg_password; ?>
<br>
<br>
<label class='modal-label'>Email:</label>
<input type='text' name='email' placeholder='Enter email' required>
<?php if(!empty($error_msg_password)) echo $error_msg_password; ?>
<br>
<br>
<button type='submit' value='Submit'>Submit</button>
<button type='reset' value='Reset'>Reset</button>
<button id='cancel-join' type='cancel' value='Cancel'>Cancel</button>

</form>
</div>

<script>
$('#menu-list').click(function(){

var url = "controller.php";
var query = {page: "StartPage", command:"ListTopics", searchT: ""};

$.post(url, query, function(){});

$('#content').html();



});
</script>


<script>
$('#menu-members').click(function(){

var url = "controller.php";
var query = {page: "StartPage", command:"ListMembers", searchT: ""};

$.post(url, query, function(data){
    var rows = JSON.parse(data);

    var t = '<table>';
    t += '<tr>';
for(var x in rows[0]){
    t += '<th>' + x + '</th>';
}
t += '</tr>';


    for(var i = 0; i < rows.length; i++){
t+='<tr>';
for(p in rows[i]){
    t+= '<td>' + rows[i][p] + '</td>';
    
}
t+='<button>Submit</button>';
t+='</tr>';
    }
    t+='</table>';
    $('#content').html(t);
});

});
</script>


<script>

$('#menu-calendar').click(function(){

var today = new Date();

document.getElementById("content").innerHTML = newCal(today);

function newCal(date){
    var cal = "<table>";
    cal += month(date);
    cal += week();
    cal += days(date);
    cal += "</table>";
    return cal;
}

function month(date){
    var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var currMonth = date.getMonth();
    var currYear = date.getFullYear();

    return "<caption>" + month[currMonth] + " " + currYear + "</caption>";
}

function week(){
    var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    var row = "<tr>";

    for(var i = 0; i < week.length; i++){
        row += "<th>" + week[i] + "</th>";
    }

    row += "</tr>";
    return row;

}

function monthDays(date){
    var tots = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    var year = date.getFullYear();
    var month = date.getMonth();

    
    return tots[month];
}

function days(date){
    var day = new Date(date.getFullYear(), date.getMonth(), 1);
    var wDay = day.getDay();

    var rows = "<tr>";
    for(var i = 0; i < wDay; i++){
        rows += "<td></td>";
    }

    var mDay = monthDays(date);

   

    for(var i = 1; i <= mDay; i++){
        day.setDate(i);
        wDay = day.getDay();

        if(wDay === 0) rows += "<tr>";
        rows += "<td>" + i + "</td>";
        if(wDay === 6) rows += "</tr>";
    }
    return rows;

}
})
</script>




    </body>
</html>