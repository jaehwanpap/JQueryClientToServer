<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find User Age</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f8f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px 80px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            color: #1d1d1f;
        }
        input, button {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            border: 1px solid #d1d1d1;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
        }
        button {
            background-color: #0071e3;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Information</h2>
    <input type="text" id="username" name="username" placeholder="Enter Username">
    <button id="findUserAge">Find Age</button>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-text">Some text in the Modal..</p>
    </div>
</div>

<script>
jQuery(document).ready(function() {
    var modal = jQuery('#myModal');
    var span = jQuery('.close');

    jQuery('#findUserAge').click(function() {
        var userName = jQuery('#username').val();
        if (!userName) {
            jQuery('#modal-text').text('Please enter a username.');
            modal.css('display', 'block');
            return;
        }

        jQuery.ajax({
            url: 'userInfo.php',
            type: 'GET',
            dataType: 'json',
            success: function(users) {
                var userFound = false;
                jQuery.each(users, function(index, user) {
                    if (user.name.toLowerCase() === userName.toLowerCase()) {
                        jQuery('#modal-text').text('Name: ' + user.name + ', Age: ' + user.age);
                        modal.css('display', 'block');
                        userFound = true;
                        return false;
                    }
                });
                if (!userFound) {
                    jQuery('#modal-text').text('User not found.');
                    modal.css('display', 'block');
                }
            },
            error: function() {
                jQuery('#modal-text').text('Error loading user information.');
                modal.css('display', 'block');
            }
        });
    });

    span.click(function() {
        modal.css('display', 'none');
    });

    jQuery(window).click(function(event) {
        if (event.target.id === 'myModal') {
            modal.css('display', 'none');
        }
    });
});
</script>

</body>
</html>
