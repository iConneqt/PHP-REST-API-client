<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test iConneqt API</title>
    </head>
    <body>
		<?php
		/**
		 * This example demonstrates getting information about subscriber lists
		 */
		require_once dirname(__DIR__) . '/common.php';

		$iconneqt = new Iconneqt\Api\Rest\Iconneqt(EXAMPLE_URL, EXAMPLE_USERNAME, EXAMPLE_PASSWORD);

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
				echo "<div style='background:#2ecc71'>Added subscriber #{$subscriber->getId()}</div>";
			} catch (Exception $e) {
				echo "<div style='background:#e74c3c'>Could not add subscriber: {$e->getCode()} {$e->getMessage()}</div>";
			}
		}
		?>

		<h1>Lists</h1>
		<?php
		foreach ($iconneqt->getLists() as $list) {
			echo "<h2>List named '{$list->getName()}' (#{$list->getId()}) has {$list->getFieldCount()} fields and {$list->getSubscriberCount()} subscribers.</h2>";

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

		<hr/>

		<h2>Add subscriber to list #92</h2>
		<form method="post">
			<div>E-mail address: <input name="email"/></div>
			<?php
			foreach ($iconneqt->getListFields(EXAMPLE_LISTID) as $field) {
				switch ($field->getType()) {
					case 'text':
						echo "<div>{$field->getName()} (#{$field->getId()}): <input name=\"{$field->getId()}\"/></div>";
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
