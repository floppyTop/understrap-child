<?php
    get_header();
?>

<?php
    $heroBG1 = get_field('hero_image_one');
    $heroBG2 = get_field('hero_image_two');
?>

<div class="hero">
    <div style="background-image: url(' <?php echo $heroBG1['url'] ?>')"></div>
    <div style="background-image: url(' <?php echo $heroBG2['url'] ?>')"></div>
</div>

<?php
    get_footer();
?>