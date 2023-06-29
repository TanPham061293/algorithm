<!DOCTYPE html>
<html>
<head>
<meta charset="${encoding}">
<script type="text/javascript" src ="js/jquery-3.7.0.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#input').focus();
	$('#input').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
		$("#form").submit();
			}
		});
});
</script>
<title>Insert title here</title>
</head>
<body>
<?php 
$minTotal = 0;
$maxTotal = 0;
$arr      = array();
$flag     = true;
    if (isset($_POST['input'])){
        $arr   = explode(' ', $_POST['input']);
        $count = count($arr);
       
        for ($i = 0; $i < $count ; $i++){
            if ($arr[$i] == null){
                unset($arr[$i]);
            }elseif (is_numeric($arr[$i]) && ($arr[$i] < 1 || $arr[$i] != round($arr[$i]))){
                $flag = false;
             }elseif (!is_numeric($arr[$i])){
                 $flag = false;
                 break;
            }
        }
        $count = count($arr); 
        if ($flag == true){
            if ($count == 5){
                $min     = min($arr);
                $max     = max($arr);
                $flagmin = true;
                $flagmax = true;
                foreach ($arr as $keys => $values){
                    if ($values == $min && $flagmin == true){
                        $flagmin = false;
                    }
                    elseif ($values != $min || ($values == $min && $flagmin  == false)){
                        $maxTotal +=  $values;
                    }
                    if ($values == $max && $flagmax == true){
                        $flagmax = false;
                    }
                    elseif ($values != $max || ($values == $max && $flagmax == false)){
                        $minTotal += $values;
                    }
                }
            }else {
                $flag = false;
            }
        }   
    }
    if ($flag == false){
        echo 'Invalid data';
    }
    $result = '';
    if ($minTotal != 0 || $maxTotal != 0){
        $result = $minTotal. ' ' . $maxTotal;
    }

?>
    <div>
    	<form action="#" method ="post" id="form">
    	<p>Input:</p>
    	<input type = "text" name ='input' id ='input' style ="width: 100%; border:none; outline:none" value ="<?php echo (isset($_POST['input']) ? $_POST['input'] :'' )?>">
    	<p>Output:</p>
    	<label><?php echo $result;?></label>
    	
    	</form>
    </div>
</body>
</html>