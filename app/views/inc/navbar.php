<?php if(isset($_SESSION['user_id'])) : ?>
  <nav>
        <ul>
            <li>
                <p><a href="account">Mein Account</a></p>
            </li>
            <li>
                <p><a href="../users/logout">Logout</a></p>
            </li>
        </ul>
    </nav>
<?php else : ?>

<?php endif; ?>