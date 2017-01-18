<?php
    require_once('include/header.php');
?>
<style>
    <?php   require_once('include/kereses.css'); ?>
    <?php   require_once('include/livesearch.css'); ?>
</style>
<script>
    <?php   require_once('include/js/livesearch.js'); ?>
</script>
<body>
<main>  
    <?php   require_once('include/module_search.php'); ?>

   
<section class="zero-state full-width">

        <div class="grid" style="margin:30px;margin-top:0; padding:10%; padding-top:1%;">
            <h1 style="padding-top:0px; padding-bottom:0; font-size:80px;">Kategóriák</h1>
            <?php 
                //http://stackoverflow.com/questions/6509106/is-there-a-way-to-break-a-list-into-columns
                //http://jsfiddle.net/pdExf/
                if (isset($tpl['categories']) AND isset($tpl['subcategories'])){
                    foreach ($tpl['categories'] as $key => $value){
                        print '<h1 style="padding-top:40px; text-align:center;"><a href="'.URL.KERESES.$value['name_seo'].'">'.$value['name'].'</a></h1><div style="align:center;"><ul style="  -moz-column-count: 3;
  -moz-column-gap: 20px;
  -webkit-column-count: 5;
  -webkit-column-gap: 20px;
  column-count: 5;
  column-gap: 20px; text-align:left;list-style: none; width:80%;margin: 0 auto;">';
                        
                        foreach($tpl['subcategories'][$value['t1']] as $key_02 => $values_02){
                            print '<li><a href="'.URL.KERESES.$values_02['sname'].'">'.$values_02['cname'].'</a></li>';
                        }
                        print '</ul></div>';
                    }
                }
            ?>
        </div>
</section>
<?php
    require_once('include/footer.php');
?>
</main>
</body>


</div>
</body>
</html>