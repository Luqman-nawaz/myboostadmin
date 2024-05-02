<?php

session_start();

  if($_SESSION['username'] && $_SESSION['userpass']){

    include_once 'vendor/includes/config.php';

    include_once 'vendor/includes/head.php';

    include_once 'vendor/includes/nav.php';

    

    

    $q = "SELECT *, users.`name` as `username`, coachings.`id` as `coachingid` FROM `coachings` INNER JOIN `users` ON users.`id` = coachings.`user_id` ORDER BY coachings.`id` DESC";

    $r = mysqli_query($con, $q);

    ?>

    <main class="pt-5 mx-lg-5">
		
	

    	<div class="container-fluid mt-5">
		
	    	<div class="card mb-4 wow fadeIn">

	        	<!--Card content-->

		        <div class="card-body d-sm-flex justify-content-center">

		          <h4 class="mb-2 mb-sm-0 pt-1">

		            Manage Coaching Orders (<?= mysqli_num_rows($r); ?>)

		          </h4>

		        </div>

	      </div>

		  	<?php if(isset($_GET['done'])){	?>
				<div class="alert alert-success" style="text-align: center;"> <?= $_GET['done']; ?> </div>
			<?php } ?>

		    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">

			  <thead>

			    <tr>

			      <th class="th-sm">Order By

			      </th>

			      <th class="th-sm">Boost Type

			      </th>

                  <th class="th-sm">In Game Role

			      </th>

			      <th class="th-sm">No of Reviews

			      </th>

			      <th class="th-sm">Priority Order

			      </th>

			      <th class="th-sm">Order Placed On

			      </th>

                  <th class="th-sm">View Details

			      </th>

			    </tr>

			  </thead>

			  <tbody>

			  	<?php while($re=mysqli_fetch_assoc($r)){ ?>

			    <tr>

			      <td><?php echo $re['username']; ?></td>

			      <td><?php echo $re['name']; ?></td>
                  
                  <td><?php echo $re['boost_type']; ?></td>

                  <td><?php echo $re['ingame_role']; ?></td>

                  <td><?php echo $re['priority_order']; ?></td>

			      <td><?php echo date("F jS, Y", strtotime($re['created_at'])); ?></td>

			      <td><a href="coaching-order-details.php?id=<?php echo $re['coachingid']; ?>"><button class="btn btn-info btn-sm">View Details</button></a></td>

			    </tr>

				<?php } ?>

			   </tbody>

			</table>

		</div>

	</main>



	<script type="text/javascript">

	$(document).ready(function () {

	$('#dtBasicExample').DataTable();

	$('.dataTables_length').addClass('bs-select');

	});

	</script>

	<script type="text/javascript" src="js/addons/datatables.min.js"></script>



    <?php include_once 'vendor/includes/footer.php'; ?>



</body>



</html>

<?php

}else{

  header("location:logout.php");

}

?>