<?php session_start() ?>
<html>
<head>
	<meta charset="utf-8">
	<title>SIGN UP</title>
</head>
<body>
<pre>
	<?php
		if (!empty($_SESSION)) {
			echo 'already signed in';
			//redirect to whatever****************
		}
		
	?>
</pre>
<form action="" method="post">
	<fieldset>
		<legend>SIGN UP</legend>
		<input type="email" name="emailSignUp" value="" placeholder="Email address" /><br/>
		<input type="password" name="passwordSignUp1" value="" placeholder="Password" /><br/>
		<input type="password" name="passwordSignUp2" value="" placeholder="Password" /><br/>
		<input type="submit" value="SUBMIT"/>
	</fieldset>
</form>

</body>
</html>