<?php if(isset($_SESSION['user_id'])) : ?>
  <nav>
        <ul>
            <li>
                <p><a href="<?php echo URLROOT; ?>/balances/">balance sheet</a></p>
            </li>
            <li>
                <p><a href="<?php echo URLROOT; ?>/accounts/">my account</a></p>
            </li>
            <li>
                <p><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></p>
            </li>
        </ul>
    </nav>
<?php else : ?>

<?php endif; ?>