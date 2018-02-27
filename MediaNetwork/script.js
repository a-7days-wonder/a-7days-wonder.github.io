$(function(){
	var topBtn=$('#pageTop');
	topBtn.hide();

	$(window).scroll(function(){
		if($(this).scrollTop()<=80) {
		    topBtn.fadeOut();
	 	} else if($(this).scrollTop()>=$(document).height()-$(window).height()-100) {
	 		topBtn.css('margin-bottom',($(this).scrollTop()+$(window).height()-$(document).height()+125)+'px');
	 	} else {
		    topBtn.fadeIn();
		    topBtn.css('margin-bottom','');
	  	} 
	});

	topBtn.click(function(){
		$('body,html').animate({
		scrollTop: 0},500);
		return false;
	});

	// ユーザエージェントの判別
	var _ua = (function(u) {
		return {
			Tablet:u.indexOf("ipad") != -1 || (u.indexOf("android") != -1 && u.indexOf("mobile") == -1) || (u.indexOf("firefox") != -1 && u.indexOf("tablet") != -1) || u.indexOf("kindle") != -1 || u.indexOf("silk") != -1 || u.indexOf("playbook") != -1,
			Mobile:(u.indexOf("windows") != -1 && u.indexOf("phone") != -1) || u.indexOf("iphone") != -1 || u.indexOf("ipod") != -1 || (u.indexOf("android") != -1 && u.indexOf("mobile") != -1) || (u.indexOf("firefox") != -1 && u.indexOf("mobile") != -1) || u.indexOf("blackberry") != -1,
			IE:u.indexOf('msie') != -1 || u.indexOf('trident') != -1
		}
	})(window.navigator.userAgent.toLowerCase());
	var _ap = (function(ap) {
		return {
			OldIE:
			ap.indexOf("msie 6.") !=  -1 || 
			ap.indexOf("msie 7.") !=  -1 || 
			ap.indexOf("msie 8.") !=  -1 || 
			ap.indexOf("msie 9.") !=  -1
		}
	})(window.navigator.appVersion.toLowerCase());
	if(_ua.Mobile) { //Mobile
		var ua_num = 3;
	} else if(_ua.Tablet) { //Tablet
		var ua_num = 2;
	} else if(_ua.IE && _ap.OldIE) { //OLD IE
		var ua_num = 1;
	} else {
		var ua_num = 0;
	}

	if(ua_num == 3) {
		topBtn.css('right','10px');
		$('#pageTop a').css({'width':'50px','height':'50px','padding':'10px 0 0 0'});
	};

	// クッキーの保存
	$('#backtobbs').click(function(){
		// 3秒
		var date = new Date();
		date.setTime( date.getTime() + ( 3 * 1000 ));
		$.cookie("name", "from_post.php",{expires: date});
	});
});