<?php
$email = isset($_COOKIE['email']) ? esc_attr($_COOKIE['email']) : '';
?>

<div class="payform">
    <form method="POST" action="#" class="ykform">
        <input type="hidden" name="label" value="<?php echo esc_attr(session_id()); ?>">
        <input type="hidden" name="sum" value="<?php echo PAYFORM_PRICE; ?>">
        <input type="hidden" name="email" id="email2" value="<?php echo $email; ?>">
        <input type="submit" class="ykbutton redbutton" value="Оплатить">
    </form>

    <script>
    jQuery(function($) {
        $('.ykbutton').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '/wp-content/themes/valentin/handlers/ykpay.php',
                data: $('.ykform').serialize(),
                success: function(response) {
                    window.location.replace(response);
                }
            });
        });
    });
    </script>
</div>