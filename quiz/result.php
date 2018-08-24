<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="UTF-8">

	<title>Quiz Result</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.js"></script>
	<script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

	<div id="page-wrap">
		<?php 
			$correctNum = 0;
			$soccer = 0;
			$basketball = 0;
			$baseball = 0;
			$noa = 0;
			$reactionImage = '';

			$response = array($_POST['q1Answer'], 
							$_POST['q2Answer'],
							$_POST['q3Answer'],
							$_POST['q4Answer'],
							$_POST['q5Answer'],
							$_POST['q6Answer'],
							$_POST['q7Answer'],
							$_POST['q8Answer'],
							$_POST['q9Answer'],
							$_POST['q10Answer']);

			$answers = ["A", "A", "A", "A", "A", "A", "B", "A", "C", "D"];

			for($i = 0; $i < 10; $i++){;
				if ($response[$i] == $answers[$i]){
					$correctNum++;
				}
				if ($response[$i] == "A"){ 
					$soccer++;
				} elseif($response[$i] == "B"){
					$basketball++;
				} elseif($response[$i] == "C"){
					$baseball++;
				}else{
					$noa++;
				}
			}

			if($correctNum > 5){
				$reactionImage = 'image/happy.jpg';
			}else{
				$reactionImage = 'image/sad.jpg';
			}

		    $arr = array( 
		        array(
		            label => "Soccer",
		            data => $soccer
		        ),
		        array(
		            label => "Basketball",
		            data => $basketball
		        ),
		        array(
		            label => "Baseball",
		            data => $baseball
		        ),
		        array(
		            label => "None of the Above1",
		            data => $noa
		        )
		    );
			// Use Smarty to extract each variable to html if exterial libraries are allowed
			echo 
			"<div class='page-wrap'>
				<div class=header>
					<h1>How well do you know sports</h1>
				</div >
				<div class='container wrapper'>
					<div class=outcome>
						<h2>Results are as follows</h2>
					</div>
					<div class=outcome-image>
						<img src=$reactionImage alt=Reaction to the result>
					</div>
					<div class=outcome>
						<h3>You have answered $correctNum out of 10 questions correctly </h3>
						
					</div>
					<div id=piechart class=flot></div>
				</div>
			</div>";
		 ?>

		 <script type="text/javascript">
			 	var options = {
	        series: {
	            pie: {
	                show: true,
	                radius: 1,
	                label: {
	                    show: true,
	                    radius: 0.8,
	                    threshold: 0.1
	                    //formatter: "labelFormatter"
	                }
	            }
	        },
	        grid: {
	            hoverable: true
	        },
	        tooltip: true,
	        tooltipOpts: {
	            cssClass: "flotTip",
	            content: "%p.0%, %s",
	            shifts: {
	                x: 20,
	                y: 0
	            },
	            defaultTheme: false
	        }
	    	};
    
    		var data = <?php echo json_encode($arr); ?>;
    		$.plot($("#piechart"),data,options);
		 </script>
</body>
</html>
