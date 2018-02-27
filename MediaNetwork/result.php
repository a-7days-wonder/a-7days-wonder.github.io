<?php
	header('Content-Type: text/html; charset=UTF-8');
	//ファイルの読み込み（ファイルの確認も兼務）
	if(is_readable("./result.csv") && $fp=fopen("./result.csv", "r")) {
		flock($fp, LOCK_SH);

		//集計用変数の初期化
		$cnt["凛として時雨"] = 0;
		$cnt["米津玄師"] = 0;
		$cnt["ヒトリエ"] = 0;
		$cnt["ぼくのりりっくのぼうよみ"] = 0;
		$cnt["雨のパレード"] = 0;
		$cnt["Perfume"] = 0;

		while($csvline=fgets($fp)) {
			$data = explode(",", trim($csvline, "\n"));
			//print(count($data));
			if(count($data)==3) {
				$article = explode("、", $data[2]);

				for ($i=0; $i < count($article); $i++) {
					$name = $article[$i];
					if(isset($cnt[$name]))
						$cnt[$name]++; //変数の加算
				}
			}
		}

		flock($fp, LOCK_UN);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>アンケート結果 - SpaceCat</title>
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
							<?php if(is_readable("./result.csv")): //ファイルが読み込み可能か判断 ?>
								<h3>人気記事ランキング</h3>
								現時点での投票結果は以下の通りです<br><br>
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-4">
											<strong>記事名</strong></strong><br><br>
											<a href="./atricle01.html">凛として時雨</a><br>
											<a href="./atricle02.html">米津玄師</a><br>
											<a href="./atricle03.html">ヒトリエ</a><br>
											<a href="./atricle04.html">ぼくのりりっくのぼうよみ</a><br>
											<a href="./atricle05.html">雨のパレード</a><br>
											<a href="./atricle06.html">Perfume</a>
										</div>
										<div class="col-md-4">
											<strong>得票数</strong><br><br>
											<?php echo $cnt["凛として時雨"] ?><br>
											<?php echo $cnt["米津玄師"] ?><br>
											<?php echo $cnt["ヒトリエ"] ?><br>
											<?php echo $cnt["ぼくのりりっくのぼうよみ"] ?><br>
											<?php echo $cnt["雨のパレード"] ?><br>
											<?php echo $cnt["Perfume"] ?>
										</div>
										<div class="col-md-2"></div>
									</div>
									<br>
								</div>
								
								<p>
									<a href="./enq.html" target="_self">フォームに戻る</a>
								</p>
							<?php else :?>
								<p>csvファイルがありません.前回講義の実習が完了しているか確認してください.</p>
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