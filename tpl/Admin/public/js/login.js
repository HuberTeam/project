var login = {
    check : function() {
        // Acquire username and password
		var $username = $('input[name="username"]');
		var $password = $('input[name="password"]'); 
		var _username = $.trim($username.val());
		var _password = $.trim($password.val());
		var $text = $(".text");

        if(!_username) {
			$text.text('请输入用户名');
			$username.focus();
			return;
        }
        if(!_password) {
            $text.text('请输入密码');
			$password.focus();
			return;
        }

        var url = "/admin.php?c=login&a=check";
        var data = {'username':_username,'password':_password};
		
        // AJAX
        $.post(url,data,function(result){
            if(result.status == 0) {
				$text.text(result.message);
				return;
            }
            if(result.status == 1) {
				$text.text(result.message);
				window.setTimeout("window.location.href='/admin.php?c=index'",0.5*1000); 
            }
        },'JSON');

    }
}