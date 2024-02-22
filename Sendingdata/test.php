<?php 
session_start();
 require_once("vendor/autoload.php");
 $desired_view = isset($_GET["view"]) ? $_GET["view"] : DEFAULT_VIEW;
$name="";
$email="";
$message="";
$ErrorMsgName ="";
$ErrorMsgEmail = "";
$ErrorMsg = "";

if (isset($_POST["submit"])){
    $flag = 0;
    $name = isset($_POST["name"])? $_POST["name"] : "";
    $email = isset($_POST["email"])? $_POST["email"] : "";
    $message = isset($_POST["message"])? $_POST["message"] : "";
    if (empty($name) || strlen($name) > Maxlength){
        $ErrorMsgName = "Error: Name is required and must be less than " . Maxlength . " characters.";
        $flag = 1;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ErrorMsgEmail = "Error: is not a valid email address";
        $flag = 1;
    }
    
    if (empty($message) || strlen($message) > Msgmax){
        $ErrorMsg = "Error: Message is required and must be less than " . Msgmax . " characters.";
        $flag = 1;
    }

    
    // if($flag === 0 ){
    //     echo "<b>Thanks for contacting Us</b>";
    //     echo '<br>';
    //     echo "Name : $name";
    //     echo '<br>';
    //     echo "Email : $email";
    //     echo '<br>';
    //     echo "message : $message";

    // }
    if($flag === 0 && submit_to_file($name,$email)){
        echo "<br/> to add a new submit <a href='?view=display'>click here</a>";
        die("contact saved successfully");
    }



} 

if($desired_view == "display"){
    display_submits();
    echo "<br/> to add a new submit <a href='?view=add'>click here</a>";
    exit;
}

?>
<html>
    <head>
        <title> contact form </title>


    </head>
    
    <body>
        <h3> Contact Form </h3>
        <div id="after_submit">
            
        </div>
        <form id="contact_form" action="test.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php echo "$name" ?>" size="30" /><br />
            </div>
            <?php     
            if (!empty($ErrorMsgName)) {
            echo "$ErrorMsgName";
            }
            ?>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php echo "$email" ?>" size="30" /><br />   
            </div>
            <?php     
            if (!empty($ErrorMsgEmail)) {
            echo "$ErrorMsgEmail";
            }
            ?>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" value="<?php echo "$message" ?>" cols="30"></textarea><br />  
            </div>
            <?php     
            if (!empty($ErrorMsg)) {
            echo "$ErrorMsg";
            echo '<br>';
            }
            ?>
            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />
            
            
        </form>
        <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        </script>
    </body>

</html>