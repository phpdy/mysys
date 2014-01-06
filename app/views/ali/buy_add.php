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
        <div id="gamefeatures"><h2>进货添加</h2></div>
        <form method="post" action="">
            <input type="hidden" value="ali" name="dir">
            <input type="hidden" value="buy" name="control">
            <input type="hidden" value="add" name="action">
            <div id="gamemain">
                <table>
                    <tbody>
                    <tr><td class="title"><b>商品:</b></td>
                    <td><select name="whoid">
						<?php 
						foreach ($goodslist as $item){
							echo "<option value='$item[id]'>".$item['whoname']."-".$item['name'] ;
						}
						?>
                    </select></td></tr>
                    <tr><td class="title"><b>进货说明:</b></td><td><input type="text" name="name" size=40></td></tr>
                    <tr><td class="title"><b>详情:</b></td><td><input type="text" name="info" size=80></td></tr>
                    <tr><td class="title"><b>单价:</b></td><td><input type="text" name="price" size=40></td></tr>
                    <tr><td class="title"><b>数量:</b></td><td><input type="text" name="num" size=40></td></tr>
                    <tr><td class="title"><b>运费:</b></td><td><input type="text" name="fare" size=40></td></tr>
                    <tr><td class="title"><b>日期:</b></td><td><input type="text" name="date" size=40></td></tr>
                    <tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>