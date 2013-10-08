<? session_start(); ?>
<?php 
$your_email ='playhouse87@gmail.com';// <<=== update to your email address
$errors = '';
$name = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	
	$name = $_POST['name'];
	$visitor_email = $_POST['email'];
	$user_message = $_POST['message'];
	///------------Do Validations-------------
	if(empty($name)||empty($visitor_email))
	{
		$errors .= "\n Имя и e-mail поля - обязательные к заполнению. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Неправильный формат e-mail!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n Код с картинки введен неверно, попробуйте еще раз!";
	}
	
	if(empty($errors))
	{
		//send the email
		$to = $your_email;
		$subject="Новое сообщение с сайта";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "Пользователь $name воспользовался формой обратной связи:\n".
		"Имя: $name\n".
		"Email: $visitor_email \n".
		"Сообщение: \n ".
		"$user_message\n".
		"IP-адрес: $ip\n";	
		
		$headers = "От: $from \r\n";
		$headers .= "Ответить: $visitor_email \r\n";
		
		mail($to, $subject, $body,$headers);
		
		header('Location: contacts.php');
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>

<?php
if(!empty($errors)){
echo "<p class='err'>".nl2br($errors)."</p>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:300italic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'> <!-- font-family: 'Roboto', sans-serif; -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script>
<script language="JavaScript" src="js/gen_validatorv31.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>  
    <script src="js/jquery.timer.js"></script>  
    <script src="js/image-rotator.js"></script> 
<title>Контакты</title>
</head>

<body>
<div id="container">
<div id="upper_text">Адвокаты Москвы и Московской области</div>
<div id="contacts">
	<p class="telephone">+7 (495) 123 45 67</p>
	<div class="adress">Наш адрес</div>
	<div class="adress">123456 г. Москва ул. Уличная 12</div>
</div>

	<div id="window">      
    <ul id="slideshow">  
        <li class="box1"><img src="images/head.jpg" alt="1"/></li>  
        <li class="box2"><img src="images/head1.jpg" alt="2"/></li>  
        <li class="box3"><img src="images/head2.jpg" alt="3"/></li> 
        <li class="box1"><img src="images/head3.jpg" alt="4"/></li> 
    </ul>  
</div>
<div id="nav">
<ul>
<li><a href="index.php" title="Главная">О коллегии</a></li>
<li><a href="price.php" title="Наши услуги">Юридические услуги</a></li>
<li><a href="advocates.php" title="Адвокаты коллегии">Адвокаты коллегии</a></li>
<li><a href="practice.php" title="Наша практика">Наша практика</a></li>
<li><a href="contacts.php" title="Контакты">Контакты</a></li>
</ul>
</div>

<div id="advocates">
<p style="text-decoration: underline; border: 0px; font-size: 1em;">АДВОКАТЫ КОЛЛЕГИИ</p>
<div id="major_advocate">
	<div id="major_photo"><img src="images/major_image.jpg" /></div>
	<div id="major_status">Председатель коллегии</div>
	<div id="major_about"><strong>Нарышкин</strong><br />Александр Николаевич</div>
	<div id="major_text">Стаж с 2000 года<br />Дела жилищные, уголовные...</div>
	<div id="major_link">подробнее...</div>
</div>
<p><a href="#"><strong>Иванов</strong><br /> Иван Иванович</a></p>
<p><a href="#"><strong>Иванова</strong><br /> Ванесса Ивановна</a></p>
<p><a href="#"><strong>Иванов</strong><br /> Иван Иванович</a></p>
<p><a href="#"><strong>Иванова</strong><br /> Ванесса Ивановна</a></p>
<p><a href="#"><strong>Иванов</strong><br /> Иван Иванович</a></p>
<p><a href="#"><strong>Иванова</strong><br /> Ванесса Ивановна</a></p>
</div>


<div id="content">
<div id="captcha">
<p class="head_text">Контактная информация</p>

<p><strong>123456 г. Москва ул. Уличная 12</strong></p>
<ul style="list-style-image: url('images/metro.jpg');">
<li>Трубная, Сухаревская
</ul>

<img src="images/map.jpg" style="border: 1px dashed #9F9F9F; padding: 3px;" />

<p><strong>Форма обратной связи</strong></p>


<div id='contact_form_errorloc' class='err'></div>

<form method="POST" id="contact_form" 
action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
<p>
<label for='name'>Ваше имя:</label><br>
<input type="text" name="name" value='<?php echo htmlentities($name) ?>'>
</p>
<p>
<label for='email'>Ваш e-mail:</label><br>
<input type="text" name="email" value='<?php echo htmlentities($visitor_email) ?>'>
</p>
<p>
<label for='message'>Сообщение:</label> <br>
<textarea name="message" rows=8 cols=30><?php echo htmlentities($user_message) ?></textarea>
</p>
<p>
<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
<label for='message'>Введите код с картинки:</label><br>
<input id="6_letters_code" name="6_letters_code" type="text"><br>
<p>Не можете прочесть? Нажмите <a href='javascript: refreshCaptcha();'>сюда</a> чтобы обновить.</p>
</p>
<input type="submit" value="Отправить" name='submit'>
</form>
</div>
</div>
<script language="JavaScript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contact_form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<div id="footer"></div>
</div>

</body>
</html>