<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); }
// must have an ID
if(empty($_GET['id'])) {
  $session->message("No photograph ID was provided.");
  redirect_to('index.php');
}


$photo = Photograph::find_by_id($_GET['id']);
if(!$photo){
  $session->message("The photo could not be located");
  redirect_to('index.php');
  }


$list_comments = Comment::find_comments_on($photo_id);




if(isset($database)) { $database->close_connection(); } ?>
