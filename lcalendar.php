<?php
require_once ("lunercalendar.php");
$Y = '';
$M = '';
$YN = '';
$MN = '';

//現在時間
$YN = date('Y'); 
$MN = date('n');

//下拉式的顯示
$arrMonth = array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun',
	              '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');

$arrYear = array('2006'=>'2006', '2007'=>'2007', '2008'=>'2008', '2009'=>'2009', '2010'=>'2010', 
				 '2011'=>'2011', '2012'=>'2012', '2013'=>'2013', '2014'=>'2014', '2015'=>'2015',
				 '2016'=>'2016', '2017'=>'2017', '2018'=>'2018', '2019'=>'2019', '2020'=>'2020',
				 '2021'=>'2021', '2022'=>'2022', '2023'=>'2023', '2024'=>'2024', '2025'=>'2025', '2026'=>'2026',
				 '2027'=>'2027','2028'=>'2028','2029'=>'2029','2030'=>'2030','2031'=>'2031','2032'=>'2032',
				 '2033'=>'2033','2034'=>'2034','2035'=>'2035');
				  
//現在時間
if (!isset($_POST['Y'])){
	$Y = date('Y');
	if (!isset($_POST['M'])){
		$M = date('n');	
	}else{
		$M = $_POST['M'];
	}
}else{
	$Y = $_POST['Y'];
	if (!isset($_POST['M'])){
		$M = date('n');	
	}else{
		$M = $_POST['M'];
	}
}

$FirstDate = 1;

//找最後一天
$LastDate = date('j', mktime(0,0,0,$M+1,0,$Y));
$ShowDate = array();

//初始化
for ($i=0; $i<6; $i++)
    for ($j=0; $j<7; $j++)
	$ShowDate[$i][$j] = '';

$r = 0;

//把日期塞進去
for ($d=1; $d<=$LastDate; $d++) {
    $w = date('w',mktime(0,1,0,$M,$d,$Y));
    $ShowDate[$r][$w] = $d;
    if ($w==6) $r++;
}
$Month = date('F',mktime(0,1,0,$M,1,$Y));

//看陣列大小
$LastRow = 5;
if (empty($ShowDate[$LastRow][0])) $LastRow = 4;
if (empty($ShowDate[$LastRow][0])) $LastRow = 3;
?>
<html>
	  <title>網頁程式範例首頁HW</title>
<body>
<div style="text-align:center;margin-top:20px;font-size:30px;font-weight:bold;">
	I4010 網頁程式設計與安全實務 - 國曆+農曆
</div>
<div style="text-align:center;margin-top:20px;font-size:24px;">
Instructor
</div>
<div style="text-align:center;margin-top:20px;">
	<form method="POST" action="">
		Year:
		<select name="Y" onchange="submit();">
		<?php
			for($i = 2006; $i <= 2035; $i++){
				if($Y == $i){
					echo '<option value="'.$i.'" selected>'.$arrYear[$i].'</option>';
				}else{
					echo '<option value="'.$i.'">'.$arrYear[$i].'</option>';
				}
			}
		?>
		</select>
		Month:
		<select name="M" onchange="submit();">
		<?php
			for($i = 1; $i <= 12; $i++){
				if($M == $i){
					echo '<option value="'.$i.'" selected>'.$i.'</option>';
				}else{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}
		?>
		</select>
	</form> 
</div>

<div style="text-align:center;margin-top:20px;">
<?php echo $Month.' '.$Y; ?>
<table border="1" align="center">
<tr align="center">
<td width="100">Sun</td>
<td width="100">Mon</td>
<td width="100">Tue</td>
<td width="100">Wed</td>
<td width="100">Thu</td>
<td width="100">Fri</td>
<td width="100">Sat</td>
</tr>
<?php
for ($r=0; $r<=$LastRow; $r++) {
?>
<tr align="center">
<?php
    for($i=0; $i<7; $i++) {
	$Date = $ShowDate[$r][$i];
	$BgColor = '';
	//當天的日期
	if (!empty($Date)) {
		$LDay = '';
	    $DayOfMonth = date('Y-m-d', mktime(0,1,0,$M,$Date,$Y));
        $LDay = GetLDay($DayOfMonth);
	    $xDate = date('Ymd', mktime(0,1,0,$M,$Date,$Y));
	    if ($xDate==date('Ymd')){
	        $BgColor = ' bgcolor="#AAAAEE"';
		}
        $Date .= '<br>' . $LDay;
	}
    if ($i==0) 
	    $Date = '<span style="color:red">' . $Date . '</span>'; 
    if ($i==6) 
	    $Date = '<span style="color:orange">' . $Date . '</span>'; 
?>
  <td <?php echo $BgColor; ?>><?php echo $Date; ?></td>
<?php } ?>
</tr>
<?php } ?>
</table>
</div>

<div style="text-align:center;margin-top:50px;">
	<?php
		if(!empty($result)){
			echo $result.'<br>';
		}
	?>
</div>
</body>
</html>
