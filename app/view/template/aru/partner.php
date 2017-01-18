<?php
    require_once('include/header.php');
?>
<style>
    <?php   require_once('include/kereses.css'); ?>
    <?php   require_once('include/livesearch.css'); ?>
    <?php   require_once('include/termek.css'); ?>
</style>
<script>
    <?php   require_once('include/js/livesearch.js'); ?>
</script>
<body>
<main>  
<section>
    <article>
    
    
<form action="" method="POST">
    <fieldset>
        <legend>LOGIN FORM</legend>
        Email:
        <input name="email"     type="email"    value="<?php print (isset($_POST['email']) ? $_POST['email'] : null); ?>">
        Jelszó:
        <input name="password"  type="password" value="<?php print (isset($_POST['password']) ? $_POST['password'] : null); ?>">
        <input name="action"    type="hidden"   value="login">
        <input name="submit"    type="submit"   value="Bejelentkezés">
        </fieldset>
</form>

    
<form action="" method="POST">
    <fieldset>
        <legend>REG FORM</legend>
        Email:
        <input name="email"     type="email"    value="<?php print (isset($_POST['email'])    ? $_POST['email'] : null); ?>">
        Jelszó:
        <input name="password"  type="password" value="<?php print (isset($_POST['password']) ? $_POST['password1'] : null); ?>">
        <input name="condition" type="checkbox" value="1" id="accept"><label for="accept" style="display:inline-block;">Elolvastam és elfogadom a felhasználási feltételeket</label>
        <input name="action"    type="hidden"   value="register">
        <input name="submit"    type="submit"   value="Regisztráció" style="display:block;">
        </fieldset>
</form>

    LINKEK:
        
<form action="" method="POST">
    <fieldset>
        <legend>PASSWORD_RECOVERY FORM</legend>
        Email:
        <input name="email"     type="email"    value="<?php print (isset($_POST['email'])    ? $_POST['email'] : null); ?>">
        <input name="action"    type="hidden"   value="passwordrecovery">
        <input name="submit"    type="submit"   value="Új jelszó kérése">
    </fieldset>
</form>
        
        
        ASZF
    
    
    </article>
</section>
   

<?php
    require_once('include/footer.php');
?>
</main>


<!-- Featherlight Lightbox JS -->
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>