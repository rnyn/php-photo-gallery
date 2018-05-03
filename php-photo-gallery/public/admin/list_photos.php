<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php

//1 the current page Number
$page = !empty($_GET['page'])  ? (int)$_GET['page'] : 1;
//2 records per page ($per_page)
$per_page = 5;
//3 total record count ($total_count)
$total_count = Photograph::count_all();
//Find all photos
//use pagination instead
// $photos = Photograph::find_all();
//
$pagination = new Pagination($page, $per_page, $total_count);
  // Find all the photos
  //$photos = Photograph::find_all();
  // instead of finding all records just find enough for this page
  $sql  = "SELECT * FROM photographs ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $photos = Photograph::find_by_sql($sql);
?>
<?php include_layout_template('admin_header.php'); ?>

<h2>Photographs</h2>
<?php echo output_message($message); ?>
<div id="upload" style="float: center;">
<a href="photo_upload.php"><button name="upload" type="button">Upload a new photograph</button></a>
</div>
<p />
<table>
  <tr>
    <th>Image</th>
    <th>Filename</th>
    <th>Caption</th>
    <th>Size</th>
    <th>Type</th>
    <th>Comments</th>
    <th>&nbsp;</th>

  </tr>
<?php foreach($photos as $photo): ?>
  <tr>
    <td><a href="../photo.php?id=<?php echo $photo->id;?>"><img src="../<?php echo $photo->image_path(); ?>" width="100" /></a></td>
    <td style="text-decoration:underline;"><?php echo $photo->filename; ?></td>
    <td><?php echo $photo->caption; ?></td>
    <td><?php echo $photo->size; ?></td>
    <td style="text-align:center;"><?php echo $photo->type; ?></td>
    <td style="text-align:center;"><a href="comments.php?id=<?php echo $photo->id; ?>"><?php echo count($photo->comments()); ?></a></td>
    <td><button><a href="delete_photo.php?id=<?php echo $photo->id;?>" style="color:red;">Delete</a></button></td>
  </tr>
<?php endforeach; ?>
</table>

<div id="pagination" style="clear: both;">
<?php  if($pagination->total_pages() > 1) {

    if($pagination->has_previous_page()){
      echo "<a href=\"list_photos.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo Previous;</a> ";
    }
    for($i=1; $i <= $pagination->total_pages(); $i++){
      if($i == $page){
        echo "<span class=\"selected\">{$i}</span> ";
      }else {
      echo "<a href=\"list_photos.php?page={$i}\">{$i}</a> ";
    }
  }

      if($pagination->has_next_page()){
        echo "<a href=\"list_photos.php?page=";
        echo $pagination->next_page();
        echo "\">Next &raquo;</a> ";
      }
    }


?>
</div>
<?php include_layout_template('admin_footer.php'); ?>
