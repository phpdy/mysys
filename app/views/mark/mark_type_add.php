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
        <div id="gamefeatures"><h2>模版类别<?php if (empty($marktype['id'])){echo "添加";} else {echo "修改";}?></h2></div>
        <form method="get" action="">
            <input type="hidden" value="mark" name="dir">
            <input type="hidden" value="model_type" name="control">
            <input type="hidden" value="add_sub" name="action">
            <input type="hidden" value="<?php echo $marktype['id']; ?>" name="id">
            <div id="gamemain">
                <table>
                    <tbody>
                    <tr><td class="title"><b>模版类别名:</b></td><td><input type="text" name="name" value="<?php echo $marktype['name']; ?>"></td></tr>
                    <tr><td class="title"><b>说明:</b></td><td><input type="text" name="info" value="<?php echo $marktype['info']; ?>"></td></tr>
                    <tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>