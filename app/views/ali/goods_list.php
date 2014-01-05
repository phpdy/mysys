<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>批发商列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>商品列表</h2></div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>批发商</td>
                <td>商品名</td>
                <td>介绍</td>
            </tr>
		<?php
		$i = 0;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$id = $item['id'] ;
			$whoname = $item['whoname'] ;
			$name = $item['name'] ;
			$info = $item['info'] ;
			$i++;
			echo "<tr class='$class'><td>{$i}</td>".
			"<td>$whoname</td>".
			"<td><a href='?dir=ali&control=goods&action=up&id=$id'>$name</a></td>".
			"<td>$info</td></tr>" ;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>