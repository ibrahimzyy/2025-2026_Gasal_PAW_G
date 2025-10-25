<?php
function validateName($field_list, $field_name) {
    $result = ['valid' => true, 'error' => ''];

    if (!isset($field_list[$field_name])) {
        $result['valid'] = false;
        $result['error'] = "Field '$field_name' tidak ditemukan.";
        return $result;
    }

    $pattern = "/^[a-zA-Z]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $result['valid'] = false;
        $result['error'] = "Field '$field_name' hanya boleh berisi huruf alfabet.";
    }

    return $result;
}
?>
