<?php
require_once('../class/utilsFunctions.php');
require_once('../class/Books.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHPCalibre</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="D.Ducatel">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			.noUnderline{text-decoration: none !important;}
		</style>
		<script>
			$(function() {
				$('.showTootlips').tooltip();
			});
		</script>
	</head>
	<body>
		<div class="container-fluid">
			<header class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1>PHPCalibre</h1>
					</div>
				</div>
			</header>
<?php
if(isset($_GET['errMsg']) && !empty($_GET['errMsg']))
	echo '<div class="row"><aside class="col-md-offset-3 col-md-8">'.generateAlertBox($_GET['errMsg'], true).'</aside></div>';
if(isset($_GET['successMsg']) && !empty($_GET['successMsg']))
	echo '<div class="row"><aside class="col-md-offset-3 col-md-8">'.generateAlertBox($_GET['successMsg'], false).'</aside></div>';
?>
			<div class="row">
				<nav class="col-md-2">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Filtre :</h3>
						</div>
						<div class="list-group">
							<a href="#" class="list-group-item">Authors</a>
							<a href="#" class="list-group-item">Tags</a>
						</div>
					</div>
				</nav>
				<section class="col-md-10">
<?php
$databasePath = 'C:/wamp/www/Calibre/metadata.db';

$books = new Books();
$books->loadFromDatabase($databasePath);
foreach ($books as $book) {
?>


<div class="col-md-4">
	<div class="well well-sm">
		<div class="row">
			<div class="col-xs-3 col-md-3 text-center">
				<a class="showTootlips" href="" target="_blank" title="Show all descriptions" data-toggle="tooltip" data-placement="bottom" >
<?php
$cover = $book->getCover();
if(empty( $cover ) )
	echo '<img src="" alt="Book cover " class="img-responsive" />';
else
	echo '<img src="showLocalImg.php?imgPath='.urlencode($cover).'" alt="Book cover " class="img-responsive" />';
?>

				</a>
			</div>
			<div class="col-xs-9 col-md-9 section-box">
			<h3>
<?php 
$bookTitle = trim($book->getName());
echo "<span title='$bookTitle' class='showTootlips' data-toggle='tooltip' data-placement='top'>";
$titleSize = strlen($bookTitle);
if($titleSize <= 23)
	echo $bookTitle." ";
else
	echo substr($bookTitle, 0, 20)."... ";
echo "</span>";

if(count($book->getFiles()) > 0 ){
	$fileLink = urlencode($book->getPath()."/".$book->getFiles()[0]->getName().".".$book->getFiles()[0]->getFormat());
	echo '<a class="showTootlips noUnderline" href="downloadFile.php?file='.$fileLink.'" target="_blank" title="Download" data-toggle="tooltip" data-placement="top" >';
	echo '<span class="glyphicon glyphicon-cloud-download" ></span></a>&nbsp;';
	echo '<a class="showTootlips noUnderline" href="'.$fileLink.'" target="_blank" title="Read" data-toggle="tooltip" data-placement="top">';
	echo '<span class="fa fa-book"></span></a>';
}
?>
					
				</h3>
				<p class="visible-md visible-lg clearfix">
<?php
$comment = trim(strip_tags($book->getComment(),'<br/>'));
if(strlen($comment) == 0)
	echo "No comment avaiable";
else
	echo substr($comment, 0 , 150 ) . "...";
?>
				</p>
				<hr />
				<div class="row rating-desc visible-md visible-lg">
<?php
echo "<div class='col-md-4 showTootlips' title='".$book->getRating()."/10' data-toggle='tooltip' data-placement='top'>";
echo generateRatingView($book->getRating());
echo '</div>';
?>

					
					<div class="col-md-offset-4 col-md-4">
						<span class="fa fa-language"></span> <?php echo $book->getLanguage(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
}
?>
					
				</section>
			</div>
			<!-- Pagination
			<div class="row">
						<div class="col-md-12">
									<ul class="pagination">
												<li class="previous"><a href="#"><span class="glyphicon glyphicon-backward"></span> Précédent</a></li>
												<li class="active"><a href="#">1</a></li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
												<li class="next"><a href="#">Suivant <span class="glyphicon glyphicon-forward"></span></a></li>
									</ul>
						</div>
			</div> -->
			<footer class="row">
				Pied de page
			</footer>
		</div>
	</body>
</html>