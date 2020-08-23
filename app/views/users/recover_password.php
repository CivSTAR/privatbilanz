<?php require_once APPROOT . '/views/inc/header.php'; ?>

    <section class="content">
      <div class="loginbox">
        <div class="loginbox-top">
          <h2>Passwort vergessen</h2>
        </div>
        <div class="loginbox-content">
          <form action="recoverPassword" method="post">
            <ul class="formlist">
              <li class="formlist-line">
                <input class="formlist-input" type="email" name="email" value="" placeholder="E-Mail" required>
              </li>
              <li class="formlist-line">
                <input class="formlist-button" type="submit" value="Wiederherstellen" required>
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