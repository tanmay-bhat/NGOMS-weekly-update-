<?php
	session_start();
	include("./includes/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="images/logo_icon.png" />
	<title>Donation - Charis</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/style_form.css">
	<script src="./js/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#donor_state").change(function(){
				var state = $("#donor_state").val();
				$("#donor_city").load("getCity.php?state="+state);
			});
		});
	</script>
	<style type="text/css">
	body{
		background-image: url('./Pictures/background.jpg');
		background-repeat: repeat;
		opacity:0.90;
	}
	.topnav{
	  border-bottom: 1px solid seashell;
	  display: flex;
	}
	#titl{
		padding-right: 900px;

		color: #1B5E20;
		text-decoration: yellow overline;
		font-size: 70px;
		font-family: Tahoma;
	}
	</style>
</head>
<body style="margin-left:30px">
	<div id="header">
		<div>
			<div class="topnav">
			<a href="index.php"   id="logo"><img  height="110px" width="140px" src="./Pictures/logo.png" alt="logo" style="padding-top:15px;"></a>
			<h1 id="titl">CHARIS</h1>
		</div>
		<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="gallery.php">gallery</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="event.php">Events</a></li>
				<li class="current"><a>Donate</a></li>
				<?php
					if(isset($_SESSION["user_id"])){
				?>
					<li><a href="profile.php">profile</a></li>
					<li class="log_btn"><a href="logout.php">Logout</a></li>
				<?php
					}
					else{
				?>
					<li class="log_btn"><a href="login.php">Login</a></li>
				<?php
					}
				?>
			</ul>
		</div>
	</div>
	<div id="body">
		<div class="donation_div">
			<h3><?php echo $_GET["donate"]; ?> Donation</h3><hr>
			<form action="./insert_donation.php" method="post" class="user">
				<input type="hidden" name="cat" value="<?php echo $_GET['cat'];?>">
				<label>Name</label>
				<input type="text" name="donor_name">
				<label>Email</label>
				<input type="email" name="donor_email">
						<label>Address</label>
				<textarea name="donor_address" rows="3">
				</textarea>
				<label>State</label>
				<select id="donor_state" name="donor_state">
					<option value="">Select State</option>
					<?php
						$sql = "SELECT * FROM state";
						$result = mysqli_query($con,$sql);
						while($rs = mysqli_fetch_array($result)){
							?>
							<option value="<?php echo $rs["state_id"]; ?>"><?php echo $rs["state_name"]; ?></option>
							<?php
						}
					?>
				</select>
				<label>City</label>
				<select id="donor_city" name="donor_city">
					<option value="">Select State First</option>
				</select>
				<label>Items</label>
				<input type="number" name="items" required>
				<label>description</label>
				<textarea name="donor_description" rows="5" required>
				</textarea>
				<label>How we collect your donation? </label>
				<div class="pickup">
					<span><input type="radio" name="pickup" value="M" checked>
					<label>I'll come to the organization</label><br></span>
					<span><input type="radio" name="pickup" value="A">
					<label>Pickup it from my address</label></span>
				</div>
				<input type="submit" value="Donate">
			</form>
		</div>
	</div>
	<?php	include("./includes/footer.html");	?>
</body>
</html>
