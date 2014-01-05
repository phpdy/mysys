<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>模版列表</title>
<link rel="StyleSheet" href="manager/css/style.css" type="text/css" />
</head>
<body>
<div class="content">
    <div id="main" class="main">
        <div id="gamefeatures"><h2>模版列表</h2></div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>模版名称</td>
                <td>模版说明</td>
                <td>模版类别</td>
                <td>模版状态</td>
            </tr>
		<?php
		$i = 0; 
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$id = $item['id'] ;
			$name = $item['name'] ;
			$info = $item['info'] ;
			$type = $item['type'] ;
			$state= $item['state'] ;
			echo "<tr class='$class'><td>$id</td><td><a href='?dir=mark&action=up&id=$id'>$name</a></td>"
			."<td>$info</td><td>$type</td><td>$state</td></tr>" ;
		$i++;
		}
		?>
		</table>
	</div>
</div>
</body>
</html>