<?php 
$your_email ='playhouse87@gmail.com';// <<=== update to your email address

session_start();
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
		
		header('Location: thank-you.html');
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
<div id="content">
<div id="captcha">
<p class="head_text">Контактная информация</p>

<p><strong>123456 г. Москва ул. Уличная 12</strong></p>
<ul style="list-style-image: url('images/metro.jpg');">
<li>Трубная, Сухаревская
</ul>

<img src="images/map.jpg" style="border: 1px dashed #9F9F9F; padding: 3px;" />

<p><strong>Форма обратной связи</strong></p>
<?php
if(!empty($errors)){
echo "<p class='err'>".nl2br($errors)."</p>";
}
?>
<div id='contact_form_errorloc' class='err'></div>

<form method="POST" name="contact_form" 
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
