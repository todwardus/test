<?php require_once(DIR_THEME.'/page_partner/partner_header.php'); ?>

<article style="padding-left:10px;">

<div class="card column twelve">
<style>
    .alert{display:none;}
    #activated:target{display:block;}
</style>
<div class="alert success" id="activated"><dl><dt>Sikeres aktiválás!</dt><dd>Kérlek mutatkozz be, töltsd ki az alábbi mezőket:</dd></dl></div>

<h1>Fiók adatok</h1>
<label>Email</label><input type="text" value="<?php print $Partner->user['ceg_email'];?>" disabled="disabled" />
<br>
<h2>Számlázási- cégadatok</h2>
    <table class="results">
      <tbody>
        <tr>
          <td width="50%"><label>Cég neve</label><input type="text" value="<?php print $Partner->user['ceg_nev'];?>"/></td>
          <td>Cég hivatalos megnevezése. Számlázási név.</td>
        </tr>
        <tr>
          <td><label>Kapcsolattartó neve</label><input type="text" value="<?php print $Partner->user['kap_nev'];?>"/></td>
          <td>Kapcsolattartó személy neve.</td>
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
          <td><label>Telefon</label><input type="text" value="<?php print $Partner->user['ceg_tel'];?>"/></td>
          <td>Telefonszám. A mező minimum 6 számjegyből állhat, “-”, "," ".", "+", "()" és “/” karakterek használata elfogadott. Több telefonszám használata esetén, kérjük, ezeket veszővel válassza el, szóköz használata csak ebben az esetben elfogadott (vessző után). Pl. 20/123-45-67, 0036/1-234-5678. A telefonszám maximum 30 karakter hosszúságú lehet.</td>
        </tr>
        <tr>
          <td><label>Adószám</label><input type="text" value="<?php print $Partner->user['ceg_email'];?>"/></td>
          <td>Belföldi vállalkozás esetén az adószám (pl: 24868291-2-42), más EU székhelyű vállalkozás esetén közösségi adószám (pl. HU12345678), mező kitöltése kötelező.</td>
        </tr>
        <tr>
          <td><label>Cégjegyzékszám</label><input type="text" value="<?php print $Partner->user['ceg_email'];?>"/></td>
          <td> </td>
        </tr>

      </tbody>
    </table>
<br>

<h2>Levelezési cím (ha eltér a cégadatoktól)</h2>
    <table class="results">
      <tbody>
        <tr>
          <td width="50%"><label>Címzett neve</label><input type="text" value="<?php  $Partner->user['ceg_email'];?>"/></td>
          <td> </td>
        </tr>
        <tr>
          <td><label>Irányítószám</label><input type="text" value="<?php  $Partner->user['ceg_email'];?>"/></td>
          <td>Az irányítószám minimum 4 db számból állhat.</td>
        </tr>
        <tr>
          <td><label>Város</label><input type="text" value="<?php  $Partner->user['ceg_email'];?>"/></td>
          <td>Város neve</td>
        </tr>
        <tr>
          <td><label>Utca, házszám</label><input type="text" value="<?php  $Partner->user['ceg_email'];?>"/></td>
          <td>Utca, házszám.</td>
        </tr>
      </tbody>
    </table>


<h2>Jelszó váltás</h2>
    <table class="results">
      <tbody>
        <tr>
          <td width="50%"><label>Jelszó</label><input type="password" value="<?php print $Partner->user['ceg_password2'];?>"/></td>
          <td> </td>
        </tr>
        <tr>
          <td><label>Új jelszó</label><input type="password" value="<?php  $Partner->user['ceg_password2'];?>"/></td>
          <td> </td>
        </tr>
        <tr>
          <td><label>Jelszó újra</label><input type="password" value="<?php  $Partner->user['ceg_password2'];?>"/></td>
          <td>.</td>
        </tr>
      </tbody>
    </table>
<br>
<br>
<br>
<div style="text-align:center;">
    <input type="submit" class="button" value="Változtatások elmentése">
</div>


</div>
</article>
<?php require_once(DIR_THEME.'/page_partner/partner_footer.php'); ?>