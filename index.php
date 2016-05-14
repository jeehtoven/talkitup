<html>
<title>Talk It Up!</title>
<body>
	<center>
		<br>
		<br>
		<h1>Talk It Up!</h1>
		<br>
		<b>Talk It Up!</b> is an application used to upload podcast episodes to the computer server, and to update the xml file that lists the episodes.
		<br>
		<br>
		<form action="thankyou.php" method="post" enctype="multipart/form-data">
			Tell us about your podcast...
			<br><br></center>
			<fieldset>
			<legend>Podcast Information:</legend>
			<br><br>
			Title:
			<input type="text" name="title"><br><br>
			Author(s):
			<input type="text" name="author"><br><br>
			Subtitle:
			<input type="text" name="subtitle"><br><br>
			Summary:
			<input type="text" name="summary"><br><br>
			Image: 
			<input type="file" name="image"><br><br>
			XML File Name:
			<input type="text" name="xml"><br><br>
			Podcast: 
			<input type="file" name="podcast"><br><br>
			Duration: 
			<input type="text" name="duration"><br><br>
			Explicit?
			<input type="radio" name="explicit" value="yes" checked> Yes
			<input type="radio" name="explicit" value="no"> No<br><br>
			</fieldset>
			<br>
			<fieldset>
			<legend>Server Information:</legend>
			<br><br>
			Directory:
			<input type="text" name="directory"><br><br>
			Password:
			<input type="password" name="password"><br><br>
			</fieldset>
			<br>
			<input type="submit" value="Talk It Up!" name="submit"><br>
		</form>
</body>
