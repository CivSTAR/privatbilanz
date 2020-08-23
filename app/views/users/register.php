<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="content">
      <div class="loginbox">
        <div class="loginbox-top">
          <h2>Account anlegen</h2>
        </div>
        <div class="loginbox-content">
          <form action="register" method="post">
            <ul class="formlist">
              <li class="formlist-line">
                <input class="formlist-input" type="text" name="name" value="<?php echo $data['name']; ?>" placeholder="Username" required>
            <?php if(!empty($data['name_err'])) : ?>
              </li>
              <li class="formlist-invalid">
                <span><?php echo $data['name_err']; ?></span>
            <?php endif; ?>
              </li>
              <li class="formlist-line">
                <input class="formlist-input" type="email" name="email" value="<?php echo $data['email']; ?>" placeholder="E-Mail" required>
            <?php if(!empty($data['email_err'])) : ?>
              </li>
              <li class="formlist-invalid">
                <span><?php echo $data['email_err']; ?></span>
            <?php endif; ?>
              </li>
              <li class="formlist-line">
                <input class="formlist-input" type="password" name="password" value="<?php echo $data['password']; ?>" placeholder="Passwort" required>
              </li>
            <?php if(!empty($data['password_err'])) : ?>
              </li>
              <li class="formlist-invalid">
                <span><?php echo $data['password_err']; ?></span>
            <?php endif; ?>
              <li class="formlist-line">
                <input class="formlist-input" type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>" placeholder="Passwort wiederholen" required>
              </li>
            <?php if(!empty($data['confirm_password_err'])) : ?>
              </li>
              <li class="formlist-invalid">
                <span><?php echo $data['confirm_password_err']; ?></span>
            <?php endif; ?>              
              <li class="formlist-line">
                <input class="formlist-button" type="submit" value="Anlegen" required>
              </li>
            </ul>
          </form>
        </div>
      </div>
      <div class="logininfobox">
        <p>Doch keinen Account anlegen? Dann zurück zum <a href="login">Login</a>.</p>
      </div>
    </section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>