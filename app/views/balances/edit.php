<?php require_once APPROOT . '/views/inc/header.php'; ?>

    <section class="content">
        <div class="loginbox">
            <div class="loginbox-top">
            <h2>Edit item</h2>
            </div>
            <div class="loginbox-content">
            <form action="<?php echo URLROOT; ?>/balances/edit/<?php echo $data['id']; ?>" method="post">
                <ul class="formlist">
                    <li class="formlist-line">
                        <input class="formlist-input" type="text" name="title" value="<?php echo $data['title']; ?>" placeholder="Information" required>
                <?php if(!empty($data['title_err'])) : ?>
                    </li>
                    <li class="formlist-invalid">
                    <span><?php echo $data['title_err']; ?></span>
                <?php endif; ?>
                    </li>
                    <li class="formlist-line">
                        <input class="formlist-input" type="text" name="value" value="<?php echo $data['value']; ?>" placeholder="Betrag" required>
                    </li>
                <?php if(!empty($data['value_err'])) : ?>
                    </li>
                    <li class="formlist-invalid">
                    <span><?php echo $data['value_err']; ?></span>
                <?php endif; ?>
                    <li class="formlist-line">
                        <input class="formlist-button" type="submit" value="Editieren" required>
                    </li>
                </ul>
            </form>
            </div>
        </div>
    </section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>