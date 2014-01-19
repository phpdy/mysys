<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="js/Calendar3.js" ></script>
</head>
<body>

<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>销售添加</h2></div>
        <form method="post" action="?dir=ali&control=sale&action=submit">
            <div id="gamemain">
                <table>
                    <tbody>
                    <tr><td class="title"><b>商品:</b></td>
                    <td><select name="goodsid">
						<?php 
						foreach ($goodslist as $item){
							echo "<option value='$item[id]'>".$item['name'] ;
						}
						?>
                    </select></td></tr>
                    <tr><td class="title"><b>买家:</b></td><td><input type="text" name="buyer" size=40></td></tr>
                    <tr><td class="title"><b>旺旺:</b></td><td><input type="text" name="buyer_ww" size=80></td></tr>
                    <tr><td class="title"><b>付款:</b></td><td><input type="text" name="price" size=40></td></tr>
                    <tr><td class="title"><b>数量:</b></td><td><input type="text" name="num" size=40></td></tr>
                    <tr><td class="title"><b>运费:</b></td><td><input type="text" name="fare" size=40></td></tr>
                    <tr><td class="title"><b>日期:</b></td><td><input type="text" name="date" size=40  onclick="new Calendar().show(this);"></td></tr>
                    <tr><td colspan="2"><input type="submit" value="提  交" name="sub" class="sub-btn"></td></tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>