<?php
	//受け取った内容（名前・投稿内容）および投稿時間を変数に保存
	if(strlen($_POST["name"])!=0) {
		$name = htmlspecialchars($_POST["name"]);
	} else {
		$name = "no name";
	}
	date_default_timezone_set('Asia/Tokyo');
	$time = date("Y/m/j H:i:s"); //年/月/日　時:分:秒の形式で時間を取得
	$content = htmlspecialchars($_POST["content"]);
	$url = htmlspecialchars($_POST["url"]);

	//ログファイルを開く
	$fp = fopen("./log.csv", "a");
	flock($fp, LOCK_EX);

	$line = $name.",".$time.",".$content.",".$url."\n";
	fputs($fp, $line);

	//ログファイルを閉じる
	flock($fp, LOCK_UN);
	fclose($fp);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>投稿を受け付けました - SpaceCat</title>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="./stylesheet.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Raleway:210,400" rel="stylesheet">
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="bootstrap/js/bootstrap.min.js"></script>
	    <script src="script.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

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
		    			<div class="post-info">
							<h3>投稿内容</h3>
							<?php
								//ログファイルの中身を出力する
								echo "<p><b>名前: ".$name."</b>　投稿日時:<time>".$time."</time><br>".$content."</p>";
							?>
							<hr>
							<p>
								<a href="./view.php" target="_self" id="backtobbs">掲示板に戻る</a><br>
								<a href="./index.html" target="_self">トップに戻る</a>
							</p>
						</div>
						<br>
					</div>
					<div class="col-md-2"></div>
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