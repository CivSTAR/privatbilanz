<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="content">
    <?php flash('accounts_msg'); ?>
    <div class="loginbox">
        <div class="loginbox-top">
            <h2>Change password</h2>
        </div>
        <div class="loginbox-content">
            <form action="<?php echo URLROOT; ?>/accounts/change/" method="post">
                <ul class="formlist">
                    <li class="formlist-line">
                        <input class="formlist-input" type="password" name="password" value="<?php echo (!empty($data['password']) ? $data['password'] : ''); ?>" placeholder="Password" required>
                    </li>
                    <?php if(!empty($data['password_err'])) : ?>
                    </li>
                    <li class="formlist-invalid">
                        <span><?php echo $data['password_err']; ?></span>
                    <?php endif; ?>              
                    <li class="formlist-line">
                        <input class="formlist-input" type="password" name="confirm_password" value="<?php echo (!empty($data['confirm_password']) ? $data['confirm_password'] : ''); ?>" placeholder="Confirm password" required>
                    </li>
                    <?php if(!empty($data['confirm_password_err'])) : ?>
                    </li>
                    <li class="formlist-invalid">
                        <span><?php echo $data['confirm_password_err']; ?></span>
                    <?php endif; ?>
                    <li class="formlist-line">
                        <input class="formlist-button" type="submit" value="Change password">
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <br />
    <div class="loginbox">
        <div class="loginbox-top-red">
            <h2>Delete account</h2>
        </div>
        <div class="loginbox-content">                   
            <form action="<?php echo URLROOT; ?>/accounts/delete/" method="post">
                <ul class="formlist">
                    <li class="formlist-line">
                        <input class="formlist-button-red" type="submit" value="Delete account">
                    </li>
                </ul>
            </form>
            <p class="warning-text">By clicking this button your account and all the data within will be deleted.<br />Are you sure you want to continue?</p> 
        </div>
    </div>

</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>