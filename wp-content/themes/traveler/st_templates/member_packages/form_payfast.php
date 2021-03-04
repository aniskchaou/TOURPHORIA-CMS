<?php
/**
 *@since 1.3.1
 *@updated 1.3.1
 **/
$hiddenFields = '';
foreach ($res->getRedirectData() as $key => $value) {
    $hiddenFields .= sprintf(
        '<input type="hidden" name="%1$s" value="%2$s" />',
        htmlentities($key, ENT_QUOTES, 'UTF-8', false),
        htmlentities($value, ENT_QUOTES, 'UTF-8', false)
    ) . "\n";
}

$url = htmlentities($res->getRedirectUrl(), ENT_QUOTES, 'UTF-8', false);
?>

<form action="<?php echo esc_url($url); ?>" method="post" id="st_form_payfast_submit">
    <?php echo balanceTags($hiddenFields); ?>
    <script>document.getElementById('st_form_payfast_submit').submit();</script>
</form>