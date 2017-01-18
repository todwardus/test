<?php require_once(DIR_THEME.'/page_partner/partner_header.php'); ?>

<article style="padding-left:10px;">

<div class="card column twelve">
    <h1>Hagyományos boltok és átvételi pontok adatai</h1>


<table class="results">
      <tbody>
        <tr>
          <td width="50%">  <label><input type="radio" name="option1a" checked="checked">Hagyományos bolt</label>
  <label><input type="radio" name="option1a">Átvételi pont</label></td>
          <td>Hagyományos bolt, ha termék megvásárlása és átvétele lehetséges ezen a helyen, akár előzetes megrendelés nélkül is. A bolt készlettel rendelkezik. Átvételi pont, ha a termék kizárólag megrendelést követően vehető át ezen a helyen.</td>
        </tr>
        <tr>
          <td width="50%"><label>Megjelenítendő név </label><input type="text" value="<?php print $Partner->user['ceg_nev'];?>"/></td>
          <td>Cég hivatalos megnevezése. Számlázási név.</td>
        </tr>
        <tr>
          <td><label>Telefon</label><input type="text" value="<?php print $Partner->user['kap_nev'];?>"/></td>
          <td>Kapcsolattartó személy neve.</td>
        </tr>
        <tr>
          <td><label>Email</label><input type="text" value="<?php print $Partner->user['ceg_irsz'];?>"/></td>
          <td>Központi vagy ügyfélszolgálati email cím.</td>
        </tr>
        <tr>
          <td><label>Irányítószám</label><input type="text" value="<?php print $Partner->user['ceg_irsz'];?>"/></td>
          <td>Az irányítószám minimum 4 db számból állhat. Kötőjel, szóköz használata lehetséges.</td>
        </tr>
        <tr>
          <td><label>Város</label><input type="text" value="<?php print $Partner->user['ceg_city'];?>"/></td>
          <td>Város neve. </td>
        </tr>
        <tr>
          <td><label>Utca, házszám</label><input type="text" value="<?php print $Partner->user['ceg_cim'];?>"/></td>
          <td>Utca, házszám.</td>
        </tr>
        <tr>
          <td><label>Megjegyzés</label><input type="text" value="<?php print $Partner->user['ceg_tel'];?>"/></td>
          <td> </td>
        </tr>
      </tbody>
    </table>

<br><br>
<h2>Nyitvatartás</h2>
<table class="results">
      <tbody>
        <tr>
          <td width="50%"><label>Megjelenítendő név </label><input type="text" value="<?php print $Partner->user['ceg_nev'];?>"/></td>
          <td>Cég hivatalos megnevezése. Számlázási név.</td>
        </tr>
        <tr>
          <td><label>Telefon</label><input type="text" value="<?php print $Partner->user['kap_nev'];?>"/></td>
          <td>Kapcsolattartó személy neve.</td>
        </tr>
        <tr>
          <td><label>Email</label><input type="text" value="<?php print $Partner->user['ceg_irsz'];?>"/></td>
          <td>Központi vagy ügyfélszolgálati email cím.</td>
        </tr>
        <tr>
          <td><label>Irányítószám</label><input type="text" value="<?php print $Partner->user['ceg_irsz'];?>"/></td>
          <td>Az irányítószám minimum 4 db számból állhat. Kötőjel, szóköz használata lehetséges.</td>
        </tr>
        <tr>
          <td><label>Város</label><input type="text" value="<?php print $Partner->user['ceg_city'];?>"/></td>
          <td>Város neve. </td>
        </tr>
        <tr>
          <td><label>Utca, házszám</label><input type="text" value="<?php print $Partner->user['ceg_cim'];?>"/></td>
          <td>Utca, házszám.</td>
        </tr>
        <tr>
          <td><label>Megjegyzés</label><input type="text" value="<?php print $Partner->user['ceg_tel'];?>"/></td>
          <td> </td>
        </tr>
      </tbody>
    </table>

</div>
</article>
<?php require_once(DIR_THEME.'/page_partner/partner_footer.php'); ?>
