<?php
	header('Content-Type: text/html; charset=UTF-8');
	if(isset($_COOKIE["name"])) {
		$name = $_COOKIE["name"];
	} else {
		echo '<script type="text/javascript">window.alert("閲覧が許可されていません.ログインしてください.");location.href="login.html";</script>';
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>掲示板 - SpaceCat</title>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="./stylesheet.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Raleway:210,400" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="bootstrap/js/bootstrap.min.js"></script>
	    <script src="script.js"></script>

	    <div class="header">
		    <div class="titletext">
			    <div class="p-title">SpaceCat</div>
			    <div class="p-subtitle">趣味の垂れ流し</div>
		    </div>
	    </div>

	    <div class="container-fluid menu">
		    <div class="row">
			    <div class="col-md-3 col-sm-3 bg-info text-center"><a href="./index.html">Home</a></div>
			    <div class="col-md-3 col-sm-3 bg-success text-center"><a href="./login.html">BBS</a></div>
			    <div class="col-md-3 col-sm-3 bg-warning text-center"><a href="./enq.html">Enquete</a></div>
			    <div class="col-md-3 col-sm-3 bg-danger text-center"><a href="./link.html">Link</a></div>
		    </div>
	    </div>

		<div class="main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<br>
						<div class="form-wrapper">
							<h3>投稿フォーム</h3><br>
							<div class="container-fluid">
								<form method="POST" action="./post.php">
									<div class="row">
										<div class="col-md-4"></div>
										<div class="col-md-4 form-group">
											<label>名前</label>
											<input type="text" name="name" class="form-control"><br>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<label>投稿内容</label>
											<textarea name="content" rows="4" cols="40" class="form-control"></textarea><br>
										</div>
										<div class="col-md-3"></div>
									</div>
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<label>動画URL(YouTube) *任意</label>
											<input type="text" name="url" class="form-control">
										</div>
										<div class="col-md-3"></div>
									</div>
									<br>
									<button type="submit" class="btn btn-primary">投稿</button>
								</form>
							</div>
						</div>

						<br>

						<div class="bbs">
							<?php

								if(is_file("./log.csv")) {
									if(is_readable("./log.csv")) {
										//ログファイルを開く
										$fp = fopen("./log.csv","r");
										flock($fp, LOCK_SH);
										$contents = array();

										//ログファイルの中身を出力
										while($line = fgets($fp)) {
											$content = explode(",", $line);
											array_push($contents,$content);
										}

										//$count = 0;
										$count = count($contents)+1;

										for($i=count($contents)-1;$i>=0;$i--) {
											//エラー防止用
											if(count($content)==4) {
												$count--;
												$content = $contents[$i];
												echo "<div class='bbs-post'>".$count;
												echo "　<strong>名前: $content[0]</strong>";
												echo "　投稿日時: <time>$content[1]</time><br>$content[2]";
												if(preg_match("/youtube/", $content[3])) {
													preg_match("/v=(\w+)/", $content[3], $videoID);
													echo "<br><iframe width='560' height='315' src='https://www.youtube.com/embed/".$videoID[1]."' frameborder='0' allowfullscreen></iframe><hr width='95%'></div>";
												} else {
													echo "<hr width='95%'></div>";
												}
											}
										}

										//ログファイルを閉じる
										flock($fp, LOCK_UN);
										fclose($fp);
									}
									else
										echo "<div class='bbs-post'>ファイルが開けません</div>";
								}
								else
									echo "<div class='bbs-post'>誰も投稿していません</div>";
							?>
						</div>
						<br>
					</div>
					<div class="col-md-2"><p id="pageTop"><a href="#"><i class="fa fa-chevron-up"></i></a></p></div>
				</div>
			</div>
	    </div>

	    <div class="footer titletext">
		    <ul>
		    	<li class="p-title">SpaceCat</li>
				<li>Copyright&copy; 2017 s.nagata All Rights Reserved.</li>
		    </ul>
		</div>
	</body>
</html>
