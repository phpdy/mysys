<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
</head>
<body>

<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>批发商修改</h2></div>
        <form method="post" action="?dir=ali&control=who&action=submit">
            <input type="hidden" value="<?php echo $who['id']; ?>" name="id">
            <div id="gamemain">
                <table>
                    <tbody>
                    <tr><td class="title"><b>批发商名:</b></td><td><input type="text" name="name" value="<?php echo $who['name']; ?>" size=40></td></tr>
                    <tr><td class="title"><b>批发商介绍:</b></td><td><input type="text" name="info" value="<?php echo $who['info']; ?>" size=80></td></tr>
                    <tr><td class="title"><b>批发商链接:</b></td><td><input type="text" name="url" value="<?php echo $who['url']; ?>" size=80></td></tr>
                    <tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>