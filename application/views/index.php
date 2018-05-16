<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Charter Form of Paracou</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/style.css">
	</head>
	<body>
		<div class="container mx-auto my-3">
			<div class="row justify-content-center">
				<div class="col-12 justify-content-center">
					<div class="alert alert-info">Fields with * are required</div>
					<div class="alert alert-danger">
						<?php echo validation_errors(); ?>
					</div>
					<form method="post">
					<?php
						foreach ($form_array as $name => $value) {
							$required = '';
							$type = $value['type'];
							$label = $value['label'];
							$rules = $value['rules'];
							$tip = $value['tip'];
							
							
							switch ($type) {
								case 'textarea':
									echo "<div class='form-group'>";
									if (strpos($rules, 'required') !== false) {
										$required = "*";
									}
									echo "<label for='$name'>$label$required</label>";
									echo (!empty($tip)) ? "<div class='tip'>$tip</div>" : null;
									echo "<textarea class='form-control' value='".set_value($name)."' id='$name'></textarea>";
									echo "</div>";
									break;
								case 'checkbox':
									echo "<div class='form-check'>";
									if (strpos($rules, 'required') !== false) {
										$required = "*";
									}
									echo "<label class='form-check-label' for='$name'>$label$required</label>";
									echo (!empty($tip)) ? "<div class='tip'>$tip</div>" : null;
									echo "<input class='form-check-input' value='".set_value($name)."' type='$type' id='$name'>";
									echo "</div>";
									break;
								default:
									echo "<div class='form-group'>";
									if (strpos($rules, 'required') !== false) {
										$required = "*";
									}
									echo "<label for='$name'>$label$required</label>";
									echo (!empty($tip)) ? "<div class='tip'>$tip</div>" : null;
									echo "<input class='form-control' value='".set_value($name)."' type='$type' id='$name'>";
									echo "</div>";
									break;
							}
						}
					?>
					<input class="btn btn-primary" type="submit" id="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>