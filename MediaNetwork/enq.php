<?php
	header('Content-Type: text/html; charset=UTF-8');
	//入力データの書き込み
	if(strlen($_POST["name"]) != 0) {
		//入力された情報を変数に代入
		$name = $_POST["name"];
		$gender = $_POST["gender"];
		$article = implode("、", $_POST["article"]);

		//ファイルへの書き込み
		$fp = fopen("./result.csv", "a+");
		flock($fp, LOCK_EX); //書き込みのロック
		$output = join(",", array($name, $gender, $article))."\n"; //出力データの生成
		fputs($fp, $output);
		flock($fp, LOCK_UN);
		fclose($fp);

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>アンケート受付完了 - SpaceCat</title>
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
							<?php if(strlen($_POST["name"]) != 0): ?>
								<h3>回答ありがとうございました</h3>
								回答内容は以下の通りです.
								
								<p>
									氏名:		<?php echo $name?><br>
									性別:		<?php echo $gender?><br>
									記事:		<?php echo $article?>
								</p>

								<p>
									<a href="./result.php" target="_self">アンケート集計結果を見る</a><br>
									<a href="./enq.html" target="_self">フォームに戻る</a>
								</p>

							<?php else: ?>
								<p>アンケート入力が不備なようです。<br>アンケート入力画面に戻って再入力をお願いします。</p>

							<?php endif; ?>
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