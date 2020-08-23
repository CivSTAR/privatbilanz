<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="content">
  <?php 
    flash('register_success');
    flash('recover_password');
    flash('verifyRecover'); 
    flash('verifyRecoverFail');
  ?>
  <div class="loginbox">
    <div class="loginbox-top">
      <h2>Login</h2>
    </div>
    <div class="loginbox-content">
      <form action="login" method="post">
        <ul class="formlist">
          <li class="formlist-line">
            <input class="formlist-input" type="email" name="email" value="<?php echo $data['email']; ?>" placeholder="E-Mail" required>
          </li>
        <?php if(!empty($data['email_err'])) : ?>
          </li>
          <li class="formlist-invalid">
            <span><?php echo $data['email_err']; ?></span>
        <?php endif; ?>              
          <li class="formlist-line">
            <input class="formlist-input" type="password" name="password" value="<?php echo $data['password']; ?>" placeholder="Passwort" required>
          </li>
        <?php if(!empty($data['password_err'])) : ?>
          </li>
          <li class="formlist-invalid">
            <span><?php echo $data['password_err']; ?></span>
        <?php endif; ?>              
          <li class="formlist-line">
            <input class="formlist-button" type="submit" value="Einloggen" required>
          </li>
        </ul>
      </form>
    </div>
  </div>
  <div class="logininfobox">
      <p>Nur einmal austesten?<br />Username: guest@mail.com<br />Passwort: test1234</p>
      <p>Du kannst auch einen <a href="register">Account erstellen</a>.</p>
      <p>Hast du dein <a href="recoverPassword">Passwort vergessen</a>?</p>
  </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>