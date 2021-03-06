<?php
$title = 'Login Zugangsdaten bearbeiten';
$pageId = 'editAccountBody';
?>
<?php ob_start() ?>
	<div class="container form-small">
		<form action="<?php echo $htmlroot; ?>/index.php?editAccount" method="POST" accept-charset="utf-8" name="editAccount"
			id="editAccount" role="form" class="form-horizontal">
			<input type="hidden" name="updateAccount" value="true" />
			<h2 id="headline">Benutzerdaten bearbeiten</h2>
			<?php
				if ($messages) {
					echo "<p id=\"editAccountError\" class=\"col-sm-offset-3 error messages\">" . join("<br />", $messages) . "</p>\n";
				}
			?>
			<div id="NameContainer" class="form-group<?php if($_POST && !$inputNameOk) {echo ' has-error';} ?>">
				<label for="Name" class="col-sm-3 control-label">Name:</label>
				<div class="col-sm-9">
					<input type="text" name="Name" id="Name" class="input-large Name<?php if($_POST && !$inputNameOk) {echo ' has-error';} ?>"
						placeholder="Name" value="<?php echo $loginData["Name"]; ?>">
				</div>
			</div>
			<div id="eMailContainer" class="form-group<?php if($_POST && !$inputEMailOk) {echo ' has-error';} ?>">
				<label for="eMail" class="col-sm-3 control-label">E-Mail:</label>
				<div class="col-sm-9">
					<input type="text" name="eMail" id="eMail" class="input-large eMail<?php if($_POST && !$inputEMailOk) {echo ' has-error';} ?>"
						placeholder="E-Mail" value="<?php echo $loginData["eMail"]; ?>">
				</div>
			</div>
			<div id="UsernameContainer" class="form-group<?php if($_POST && !$inputUsernameOk) {echo ' has-error';} ?>">
				<label for="Username" class="col-sm-3 control-label">Anmeldename:</label>
				<div class="col-sm-9">
					<input type="text" name="Username" id="Username" class="input-medium Username<?php if($_POST && !$inputUsernameOk) {echo ' has-error';} ?>"
						placeholder="Benutzername"
						value="<?php echo $loginData["Username"]; ?>">
				</div>
			</div>
			<div id="PasswordContainer" class="form-group<?php if($_POST && !$inputPasswordOk) {echo ' has-error';} ?>">
				<label for="Password" class="col-sm-3 control-label">Passwort:</label>
				<div class="col-sm-9">
					<input type="password" name="Password" id="Password"
						class="input-medium Password<?php if($_POST && !$inputPasswordOk) {echo ' has-error';} ?>" placeholder="Passwort">
				</div>
			</div>
			<div id="Password2Container" class="form-group<?php if($_POST && !$inputPasswordOk) {echo ' has-error';} ?>">
				<label for="Password2" class="col-sm-3 control-label">Wiederholung:</label>
				<div class="col-sm-9">
					<input type="password" name="Password2" id="Password2"
						class="input-medium Password<?php if($_POST && !$inputPasswordOk) {echo ' has-error';} ?>" placeholder="Wiederholung">
				</div>
			</div>
			<div id="submitContainer" class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button name="submit" id="submit" class="btn btn-primary" type="submit">Speichern</button>
					<a href="<?php echo $htmlroot; ?>/index.php" class="homeLink btn inputWidth">zurück zum Start</a>
				</div>
			</div>
		</form>
	</div>
<?php $content = ob_get_clean() ?>
<?php include 'page.php' ?>
