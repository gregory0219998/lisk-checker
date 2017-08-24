<?php 
$string = 'word1 word2 word3...';
// put a password in $key
$key = '6cnzjhn4Ehvs9PQbbnVW3fDjaxabJUELfbx';
$iv = mcrypt_create_iv(
    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
    MCRYPT_DEV_URANDOM
);

$encrypted = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        hash('sha256', $key, true),
        $string,
        MCRYPT_MODE_CBC,
        $iv
    )
	
);
echo "$encrypted \n"
echo "Remember to remove me \n"
?>
