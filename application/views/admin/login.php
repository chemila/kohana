<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新浪乐居热点管理系统_新浪网</title>
<?php echo HTML::style('media/style/admincp.css')?> 
</head>
<body>
    <div id="append"></div>

    <div class="container">
        <?php echo Form::open('admin/authenticate', array('id' => 'loginform'))?> 
            <?php echo View::factory('error')->render(); ?> 

            <table class="mainbox">
                <tr>
                    <td class="loginbox">
                        <h1>新浪乐居热词管理系统</h1>
                        <p>新浪乐居热点大全管理系统是新浪房产技术部开发，请使用新浪乐居邮箱在右侧进行登录.</p>
                    </td>
                    <td class="login">
                        <p id="usernamediv">用户名:<input type="text" name="username" class="txt" tabindex="1" id="username" value="" /></p>
                        <p>密　码:<input type="password" name="password" class="txt" tabindex="2" id="password" value="" /></p>
                        <p class="loginbtn">
                            <input type="submit" name="submit" value="登 录" class="btn" tabindex="3" />
                            <label>Remember
                                <input type="checkbox" name="remember"/>
                            </label>
                        </p>
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>

    <div class="footer">
        Powered by house.sina.com.cn &copy; 2001 - 2010 
        <a href="http://house.sina.com.cn/" target="_blank">新浪乐居</a> Inc. <br /> 
        技术反馈：<a href="mailto:fuqiang@leju.sina.com.cn?subject=[yule]">付强</a> 
    </div>
</body>
</html>
