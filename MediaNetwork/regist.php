<?php
	header('Content-Type: text/html; charset=UTF-8');
	$id = htmlspecialchars($_POST["id"]);
	$pw = htmlspecialchars($_POST["pw"]);
	$filename = "./list.csv";

	//空白のチェック
	if(strcmp($id, "")==0 || strcmp($pw, "")==0) {
		echo '<script type="text/javascript">window.alert("エラー: IDまたはPWが空白です.");location.href="regist.html";</script>';
		exit;
	}

	if(!file_exists($filename))
		touch($filename);
	$fp = fopen($filename, "r+");
	flock($fp, LOCK_EX);
	$flag = false;
	while($line = fgetcsv($fp))
		if(strcmp($line[0], $id)==0)
		{
			$flag = true;
			break;
		}

	if($flag) {
		echo '<script type="text/javascript">window.alert("既に登録されているIDです.");location.href="regist.html";</script>';
		exit;
	}
	else
		fputcsv($fp, Array($id,hash("sha256",$pw)));

	flock($fp, LOCK_UN);
	fclose($fp);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録完了 - SpaceCat</title>
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
            <div class="login-wrapper">
              <h3>登録が完了しました</h3><br>
              登録された情報は以下の通りです<br><br>
              <div class="container-fluid">
                 <div class="row">
                   <div class="col-md-3"></div>
                   <div class="col-md-3">
                       ユーザ名: 
                   </div>
                   <div class="col-md-3">
                   		<?php echo $id ?>
                   </div>
                   <div class="col-md-3"></div>
                 </div>
              </div>
              <br>
              <div class="container-fluid">
                 <div class="row">
                   <div class="col-md-3"></div>
                   <div class="col-md-3">
                       パスワード: 
                   </div>
                   <div class="col-md-3">
                   		<?php echo $pw ?>
                   </div>
                   <div class="col-md-3"></div>
                 </div>
              </div>
              <br>
              ログインページは<a href="./login.html">こちら</a>
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