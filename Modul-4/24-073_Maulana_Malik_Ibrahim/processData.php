<?php
require 'validate.inc';

$validation = validateName($_POST, 'surname');

if ($validation['valid']) {
    echo "Data valid!";
} else {
    echo "Data invalid! <br>";
    echo "Error: " . $validation['error'];
}
?>
