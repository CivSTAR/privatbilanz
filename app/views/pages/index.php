<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="content">
      <div class="loginbox">
        <div class="loginbox-top">
          <h2>Login</h2>
        </div>
        <div class="loginbox-content">
          <form action="users/login" method="post">
            <ul class="formlist">
              <li class="formlist-line">
                <input class="formlist-input" type="email" name="email" value="" placeholder="E-Mail" required>
              </li>
              <li class="formlist-line">
                <input class="formlist-input" type="password" name="password" value="" placeholder="Passwort" required>
              </li>
              <li class="formlist-line">
                <input class="formlist-button" type="submit" value="Einloggen" required>
              </li>
            </ul>
          </form>
        </div>
    </div>
    <div class="logininfobox">
        <p>Nur einmal austesten?<br />Username: guest@mail.com<br />Passwort: test1234</p>
        <p>Du kannst auch einen <a href="users/register">Account erstellen</a>.</p>
        <p>Hast du dein <a href="users/recoverPassword">Passwort vergessen</a>?</p>
    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>