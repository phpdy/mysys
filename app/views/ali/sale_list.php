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
        <div id="gamefeatures"><h2>销售列表</h2></div>
        <div id="gamemain">
        <form method="post" action="?dir=ali&control=sale&action=list">
           	 批发商：<select name="whoid">
       		<option value="0" >全部
	       		<?php 
				foreach($wholist as $item){
					$id = $item['id'] ;
					$name = $item['name'] ;
					$p="" ;
					if($id==@$data['whoid']){
						$p="selected" ;
					}
					echo "<option value='$id' $p>$name" ;
				}
	       		?>
			</select>
       		商品：<select id="goodsid" name="goodsid">
     			<option value="">全部</option>
     			<?php 
     			foreach ($goodslist as $item){
					$p="" ;
					if($item['id']==@$data['goodsid']){
						$p="selected" ;
					}
     				echo "<option value='$item[id]' $p>$item[name]</option>" ;
     			}
     			?>
			</select>
			时间:<input type="text" name="date" value="<?php echo @$data['date'] ;?>" size="10" maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"/>
			<input type="hidden" name="page" value="<?php echo @$data['page'] ;?>"/>
       		<input type="submit" value="查询">
        </form>
        </div>
        <table class="GF-listTab">
            <tbody>
            <tr id="title">
                <td>ID</td>
                <td>批发商</td>
                <td>商品名</td>
                <td>买家名</td>
                <td>付款</td>
                <td>数量</td>
                <td>运费</td>
                <td>日期</td>
                <td>单价</td>
            </tr>
		<?php
		$i = 0;
		$priceCount = $numCount = $fareCount = $sumCount =0 ;
		foreach ($list as $item){
			$class = $i%2==0 ? 'trstyle1' : 'trstyle2';
			$id = $item['id'] ;
			$whoname 	= $item['whoname'] ;
			$goodsname 	= $item['goodsname'] ;
			$buyer 		= $item['buyer'] ;
			$price 		= $item['price'] ;
			$num	 	= $item['num'] ;
			$fare	 	= $item['fare'] ;
			$date	 	= $item['date'] ;
			$sum 		= ($price-$fare)/$num ;
			$i++;
			echo "<tr class='$class'><td>{$i}</td>".
			"<td>$whoname</td>".
			"<td>$goodsname</td>".
			"<td><a href='?dir=ali&control=sale&action=up&id=$id'>$buyer</a></td>".
			"<td>$price</td>".
			"<td>$num</td>".
			"<td>$fare</td>".
			"<td>$date</td>".
			"<td>$sum</td></tr>" ;
			$priceCount += $price ;
			$numCount += $num ;
			$fareCount += $fare ;
		}
		echo "<tr class='trstyle2'><td>统计</td>".
			"<td>$i</td>".
			"<td>-</td>".
			"<td>-</td>".
			"<td>$priceCount</td>".
			"<td>$numCount</td>".
			"<td>$fareCount</td>".
			"<td>-</td>".
			"<td>-</td></tr>" ;
		?>
		</table>
		<?php include 'paging.php';?>
	</div>
</div>
</body>
</html>