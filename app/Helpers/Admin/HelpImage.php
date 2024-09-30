<?php

function getHelpImage($image)
{
?>

    <a class="btn-action btn-blue" data-fancybox href='<?php echo url("/img/content-adm/prints/{$image}.png") ?>'>
        <iconify-icon icon="charm:help"></iconify-icon>
    </a>

<?php
}

?>