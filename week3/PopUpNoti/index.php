<?php
session_start();
if(isset($_POST['reset'])){
  $_SESSION['chats'] = Array();
  header("Location: index.php");
  return;
}
if(isset($_POST['message'])){
  if(!isset($_SESSION['chats'])){
    $_SESSION['chats'] = Array();
  }
  $_SESSION[chats] [] = array($_POST['message'], date(DATE_RFC2822));
  header("Location: index.php");
  return;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Chat</title>
    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <h1>Chat</h1>
    <form action="index.php" method="post">
      <p>
        <input type="text" name="message" size="50">
        <input type="submit" value="Chat">
        <input type="submit" value="reset">
      </p>
    </form>
    <div id="chatcontent">
      <img id="sp_img" src="https://img.fcbayern.com/image/upload/q_auto,f_auto/w_800,h_1067,c_pad/eCommerce/produkte/22160/spinner.png" alt="Loading..."/>
    </div>
    <script type="text/javascript">
      function updateMsg(){
        window.console && console.log("Reqeusting Json");
        $.ajax({
          url: "chatlist.php",
          cache: false,
          success: function(data){
            window.console && console.log("Json Received");
            window.console && console.log(data);
            $('#chatcontent').empty();
            for (var i = 0; i < data.length; i++) {
              entry = data[i];
                $('#chatcontent').append(
                  "<p>" + entry[0] + "<br/>&nbsp;" + entry[1] + "</p>\n"
                );
            }
            setTimeout('updateMsg()', 1000);
          }
        });
      }
      window.console && console.log("Startup complete");
      updateMsg();
    </script>
  </body>
</html>
