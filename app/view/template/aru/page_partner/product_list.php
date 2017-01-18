<?php require_once(DIR_THEME.'/page_partner/partner_header.php'); ?>

<article style="padding-left:10px;">

<div class="card column twelve">
    <?php if (isset($_GET['error']) AND isset($Partner->error[$_GET['error']])){ ?>
    <div class="alert error"    id="<?php @ print $_GET['error'];?>"><dl><dt><?php print $Partner->error[$_GET['error']]; ?></dd></dl></div>
    <?php }?>
<h1>Megjelenő termékek</h1>

<!-- Feed url -->
<div class="card column four" style="padding:20px;">
    <form action="<?php print URL.'Partner/Productlist/'; ?>" method="POST">
    <label><span class="highlight-warning">Terméklistád forrása:</span></label>
    <input type="text" name="feed_url" value="<?php if(isset($Partner->user['feed_url'])){print $Partner->user['feed_url'];} ?>" />
    <!--Utolsó lekérdezés: <?php print date('Y.m.d. H:i:s', time()); ?>-->
    <br><input type="submit" class="button" value="Frissítés">
    </form>
</div>
<div class=" column eight">
    <table class="results" style="    width: 90%;margin: 0 auto;">
      <tbody>
        <tr>
          <td>Felismert termékek száma:</td>
          <td><span class="highlight-warning"><?php print (isset($Partner->feed_stat['all']) ? $Partner->feed_stat['all'] : null);?></span></td>
        </tr>
        <tr>
          <td>Listázásban megjelenő termékek száma:</td>
          <td><span class="highlight-warning"><?php print (isset($Partner->feed_stat['all']) ? $Partner->feed_stat['categorized'] : null);?></span></td>
        </tr>
        <tr>
          <td>Keresésben megjelenő termékek száma:</td>
          <td><span class="highlight-warning"><?php print (isset($Partner->feed_stat['all']) ? $Partner->feed_stat['in_search'] : null);?></span></td>
        </tr>
      </tbody>
    </table>
</div> 

<div class="card column twelve" style="background-color: #fffbe9;">
<h1 display:block;>Minta a megjelenített termékekből</h1>

<div class="product_list" style="overflow: auto; height:300px; width:100%;  position:relative; ">
<table class="results" style="position:absolute;" >
  <thead>
    <tr>
      <th>identifier</th>
      <th>name</th>
      <th>price</th>
      <th>net_price</th>
      <th>product_url</th>
      <th>ean_code</th>
      <th>manufacturer</th>
      <th>category</th>
      <th>image_url</th>
      <th>image_url_2</th>
      <th>image_url_3</th>
      <th>description</th>
      <th>delivery_cost</th>
      <th>delivery_time</th>
    </tr>
  </thead>
  <tbody>
<?php
if (is_array($Partner->feed_list)){
foreach($Partner->feed_list as $key => $value){
    print '
    <tr>
      <td>'.(isset($value['identifier']) ? $value['identifier'] : '&nbsp;').'</td>
      <td>'.(isset($value['name']) ? $value['name'] : '&nbsp;').'</td>
      <td>'.(isset($value['price']) ? $value['price'] : '&nbsp;').'</td>
      <td>'.(isset($value['net_price']) ? $value['net_price'] : '&nbsp;').'</td>
      <td>'.(isset($value['link']) ? $value['link'] : '&nbsp;').'</td>
      <td>'.(isset($value['vk']) ? $value['vk'] : '&nbsp;').'</td>
      <td>'.(isset($value['manufacturer']) ? $value['manufacturer'] : '&nbsp;').'</td>
      <td>'.(isset($value['category']) ? $value['category'] : '&nbsp;').'</td>
      <td>'.(isset($value['image_url']) ? $value['image_url'] : '&nbsp;').'</td>
      <td>'.(isset($value['image_url_2']) ? $value['image_url_2'] : '&nbsp;').'</td>
      <td>'.(isset($value['image_url_3']) ? $value['image_url_3'] : '&nbsp;').'</td>
      <td>'.(isset($value['body']) ? '(A leírás: '.strlen($value['body']).'byte hosszú)' : '&nbsp;').'</td>
      <td>'.(isset($value['delivery_cost']) ? $value['delivery_cost'] : '&nbsp;').'</td>
      <td>'.(isset($value['delivery_time']) ? $value['delivery_time'] : '&nbsp;').'</td>
    </tr>';
}
}else{
    
}
?>
  </tbody>
</table>
</div>
</div>




<div class="card column twelve  gyik">
<br><br>
    <h1>Terméklista feltöltés egyszerűen</h1>

    <h3>File-formátumok: <span class="tag red">CSV</span> vagy <span class="tag yellow">XML</span></h3>

    
    <h3><span class="tag red">CSV</span> példa:</h3>
    A feltöltéshez használhat vesszővel, pontos vesszővel vagy tabulátorral tagolt állományt. Az első sor a mezők nevét, minden további sor egy adott termék adatait tartalmazza. Elválasztó karakter az adatmezőkben csak akkor szerepelhet, ha az adott mező idézőjelek között szerepel. Ilyen esetben a mezőben szereplő idézőjeleket "escapelni" kell, rendszerünk a duplázás (""xy"") és backslash () megoldásokat is támogatja. A CSV-hez hasonlóan a TSV esetében az adatmezőkben lévő tabok (t) szóközre (space) cserélhetőek, ezért a TSV formátum gyakorlatba átvitele egyszerűbb. Például a php nyelv "fputcsv" függvénye, a fentieknek megfelelően működik.
<textarea rows="3" readonly="" onclick="this.select();">identifier,name,price,net_price,product_url,ean_code,image_url
"5161655","Termék neve","1990","1453","http://example.com/products.php?id=5161655", "5994567891234", "http://example.com/images/picture.jpg"</textarea>
<br><br>

    <h3><span class="tag yellow">XML</span> példa:</h3>
    Létrehozható az adatállomány XML formátumban is, amelyben a <products> és </products> tagek között kell, hogy legyen az összes termék, egy adott termék információit pedig <product> és </product> tagek közé kell csoportosítani.
<textarea rows="9" readonly="" onclick="this.select();">&lt;?xml version="1.0" encoding="UTF-8" ?&gt;
&lt;products&gt;
	&lt;product&gt;
            <identifier>5161655</identifier>
            <name>Termék neve</name>
            <price>1990</price>
            <net_price>1453</net_price>
            <product_url>http://example.com/products.php?id=5161655</product_url>
            <ean_code>5994567891234</ean_code>
            <image_url>http://example.com/images/picture.jpg</image_url>
	&lt;/product&gt;
	...
&lt;/products&gt;</textarea>

<br><br>
<h2>Kötelező mezők</h2>
<table>
  <tbody>
    <tr>
      <td><span class="highlight-warning">identifier</span></td>
      <td>Egyedi termékazonosító. (Webshop által használt egyedi azonosító, amelynek értéke változatlan).</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">name</span></td>
      <td>Termék megnevezése. Nagy kezdőbetűvel, további nagybetűk használata csak indokolt esetben (pl.: mozaikszó). A névnek a teljes (gyártó által használt) megnevezését tartalmaznia kell. A termék neve reklámot nem tartalmazhat, csak a termék, csatolt termékek megnevezését.</td>
    </tr>
      <td><span class="highlight-warning">price</span></td>
      <td>A termék bruttó ára. (Áfá-t tartalmazó ár!)</td>
    </tr>
    </tr>
      <td><span class="highlight-warning">net_price</span></td>
      <td>A termék nettó ára. (Áfá-t nem tartalmazó ár!)</td>
    </tr>
    </tr>
      <td><span class="highlight-warning">product_url</span></td>
      <td>A termék egyedi oldalára mutató link (URL). Példa: http://www.example.com/products.php?id=45884</td>
    </tr>
  </tbody>
</table>
<br><br>
<h2>Ajánlott mezők</h2>
<table>
  <tbody>
    <tr>
      <td><span class="highlight-warning">ean_code</span></td>
      <td>Min. 8 - max. 13 számjegyű gyártó által adott termékazonosító; egyedinek kell lennie. (European Article Number)</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">manufacturer</span></td>
      <td>Termék gyártójának megnevezése. Opcionálisan adható a terméknév elején is, a name mezőben. Példa: Sony</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">category</span></td>
      <td>A termékkategória besorolása az Ön nyilvántartásában. Beszédes, hierarchikus felépítésű kategóriákat tudunk feldolgozni. Példa: Műszaki cikkek > Szórakoztató elektronika > DVD-lejátszók</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">image_url</span></td>
      <td>A termék fényképére mutató link (URL). Amennyiben több méretben is elérhető egy kép, a legjobb minőségűre mutató linket érdemes megadni. A minimális méret, amit meg tudunk jeleníteni, 150x150 pixel. Kérjük, tényleges termékképet adjon meg, "hamarosan feltöltjük" feliratú kép vagy céglogó hibás. Példa: http://www.example.com/images/45884.jpg</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">image_url_2</span></td>
      <td>A termék fényképére mutató link (URL). Több kép esetén lehetősége van azokat megjeleníteni egy adott terméknél. Példa: http://www.example.com/images/45885.jpg</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">image_url_3</span></td>
      <td>A termék fényképére mutató link (URL). Több kép esetén lehetősége van azokat megjeleníteni egy adott terméknél. Példa: http://www.example.com/images/45885.jpg</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">description</span></td>
      <td>A termék szabadszavas leírása, amely az áru fontos paramétereit tartalmazza, hogy a leendő vevő pontosan tájékozódhasson.</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">delivery_cost</span></td>
      <td>A termék házhoz szállítási költsége országon belül. Amennyiben a termék szállítási költsége országszerte súlytól és a termék árától függetlenül ingyenes, a helyes formátumok: FREE; ingyenes; ingyen; ingyenesen. Amennyiben a termék szállítási költsége országszerte súlytól és a termék árától függetlenül meg van határozva, pl. 700,- Ft. (ÁFÁ-t tartalmazó összeg) , helyes formátumok a következők: 700; 700 Ft</td>
    </tr>
    <tr>
      <td><span class="highlight-warning">delivery_time	</span></td>
      <td>A termék szállítási ideje. A megrendelés napjától számítva (országosan) ennyi munkanap alatt kerül kiszállításra az adott termék. Helyes formátumok: 2; 2 nap; 2 munkanap. Helytelen formátumok: 1 hét; 2-4 nap. Azonnal (vagy a következő munkanapon) szállítható termék esetében a helyes formátum: 1; 1 nap; 1 munkanap. Amennyiben a termék nem rendelhető, kérjük a mezőben “NO” kifejezést adjon meg. A megadott információk az alábbiak szerint kerülnek megjelenítésre: "raktáron", "3 napon belül", "egy héten belül", "két héten belül", "több mint két hét".Ezt az adatot csak abban az esetben áll módunkban megjeleníteni, amennyiben az információ az Ön kapcsolódó termékoldalán is megtalálható. Több ajánlatot tartalmazó termékoldalak esetében az információnak egyértelműen beazonosíthatónak kell lennie, hogy mely ajánlatra vonatkozik.</td>
    </tr>
  </tbody>
</table>





</div>











</div>
</article>

<style>
    .gyik p {font-size:16px; padding-bottom:20px;}
    .gyik h3{margin-bottom:5px;}
    .gyik .highlight-warning{font-size:18px;}

    .highlight-warning{font-size:24px;}
    .results{font-size:16px;}
    .product_list .results th {font-size:16px;background: #fffbe9;color: #e85b0f;}
    .product_list .results tr:nth-child(even):hover {background-color:lightblue;}


</style>
<?php require_once(DIR_THEME.'/page_partner/partner_footer.php'); ?>