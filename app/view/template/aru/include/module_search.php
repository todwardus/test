    <div class="head_container">
        <!-- LOGO -->
        <div class="logo">
            <a href="<?php print URL; ?>">BioBody</a>
        </div>
        <!-- KERESÉS -->
        <div class="search">
            <form method="post" action="">
                <div class="input-group">
                    <input type="text" id="keyword" placeholder="Mit keresel?"  name="q" value="" autocomplete="off" onkeyup="showResult(this.value)"/>
                    <div id="livesearch"></div>
                    <div class="home_keres home_keres_gomb">
                        <button>&#128269; KERESÉS</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  