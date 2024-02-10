<?php
ob_start (); // start output buffering
include('db.php');

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat on line</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function aj(){
            var req = new XMLHttpRequest() ;
            req.onreadystatechange = function(){
                if(req.readyState==4 && req.status==200){
                    document.getElementById('chat').innerHTML = req.responseText
                }
            }
        req.open('GET','chat.php',true);
        req.send();
        }
        setInterval(function(){aj()},1000);
    </script>
</head>
<body onload="aj()">
    <div id="container">
        <div id="chatbox">
            <div id="chat">
            </div>
        
        </div>
        <form action="index.php" method="post">
            <input type="text" name="name" placeholder='Enter Your name'>
            <textarea name="msg" placeholder='Enter your message'></textarea>
            <input type="submit" name='submit' value="send">

        </form>
        <?php
        
        if(isset($_POST['submit'])){
            $n = $_POST['name'];
            $m = $_POST['msg'];
        $insert = "INSERT INTO chat (name, msg) VALUES ('$n', '$m')";
        $run_insert = mysqli_query($con, $insert);
            
        header('location: index.php'); // this will work now
        }
        ?>
    </div>
</body>
</html>
<?php
ob_end_flush (); // end output buffering and send output to browser
?>
