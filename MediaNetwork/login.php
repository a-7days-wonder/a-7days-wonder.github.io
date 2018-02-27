<?php
	header('Content-Type: text/html; charset=UTF-8');
	//ID,パスワードの取得
	$id = htmlspecialchars($_POST["id"]);
	$pw = htmlspecialchars($_POST["pw"]);
	//ファイル名とリンク先のページの宣言
	$filename = "./list.csv";
	$dest = "./view.php";

	//空白のチェック
	if(strcmp($id, "")==0 || strcmp($pw, "")==0) {
		echo '<script type="text/javascript">window.alert("エラー: IDまたはPWが空白です.");location.href="login.html";</script>';
		exit;
	}

	//ファイルの存在確認
	if(!file_exists($filename)) {
		echo '<script type="text/javascript">window.alert("誰も登録していません");location.href="login.html";</script>';
		exit;
	}

	$fp = fopen($filename, "r+");
	flock($fp, LOCK_EX);

	$flag = false;

	//IDとパスワードのハッシュ値が
	//一致している行がある場合,flagにtrueを代入
	while($line = fgetcsv($fp))
		if(strcmp($line[0], $id) == 0 
			&& strcmp($line[1], hash("sha256",$pw)) == 0)
			{
				$flag = true;
				break;
			}

	flock($fp, LOCK_UN);
	fclose($fp);

	//IDとパスワードが一致した場合、会員制ページへ自動遷移
	if($flag)
		{
			setcookie("name", $id, time()+30);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $dest");
			exit;
		}
	else {
		echo '<script type="text/javascript">window.alert("IDまたはPWが違います");location.href="login.html";</script>';
		exit;
	}
?>