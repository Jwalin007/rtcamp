<?php
session_start();
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Placement Website</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> 
    <style>
        body {
            position: relative;
        }
        
        #aboutus {
            padding-top: 50px;
            height: 500px;
            color: #fff;
            background-color: #1E88E5;
            border-radius: 30px;
        }
        
        #team {
            padding-top: 50px;
            height: 500px;
            color: #fff;
            background-color: #673ab7;
            border-radius: 30px;
        }
        
        #contactus {
            padding-top: 50px;
            height: 500px;
            color: #fff;
            background-color: #ff9800;
            border-radius: 30px;
        }
        
        #cname {
            color: white;
            transition: 1s;
        }
        
        #cname:hover {
            color: yellow;
            transition: 1s;
        }
    </style>
	</head>
	<body>
	
		<?php if (isset($_SESSION['logged'])): ?>      <!--  After user login -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
					  <a class="navbar-brand navbar-right" href="index.php">HOME</a>
					</div>
					<div class="navbar-right"><h3 style="color:#ffffff;">Hello, <?php echo $_SESSION['FULLNAME']; ?></h3><img src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture">
						<div class="float-left"><a href="logout.php">Logout</a></div>
					</div>
				</div>
				  <!--/.navbar-collapse -->
			</nav>
			<br><br><br><br><br><br><br>
			<div class="container">
			<h3>Welcome to Pic<mark>BOOK</mark> services</h3>
			<?php
				require_once __DIR__ . '/src/Facebook/autoload.php';

				$fb = new Facebook\Facebook([
				  'app_id' => '832614510246150',
				  'app_secret' => '39cebcb5e281888a77de8254e7df0752',
				  'default_graph_version' => 'v2.10',
				  ]);
				foreach ($_SESSION['photos'] as $key) 
				{
					$photo_request = $fb->get('/'.$key['id'].'?fields=images');
					$photo = $photo_request->getGraphNode()->asArray();
					echo '<img src="'.$photo['images'][2]['source'].'"><br>';
				}
			?>
			</div>
		<?php else: ?>     <!-- Before login --> 
			<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div id="cname">
					<a class="navbar-brand" href="#">JTsolutions</a>
				</div>
				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="nav navbar-nav mr-auto">
					  <li class="nav-item">
						<a class="nav-link" href="#">Home</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#aboutus">About Us</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#team">Team</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#contactus">Contact Us</a>
					  </li>
					</ul>
					<div class="navbar-right center-block">
					  <button class="btn btn-success my-2 my-sm-0" onclick="window.location.href = 'fbconfig.php'">Sign in to Start</button>
				</div>
		</nav>

			<br><br>

			<div class=" container">

				<h1 class="page-header ">PicBOOK <small>Facebook Album handler</small>
					<sup><font size=1><mark>Lite</mark></font></sup>
				</h1>
				<br>
				<div class="container">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
							<li data-target="#myCarousel" data-slide-to="3"></li>
							<li data-target="#myCarousel" data-slide-to="4"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">

							<div class="item  active">
								<img src="images/5.jpg" alt="LIFE" style="width:auto;">
								<div class="carousel-caption">
									<h3>LIFE</h3>
									<p>Moments are memories and yours are valuable to us!</p>
								</div>
							</div>

							<div class="item">
								<img src="images/1.jpg" alt="Los Angeles" style="width:auto;">
								<div class="carousel-caption">
									<h3>Powered by Facebook</h3>
									<p>Fickle is fun!</p>
								</div>
							</div>

							<div class="item">
								<img src="images/2.jpg" alt="Chicago" style="width:auto;">
								<div class="carousel-caption">
									<h3>Chicago</h3>
									<p>New Year!! A good camera shines</p>
								</div>
							</div>

							<div class="item">
								<img src="images/3.jpg" alt="Sydney" style="width:auto;">
								<div class="carousel-caption">
									<h3>Sydney</h3>
									<p>We love such beautiful pics!</p>
								</div>
							</div>

							<div class="item">
								<img src="images/4.jpg" alt="Arab Emirates" style="width:auto;">
								<div class="carousel-caption">
									<h3>Arab Emirates</h3>
									<p>Panoramas are serene</p>
								</div>
							</div>

						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarousel" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>

				<br>
				<hr>

				<blockquote class="blockquote">
					<p><b>@</b><mark>PicBook</mark>, we make accessibility, a priority. User's at ease are what we please.</p>
					<footer>Quote by <cite title="Jwalin Thaker">Jwalin Thaker</cite></footer>
				</blockquote>

				<hr>

				<blockquote class="blockquote-reverse">
					<p><mark>Best website</mark> to tweak facebook albums, and have one-click download :) <b>#picbook</b></p>
					<footer>Quote by <cite title="Utkarsh Desai">Utkarsh Desai</cite></footer>
				</blockquote>

				<hr>

				<div id="aboutus" class="container">
					<h1><span class="label label-primary">About</span> Us</h1>
					<br><br>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
				</div>

				<hr>
	
				<div id="team" class="container">
					<h1><span class="label label-primary">Team</span> Today</h1>
					<br><br>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
				</div>

				<hr>

				<div id="contactus"  class="container">
					<h1><span class="label label-primary">Contact</span> Us</h1>
					<br><br>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
				</div>

				<br>
				<!-- FOOTER -->
				<div class="well well-sm">
					<footer>
						<p class="pull-right"><a href="#">Back to top</a></p>
						<p>&copy; 2017 JT solutions, Ltd. &middot; <a href="privacy.html">Privacy and Terms</a> &middot; </p>
					</footer>
				</div>

			</div>

			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js "></script>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="js/popper.min.js"></script>
			<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="js/respond.min.js"></script>
	<?php endif ?>
  </body>
</html>
