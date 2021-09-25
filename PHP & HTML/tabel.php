<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'>10:12 2019-01-02</div> <div class='col s3'>10</div>
</div>
<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'>10:12 2019-01-02</div> <div class='col s3'>7</div>
</div>
<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'>10:12 2019-01-02</div> <div class='col s3'>8</div>
</div>
<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'>10:12 2019-01-02</div> <div class='col s3'>5</div>
</div>
<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'>10:12 2019-01-02</div> <div class='col s3'>3</div>
</div>
<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'>10:12 2019-01-02</div> <div class='col s3'>1</div>
</div>
<?php
	include 'connect.php';
	$query =  "Select* from data ORDER By id DESC";
	$tampil=mysqli_query($connect,$query);
	while ($data = mysqli_fetch_array ($tampil)){
	echo "
	<div class='col s12' style='border-bottom:1px solid silver; padding : 10px;'>
	<div class='col s9'> ".$data['time']." ".$data['date']." </div>
	<div class='col s3'> ".$data['temperature']." </div>
	</div>
";
}
?>