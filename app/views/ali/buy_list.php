<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
<script language="javascript" type="text/javascript" src="js/Calendar3.js" ></script>
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>进货列表</h2></div>
        <div id="gamemain">
        <form method="post" action="">
            <input type="hidden" value="ali" name="dir">
            <input type="hidden" value="buy" name="control">
            <input type="hidden" value="list" name="action">
       	商品：<select id="goodsid" name="goodsid">
     			<option value="">全部</option>
     			<?php 
     			foreach ($goodslist as $item){
     				
     				echo "<option value='$item[id]' >$item[whoname]-$item[name]</option>" ;
     			}
     			?>
			</select>
		时间:<input type="text" name="date" value="" size="10" maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"/>
       	<input type="submit" value="查询">
        </form>
        </div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>批发商</td>
                <td>商品名</td>
                <td>进货说明</td>
                <td>单价</td>
                <td>数量</td>
                <td>运费</td>
                <td>日期</td>
                <td>总额</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$id = $item['id'] ;
			$whoname 	= $item['whoname'] ;
			$goodsname 	= $item['goodsname'] ;
			$name 		= $item['name'] ;
			$info 		= $item['info'] ;
			$price 		= $item['price'] ;
			$num	 	= $item['num'] ;
			$fare	 	= $item['fare'] ;
			$date	 	= $item['date'] ;
			$sum = $price*$num +$fare ;
			$i++;
			echo "<tr class='$class'><td>{$i}</td>".
			"<td>$whoname</td>".
			"<td>$goodsname</td>".
			"<td><a href='?dir=ali&control=buy&action=up&id=$id'>$name</a></td>".
			"<td>$price</td>".
			"<td>$num</td>".
			"<td>$fare</td>".
			"<td>$date</td>".
			"<td>$sum</td></tr>" ;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>