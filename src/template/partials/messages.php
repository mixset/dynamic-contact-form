<section class="message-box">
    <?php if (isset($_SESSION['message'])) : ?>
        <?php foreach ($_SESSION['message'] as $value) : ?>
            <ul>
                <li><?php echo $value; ?></li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</section>