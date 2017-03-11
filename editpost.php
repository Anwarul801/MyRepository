<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
 
<?php
    if (!isset($_GET['editid']) || $_GET['editid'] == NULL) {
        echo "<script>window.location = 'postlist.php'</script>";
        
    } else{
        $editid = $_GET['editid'];
    }
   
?>
            <div class="box round first grid">
                <h2>Update  Post</h2>
                <div class="block">

<?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      $title = mysqli_real_escape_string($db->link, $_POST['title']);
                      $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                      $author = mysqli_real_escape_string($db->link, $_POST['author']);
                      $tag = mysqli_real_escape_string($db->link, $_POST['tag']);
                      $body = mysqli_real_escape_string($db->link, $_POST['body']);
                      
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;


                      if ($title == "" || $cat == "" || $author == "" || $tag == "" || $body == "" ) {
                        echo  "<span class='error'>Field Must Not Be Empty....!!</span>";


            }else{

            if (!empty($file_name)) {
     if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";

    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    } else{
    move_uploaded_file($file_temp, $uploaded_image);
    $query ="update tbl_post
         set
         cat ='$cat';
         title ='$title';
         body ='$body';
         image ='$image';
         author ='$author';
         tag ='$tag'
         where id='$editid'";

    $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Field Updated Successfully.
     </span>";
    }else {
     echo "<span class='error'>Field Not Updated !</span>";
    }
    }

   }else{
          move_uploaded_file($file_temp, $uploaded_image);
    $query ="update tbl_post
         set
         cat ='$cat';
         title ='$title';
         body ='$body';
         author ='$author';
         tag ='$tag'
         where id='$editid'";

    $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Field Updated Successfully.
     </span>";
    }else {
     echo "<span class='error'>Field Not Updated !</span>";
    }
    }
   }
}

 ?> 

 <?php 
    $query ="select * from tbl_post where id='$editid' order by id desc";
    $editp = $db->select($query);
    if ($editp) {
        while ($editresult = $editp->fetch_assoc()) {
                   
    
 ?>                <form action="editpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $editresult['title']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                  <option>Select Category</option>>
             <?php
       $query = "select * from tbl_category";
       $cat = $db->select($query);
          if ($cat) {
               while ($result =$cat->fetch_assoc() ) {

        ?>
                                    <option 

                                       <?php 
                                             if ($editresult['cat'] == $result['id']) { ?>
                                                  selected="selected"
                                            <?php }
                                       ?>

                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?>
                                </option>
      <?php } }?>                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $editresult['image']; ?>" width="100px" height="100px"/><br/>
                                <input name="image" type="file" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $editresult['author']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tag" value="<?php echo $editresult['tag']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                       <?php echo $editresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

              <?php } } ?>      
                </div>
            </div>
        </div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php";?>
