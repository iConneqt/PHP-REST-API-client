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

		if (isset($_POST['addSubscriber'])) {
			
			$fields = [];
			foreach ($_POST as $key => $value) {
				if (is_int($key)) {
					$fields[$key] = $value;
				}
			}
			
			try {
				$list = $iconneqt->getList(ICONNEQT_LIST);
				
				if (isset($_POST['overwrite'])) {
					$subscriber = $list->setSubscriber($_POST['email'], true, $fields);
				} else {
					$subscriber = $list->addSubscriber($_POST['email'], true, $fields);
				}
				
				echo "<div class='success'>Added subscriber #{$subscriber->getId()}</div>";
			} catch (Exception $e) {
				echo "<div class='error'>Could not add subscriber: {$e->getCode()} {$e->getMessage()}</div>";
			}
		}
		?>

		<h1>Lists</h1>
		<ol>
		<?php
			$list = $iconneqt->getList(ICONNEQT_LIST);
			echo "<li>List '{$list->getName()}' (#{$list->getId()}) has {$list->getFieldCount()} fields and {$list->getSubscriberCount()} subscribers. (first 10 shown)</li>";

			echo "<ol>";
			foreach ($list->getSubscribers(0, 10) as $subscriber) {
				echo "<li>{$subscriber->getEmail()} (#{$subscriber->getId()})</li>";

				echo "<ul class='columns'>";
				foreach ($subscriber->getFields() as $field) {
					echo "<li>{$field->getName()}: {$field->getValue()}</li>";
				}
				echo "</ul>";
			}
			echo "</ol>";
		?>
		</ol>

		<hr/>

		<h1>Add subscriber to list "<?php echo $list->getName(); ?>" (#<?php echo ICONNEQT_LIST; ?>)</h1>
		<form method='post'>
			<div><label>Overwrite?</label><input name='overwrite' id='overwrite' type='checkbox' value='1'/></div>
			<div><label>E-mail address</label><input name='email' type='email' placeholder='email@domain.tld'/></div>
			<?php
				// Get all* fields (* = first 100)
				$fields = $iconneqt->getListFields(ICONNEQT_LIST);

				// List of roles to use
				$roles = array(
					'namefirst',
					'namelastprefix',
					'namelast',
					'postalcode',
					'street',
					'streetnumber',
					'city',
					'region',
				);

				// Remove any fields that do not have a role that we want to use
				$fields = array_filter($fields, function($field) use($roles) {
					return in_array($field->getRole(), $roles);
				});

				// Sort fields by the order or roles
				uasort($fields, function($a, $b) use($roles) {
					return array_search($a->getRole(), $roles) - array_search($b->getRole(), $roles);
				});

				// Display the fields
				foreach ($fields as $field) {
					switch ($field->getType()) {
						case 'text':
							echo "<div><label>{$field->getName()} (#{$field->getId()})</label><input name='{$field->getId()}' placeholder='type: {$field->getType()}, role: {$field->getRole()}'/></div>";
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
