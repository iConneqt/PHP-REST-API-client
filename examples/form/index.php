<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test iConneqt API</title>
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

		define('EXAMPLE_LISTID', 92); // This should be a user setting

		if (isset($_POST['addSubscriber'])) {
			
			$fields = [];
			foreach ($_POST as $key => $value) {
				if (is_int($key)) {
					$fields[$key] = $value;
				}
			}
			
			try {
				$list = $iconneqt->getList(EXAMPLE_LISTID);
				$subscriber = $list->addSubscriber($_POST['email'], true, $fields);
				echo "<div class='success'>Added subscriber #{$subscriber->getId()}</div>";
			} catch (Exception $e) {
				echo "<div class='error'>Could not add subscriber: {$e->getCode()} {$e->getMessage()}</div>";
			}
		}
		?>

		<h1>Lists</h1>
		<ol>
		<?php
		foreach ($iconneqt->getLists() as $list) {
			echo "<li>List '{$list->getName()}' (#{$list->getId()}) has {$list->getFieldCount()} fields and {$list->getSubscriberCount()} subscribers.</li>";

			echo "<ol>";
			foreach ($list->getSubscribers() as $subscriber) {
				echo "<li>{$subscriber->getEmail()} (#{$subscriber->getId()})</li>";

				echo "<ul>";
				foreach ($subscriber->getFields() as $field) {
					echo "<li>{$field->getName()}: {$field->getValue()}</li>";
				}
				echo "</ul>";
			}
			echo "</ol>";
		}
		?>
		</ol>

		<hr/>

		<h1>Add subscriber to list #92</h1>
		<form method='post'>
			<div><label>E-mail address</label><input name='email' placeholder='email@domain.tld'/></div>
			<?php
			foreach ($iconneqt->getListFields(EXAMPLE_LISTID) as $field) {
				switch ($field->getType()) {
					case 'text':
						echo "<div><label>{$field->getName()} (#{$field->getId()})</label><input name='{$field->getId()}' placeholder='{$field->getType()}'/></div>";
						break;

					default:
						echo "<div>Fields of type '{$field->getType()}' are not supported by this example</div>";
						break;
				}
			}
			?>
			<button type="submit" name="addSubscriber">Add subscriber</button>
		</form>
    </body>
</html>
