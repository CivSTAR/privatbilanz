<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="content">
    <?php flash('verifyRecoverFail'); ?>
    <div class="loginbox">
        <div class="loginbox-top">
            <h2>Neues Passwort</h2>
        </div>
        <div class="loginbox-content">
            <form action="<?php echo URLROOT; ?>/users/verifyRecover" method="post">
                <ul class="formlist">
                    <li class="formlist-line">
                        <input class="formlist-input" type="password" name="password" value="" placeholder="Passwort" required>
                <?php if(!empty($data['password_err'])) : ?>
                    </li>
                    <li class="formlist-invalid">
                        <span><?php echo $data['password_err']; ?></span>
                <?php endif; ?>                
                    </li>
                    <li class="formlist-line">
                        <input class="formlist-input" type="password" name="confirm_password" value="" placeholder="Wiederhole Passwort" required>
                <?php if(!empty($data['confirm_password_err'])) : ?>
                    </li>
                    <li class="formlist-invalid">
                        <span><?php echo $data['confirm_password_err']; ?></span>
                <?php endif; ?>  
                    </li>
                    <li class="formlist-line">
                        <input class="formlist-button" type="submit" value="Erstellen" required>
                        <input type="hidden" name="verification" value="<?php echo $data['verification']; ?>">
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="logininfobox">
        <p>Zurück zum <a href="login">Login</a>.</p>
    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>