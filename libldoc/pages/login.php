<p>If you have a user account, you can log in using the form below. If you do
not yet have an account, you can <a href="index.php?page=register">register</a>
for one.</p>

<div class="form-container">
  <form method="post" action="index.php?action=auth">
    <label for="username">Username</label><br />
    <input type="text" name="username" id="username" /><br />
  
    <label for="password">Password</label><br />
    <input type="password" name="password" id="password" /><br />

    <input type="submit" class="submit" value="Log In" />
  </form>
</div>
