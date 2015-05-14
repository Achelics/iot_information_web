<?php // content="text/plain; charset=utf-8"
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_scatter.php');
	//1.连接到数据库
	require_once 'db/mysql_connect.php';
	$sql1="select data_x,data_y from data_cluster1";

	$sql2="select data_x,data_y from data_cluster2";

	$sql3="select data_x,data_y from data_cluster3";

	$result1=mysql_query($sql1);

	$result2=mysql_query($sql2);

	$result3=mysql_query($sql3);

	$DATA1=array();

	$DATA2=array();

	$DATA3=array();

	$x_data1=array();
	$y_data1=array();

	$x_data2=array();
	$y_data2=array();

	$x_data3=array();
	$y_data3=array();

	while($row1 = mysql_fetch_assoc($result1))  //将数据以索引方式储存在数组中  
	{
		$DATA1[] = $row1;
	}
	foreach ($DATA1 as $v) {
		$x_data1[] = $v['data_x'];
		$y_data1[] = $v['data_y'];
	}

	while($row2 = mysql_fetch_assoc($result2))  //将数据以索引方式储存在数组中  
	{
		$DATA2[] = $row2;
	}
	foreach ($DATA2 as $v) {
		$x_data2[] = $v['data_x'];
		$y_data2[] = $v['data_y'];
	}

	while($row3 = mysql_fetch_assoc($result3))  //将数据以索引方式储存在数组中  
	{
		$DATA3[] = $row3;
	}
	foreach ($DATA3 as $v) {
		$x_data3[] = $v['data_x'];
		$y_data3[] = $v['data_y'];
	}
	 
	$graph = new Graph(600,600);
	$graph->SetScale("linlin");
	 
	$graph->img->SetMargin(60,60,60,60);        
	$graph->SetShadow();
	 
	$graph->title->Set("Cluster plot");
	$graph->title->SetFont(FF_FONT1,FS_BOLD);

	$sp1 = new ScatterPlot($y_data1,$x_data1);
	$sp1->mark->SetFillColor("red"); 

	$sp2 = new ScatterPlot($y_data2,$x_data2);
	$sp2->mark->SetFillColor("green"); 	

	$sp3 = new ScatterPlot($y_data3,$x_data3);
	$sp3->mark->SetFillColor("blue"); 

	$graph->Add($sp1);
	$graph->Add($sp2);
	$graph->Add($sp3);
	$graph->Stroke();
?>