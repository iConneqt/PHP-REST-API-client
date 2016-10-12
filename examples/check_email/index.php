<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Check if subscriber exists</title>
		<link href='../common.css' rel="stylesheet" type='text/css'/>
    </head>
    <body>
		<?php
		/**
		 * This example demonstrates a simple subscription form with partial
		 * discovery of list and field information.
		 * If you already know all the ID's, you can hardcode them if you want.
		 * Alternatively, you can use the names of the fields instead of the
		 * ID's when adding a subscriber.
		 */
		require_once '../common.php';

		$iconneqt = new Iconneqt\Api\Rest\Iconneqt(ICONNEQT_URL, ICONNEQT_USERNAME, ICONNEQT_PASSWORD);

		if (isset($_POST['checkEmail'])) {
			try {
				$list = $iconneqt->getList($_POST['listid']);
				if ($list->hasSubscriber($_POST['email'])) {
					echo "<div class='success'>Subscriber '{$_POST['email']}' exists on list '{$list->getName()}'.</div>";
				} else {
					echo "<div class='warning'>Subscriber '{$_POST['email']}' does not exist in list '{$list->getName()}'.</div>";
				}
			} catch (Exception $e) {
				echo "<div class='error'>Could not check email</div>";
				var_dump($e);
			}
		}
		?>

		<h1>Select a list and check an email address</h1>
		<form method='post'>
			<div>
				<label>List</label>
				<select name='listid'>
					<?php foreach ($iconneqt->getLists() as $list): ?>
						<option value='<?= $list->getId() ?>'><?= $list->getName() ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div>
				<label>E-mail address</label><input name='email' placeholder='email@domain.tld'/>
			</div>
			<button type="submit" name="checkEmail">Check is email exists on list</button>
		</form>
    </body>
</html>
