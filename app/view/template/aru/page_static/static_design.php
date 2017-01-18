<?php
    require_once(DIR_THEME.'/include/header.php');
?>
<style>
    <?php   require_once(DIR_THEME.'/include/kereses.css'); ?>
    <?php   require_once(DIR_THEME.'/include/livesearch.css'); ?>
</style>
<script>
    <?php   require_once(DIR_THEME.'/include/js/livesearch.js'); ?>
</script>
<body>
<main>  
    <div class="head_container">
        <!-- LOGO -->
        <div class="logo">
            <a href="<?php print URL; ?>">BioBody</a>
        </div>
        <!-- KERESÉS -->
        <div class="search">
            <form method="post" action="">
                <div class="input-group">
                    <input type="text" placeholder="Mit keresel?"  name="q" value=""/>
                    <div class="home_keres home_keres_gomb">
                        <button>&#128269; KERESÉS</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
<section class="zero-state full-width">
<article style="text-align:left; padding:20px;">

    <?php
        print $tpl['body_text'];
    ?>
</article>

</section></main>
<?php
    require_once(DIR_THEME.'/include/footer.php');
?>

</body>