<?php
              $strJsonFileContents = file_get_contents("people.json");
			  $array = json_decode($strJsonFileContents, true);
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
        $question =$_POST['question'];
		$en_name = $_POST['person'];    
		$fa_name = $array["$en_name"];
		$hash = hash('crc32',$question."".$en_name);
		$hash = hexdec($hash);
		$num = $hash % 16;
		$myFile = "messages.txt";
        $lines = file($myFile);
        $msg = $lines[$num];
   }
    else {
        $question ='';
		$msg = 'سوال خود را بپرس!';
		$en_name = array_rand($array);
	    $fa_name = $array["$en_name"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
   <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
    <div id="title">
        <span id="label">پرسش:</span>
        <span id="question"><?php echo $question ?></span>
    </div>
	<?php } ?>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
			  <?php foreach($array as $key => $value) { ?>
			  <option value="<?php echo $key ?>"><?php echo $value ?></option>
			  <?php }?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>