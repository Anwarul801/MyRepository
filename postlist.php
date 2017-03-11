<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">Serial No</th>
							<th width="15%">Post Title</th>
							<th width="20%">Body</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Dates</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
<?php 
   $query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category
            ON tbl_post.cat = tbl_category.id order by tbl_post.title desc";
             $post=$db->select($query);
             if ($post) {
             	$i=0;
               while ($result = $post->fetch_assoc()) {
               $i++;  
?>

						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['title'];?></td>
							<td><?php echo $fm->readmore($result['body'],100);?></td>
                            <td><?php echo $result['name'];?></td>
                            <td><img src="upload/<?php echo $result['image'];?>" width=40px heiht=40px alt="post image" /></td>
							<td><?php echo $result['author'];?></td>
							<td><?php echo $result['tag'];?></td>
							<td><?php echo $fm->formateDate($result['date']);?></td>
							<td><a href="editpost.php?editid=<?php echo $result['id'];?>">Edit</a> 
								|| <a href="delpost.php?delpost=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
	<?php } }?>					
					</tbody>
				</table>

               </div>
            </div>
        </div>
        <script type="text/javascript">

            $(document).ready(function () {
                setupLeftMenu();

                $('.datatable').dataTable();
          setSidebarHeight();


            });
        </script>
        <?php include "inc/footer.php";?>
