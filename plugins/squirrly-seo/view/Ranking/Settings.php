<?php defined('ABSPATH') || die('Cheatin\' uh?'); ?>
<div id="sq_wrap">
    <?php SQ_Classes_ObjController::getClass('SQ_Core_BlockToolbar')->init(); ?>
    <?php do_action('sq_notices'); ?>
    <div class="d-flex flex-row my-0 bg-white" style="clear: both !important;">
        <?php
        if (!current_user_can('sq_manage_focuspages')) {
            echo '<div class="col-12 alert alert-success text-center m-0 p-3">'. esc_html__("You do not have permission to access this page. You need Squirrly SEO Admin role.", _SQ_PLUGIN_NAME_).'</div>';
            return;
        }
        ?>
        <?php echo SQ_Classes_ObjController::getClass('SQ_Models_Menu')->getAdminTabs(SQ_Classes_Helpers_Tools::getValue('tab'), 'sq_rankings'); ?>
        <div class="d-flex flex-row flex-nowrap flex-grow-1 bg-white px-1 m-0">
            <div class="flex-grow-1 px-1 sq_flex">
                <div class="form-group my-4 col-10 offset-1">
                    <?php echo $view->getView('Connect/GoogleAnalytics'); ?>
                    <?php echo $view->getView('Connect/GoogleSearchConsole'); ?>
                </div>
                <form method="POST">
                    <?php do_action('sq_form_notices'); ?>
                    <?php SQ_Classes_Helpers_Tools::setNonce('sq_ranking_settings', 'sq_nonce'); ?>
                    <input type="hidden" name="action" value="sq_ranking_settings"/>

                    <div class="card col-12 p-0">
                        <div class="card-body p-0 m-0 bg-title rounded-top  row">
                            <div class="card-body p-2 bg-title rounded-top">
                                <div class="sq_icons_content p-3 py-4">
                                    <div class="sq_icons sq_settings_icon m-2"></div>
                                </div>
                                <h3 class="card-title py-4"><?php echo esc_html__("Rankings Settings", _SQ_PLUGIN_NAME_); ?>
                                    <div class="sq_help_question d-inline">
                                        <a href="https://howto.squirrly.co/kb/ranking-serp-checker/#ranking_settings" target="_blank"><i class="fa fa-question-circle m-0 p-0"></i></a>
                                    </div>
                                </h3>
                                <div class="card-title-description m-2"></div>
                            </div>
                        </div>
                        <div id="sq_seosettings" class="card col-12 p-0 m-0 border-0 tab-panel border-0">
                            <div class="card-body p-0">
                                <div class="col-12 m-0 p-0">
                                    <div class="card col-12 p-0 border-0 ">

                                        <div class="col-12 pt-0 pb-4 border-bottom tab-panel">


                                            <div class="col-12 row py-2 mx-0 my-3">
                                                <div class="col-4 p-1 pr-3">
                                                    <div class="font-weight-bold"><?php echo esc_html__("Google Country", _SQ_PLUGIN_NAME_); ?>:</div>
                                                    <div class="small text-black-50"><?php echo esc_html__("Select the Country for which Squirrly will check the Google rank.", _SQ_PLUGIN_NAME_); ?></div>
                                                </div>
                                                <div class="col-8 p-0 input-group">
                                                    <select name="sq_google_country" class="form-control bg-input mb-1">
                                                        <option value="com"><?php echo esc_html__("Default", _SQ_PLUGIN_NAME_); ?> - Google.com (http://www.google.com/)</option>
                                                        <option value="as"><?php echo "American Samoa"; ?> (http://www.google.as/)</option>
                                                        <option value="off.ai"><?php echo "Anguilla"; ?> (http://www.google.off.ai/)</option>
                                                        <option value="com.ag"><?php echo "Antigua and Barbuda"; ?> (http://www.google.com.ag/)</option>
                                                        <option value="com.ar"><?php echo "Argentina"; ?> (http://www.google.com.ar/)</option>
                                                        <option value="com.au"><?php echo "Australia"; ?> (http://www.google.com.au/)</option>
                                                        <option value="at"><?php echo "Austria"; ?> (http://www.google.at/)</option>
                                                        <option value="az"><?php echo "Azerbaijan"; ?> (http://www.google.az/)</option>
                                                        <option value="be"><?php echo "Belgium"; ?> (http://www.google.be/)</option>
                                                        <option value="com.br"><?php echo "Brazil"; ?> (http://www.google.com.br/)</option>
                                                        <option value="vg"><?php echo "British Virgin Islands"; ?> (http://www.google.vg/)</option>
                                                        <option value="bi"><?php echo "Burundi"; ?> (http://www.google.bi/)</option>
                                                        <option value="bg"><?php echo "Bulgaria"; ?> (http://www.google.bg/)</option>
                                                        <option value="ca"><?php echo "Canada"; ?> (http://www.google.ca/)</option>
                                                        <option value="td"><?php echo "Chad"; ?> (http://www.google.td/)</option>
                                                        <option value="cl"><?php echo "Chile"; ?> (http://www.google.cl/)</option>
                                                        <option value="com.co"><?php echo "Colombia"; ?> (http://www.google.com.co/)</option>
                                                        <option value="co.cr"><?php echo "Costa Rica"; ?> (http://www.google.co.cr/)</option>
                                                        <option value="ci"><?php echo "Côte d\'Ivoire"; ?> (http://www.google.ci/)</option>
                                                        <option value="com.cu"><?php echo "Cuba"; ?> (http://www.google.com.cu/)</option>
                                                        <option value="cz"><?php echo "Czech Republic"; ?> (http://www.google.cz/)</option>
                                                        <option value="cd"><?php echo "Dem. Rep. of the Congo"; ?> (http://www.google.cd/)</option>
                                                        <option value="dk"><?php echo "Denmark"; ?> (http://www.google.dk/)</option>
                                                        <option value="dj"><?php echo "Djibouti"; ?> (http://www.google.dj/)</option>
                                                        <option value="com.do"><?php echo "Dominican Republic"; ?> (http://www.google.com.do/)</option>
                                                        <option value="com.ec"><?php echo "Ecuador"; ?> (http://www.google.com.ec/)</option>
                                                        <option value="com.eg"><?php echo "Egypt"; ?> (http://www.google.com.eg/)</option>
                                                        <option value="com.sv"><?php echo "El Salvador"; ?> (http://www.google.com.sv/)</option>
                                                        <option value="ee"><?php echo "Estonia"; ?> (http://www.google.ee/)</option>
                                                        <option value="fm"><?php echo "Federated States of Micronesia"; ?> (http://www.google.fm/)</option>
                                                        <option value="com.fj"><?php echo "Fiji"; ?> (http://www.google.com.fj/)</option>
                                                        <option value="fi"><?php echo "Finland"; ?> (http://www.google.fi/)</option>
                                                        <option value="fr"><?php echo "France"; ?> (http://www.google.fr/)</option>
                                                        <option value="gm"><?php echo "The Gambia"; ?> (http://www.google.gm/)</option>
                                                        <option value="ge"><?php echo "Georgia"; ?> (http://www.google.ge/)</option>
                                                        <option value="de"><?php echo "Germany"; ?> (http://www.google.de/)</option>
                                                        <option value="com.gh"><?php echo "Ghana "; ?> (http://www.google.com.gh/)</option>
                                                        <option value="com.gi"><?php echo "Gibraltar"; ?> (http://www.google.com.gi/)</option>
                                                        <option value="com.gr"><?php echo "Greece"; ?> (http://www.google.com.gr/)</option>
                                                        <option value="gl"><?php echo "Greenland"; ?> (http://www.google.gl/)</option>
                                                        <option value="gg"><?php echo "Guernsey"; ?> (http://www.google.gg/)</option>
                                                        <option value="hn"><?php echo "Honduras"; ?> (http://www.google.hn/)</option>
                                                        <option value="com.hk"><?php echo "Hong Kong"; ?> (http://www.google.com.hk/)</option>
                                                        <option value="co.hu"><?php echo "Hungary"; ?> (http://www.google.co.hu/)</option>
                                                        <option value="co.in"><?php echo "India"; ?> (http://www.google.co.in/)</option>
                                                        <option value="co.id"><?php echo "Indonesia"; ?> (http://www.google.co.id/)</option>
                                                        <option value="ie"><?php echo "Ireland"; ?> (http://www.google.ie/)</option>
                                                        <option value="co.im"><?php echo "Isle of Man"; ?> (http://www.google.co.im/)</option>
                                                        <option value="co.il"><?php echo "Israel"; ?> (http://www.google.co.il/)</option>
                                                        <option value="it"><?php echo "Italy"; ?> (http://www.google.it/)</option>
                                                        <option value="com.jm"><?php echo "Jamaica"; ?> (http://www.google.com.jm/)</option>
                                                        <option value="co.jp"><?php echo "Japan"; ?> (http://www.google.co.jp/)</option>
                                                        <option value="co.je"><?php echo "Jersey"; ?> (http://www.google.co.je/)</option>
                                                        <option value="kz"><?php echo "Kazakhstan"; ?> (http://www.google.kz/)</option>
                                                        <option value="co.kr"><?php echo "Korea"; ?> (http://www.google.co.kr/)</option>
                                                        <option value="lv"><?php echo "Latvia"; ?> (http://www.google.lv/)</option>
                                                        <option value="co.ls"><?php echo "Lesotho"; ?> (http://www.google.co.ls/)</option>
                                                        <option value="li"><?php echo "Liechtenstein"; ?> (http://www.google.li/)</option>
                                                        <option value="lt"><?php echo "Lithuania"; ?> (http://www.google.lt/)</option>
                                                        <option value="lu"><?php echo "Luxembourg"; ?> (http://www.google.lu/)</option>
                                                        <option value="mw"><?php echo "Malawi"; ?> (http://www.google.mw/)</option>
                                                        <option value="com.my"><?php echo "Malaysia"; ?> (http://www.google.com.my/)</option>
                                                        <option value="com.mt"><?php echo "Malta"; ?> (http://www.google.com.mt/)</option>
                                                        <option value="mu"><?php echo "Mauritius"; ?> (http://www.google.mu/)</option>
                                                        <option value="com.mx"><?php echo "México"; ?> (http://www.google.com.mx/)</option>
                                                        <option value="ms"><?php echo "Montserrat"; ?> (http://www.google.ms/)</option>
                                                        <option value="com.na"><?php echo "Namibia"; ?> (http://www.google.com.na/)</option>
                                                        <option value="com.np"><?php echo "Nepal"; ?> (http://www.google.com.np/)</option>
                                                        <option value="nl"><?php echo "Netherlands"; ?> (http://www.google.nl/)</option>
                                                        <option value="co.nz"><?php echo "New Zealand"; ?> (http://www.google.co.nz/)</option>
                                                        <option value="com.ni"><?php echo "Nicaragua"; ?> (http://www.google.com.ni/)</option>
                                                        <option value="com.ng"><?php echo "Nigeria"; ?> (http://www.google.com.ng/)</option>
                                                        <option value="com.nf"><?php echo "Norfolk Island"; ?> (http://www.google.com.nf/)</option>
                                                        <option value="no"><?php echo "Norway"; ?> (http://www.google.no/)</option>
                                                        <option value="com.pk"><?php echo "Pakistan"; ?> (http://www.google.com.pk/)</option>
                                                        <option value="com.pa"><?php echo "Panamá"; ?> (http://www.google.com.pa/)</option>
                                                        <option value="com.py"><?php echo "Paraguay"; ?> (http://www.google.com.py/)</option>
                                                        <option value="com.pe"><?php echo "Perú"; ?> (http://www.google.com.pe/)</option>
                                                        <option value="com.ph"><?php echo "Philippines"; ?> (http://www.google.com.ph/)</option>
                                                        <option value="pn"><?php echo "Pitcairn Islands"; ?> (http://www.google.pn/)</option>
                                                        <option value="pl"><?php echo "Poland"; ?> (http://www.google.pl/)</option>
                                                        <option value="pt"><?php echo "Portugal"; ?> (http://www.google.pt/)</option>
                                                        <option value="com.pr"><?php echo "Puerto Rico"; ?> (http://www.google.com.pr/)</option>
                                                        <option value="cg"><?php echo "Rep. of the Congo"; ?> (http://www.google.cg/)</option>
                                                        <option value="ro"><?php echo "Romania"; ?> (http://www.google.ro/)</option>
                                                        <option value="ru"><?php echo "Russia"; ?> (http://www.google.ru/)</option>
                                                        <option value="rw"><?php echo "Rwanda"; ?> (http://www.google.rw/)</option>
                                                        <option value="sh"><?php echo "Saint Helena"; ?> (http://www.google.sh/)</option>
                                                        <option value="sm"><?php echo "San Marino"; ?> (http://www.google.sm/)</option>
                                                        <option value="com.sa"><?php echo "Saudi Arabia"; ?> (http://www.google.com.sa/)</option>
                                                        <option value="com.sg"><?php echo "Singapore"; ?> (http://www.google.com.sg/)</option>
                                                        <option value="sk"><?php echo "Slovakia"; ?> (http://www.google.sk/)</option>
                                                        <option value="co.za"><?php echo "South Africa"; ?> (http://www.google.co.za/)</option>
                                                        <option value="es"><?php echo "Spain"; ?> (http://www.google.es/)</option>
                                                        <option value="lk"><?php echo "Sri Lanka"; ?> (http://www.google.lk/)</option>
                                                        <option value="se"><?php echo "Sweden"; ?> (http://www.google.se/)</option>
                                                        <option value="ch"><?php echo "Switzerland"; ?> (http://www.google.ch/)</option>
                                                        <option value="com.tw"><?php echo "Taiwan"; ?> (http://www.google.com.tw/)</option>
                                                        <option value="co.th"><?php echo "Thailand"; ?> (http://www.google.co.th/)</option>
                                                        <option value="tt"><?php echo "Trinidad and Tobago"; ?> (http://www.google.tt/)</option>
                                                        <option value="com.tr"><?php echo "Turkey"; ?> (http://www.google.com.tr/)</option>
                                                        <option value="com.ua"><?php echo "Ukraine"; ?> (http://www.google.com.ua/)</option>
                                                        <option value="ae"><?php echo "United Arab Emirates"; ?> (http://www.google.ae/)</option>
                                                        <option value="co.uk"><?php echo "United Kingdom"; ?> (http://www.google.co.uk/)</option>
                                                        <option value="us"><?php echo "United States"; ?> (http://www.google.us/)</option>
                                                        <option value="com.uy"><?php echo "Uruguay"; ?> (http://www.google.com.uy/)</option>
                                                        <option value="uz"><?php echo "Uzbekistan"; ?> (http://www.google.uz/)</option>
                                                        <option value="vu"><?php echo "Vanuatu"; ?> (http://www.google.vu/)</option>
                                                        <option value="co.ve"><?php echo "Venezuela"; ?> (http://www.google.co.ve/)</option>
                                                        <option value="com.vn"><?php echo "Vietnam"; ?> (http://www.google.com.vn/)</option>
                                                    </select>
                                                    <script>jQuery('select[name=sq_google_country]').val('<?php echo SQ_Classes_Helpers_Tools::getOption('sq_google_country')?>').attr('selected', true);</script>

                                                </div>
                                            </div>

                                            <div class="col-12 row py-2 mx-0 my-3">
                                                <div class="col-4 p-1 pr-3">
                                                    <div class="font-weight-bold"><?php echo esc_html__("Google Language", _SQ_PLUGIN_NAME_); ?>:</div>
                                                    <div class="small text-black-50"><?php echo esc_html__("Select the Language for which Squirrly will check the Google rank.", _SQ_PLUGIN_NAME_); ?></div>
                                                </div>
                                                <div class="col-8 p-0 input-group">
                                                    <select name="sq_google_language" class="form-control bg-input mb-1">
                                                        <option value="af">Afrikaans</option>
                                                        <option value="sq">Albanian - shqip</option>
                                                        <option value="am">Amharic - አማርኛ</option>
                                                        <option value="ar">Arabic - العربية</option>
                                                        <option value="an">Aragonese - aragonés</option>
                                                        <option value="hy">Armenian - հայերեն</option>
                                                        <option value="ast">Asturian - asturianu</option>
                                                        <option value="az">Azerbaijani - azərbaycan dili</option>
                                                        <option value="eu">Basque - euskara</option>
                                                        <option value="be">Belarusian - беларуская</option>
                                                        <option value="bn">Bengali - বাংলা</option>
                                                        <option value="bs">Bosnian - bosanski</option>
                                                        <option value="br">Breton - brezhoneg</option>
                                                        <option value="bg">Bulgarian - български</option>
                                                        <option value="ca">Catalan - català</option>
                                                        <option value="ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                                                        <option value="zh">Chinese - 中文</option>
                                                        <option value="zh_HK">Chinese (Hong Kong) - 中文（香港）</option>
                                                        <option value="zh_CN">Chinese (Simplified) - 中文（简体）</option>
                                                        <option value="zh_TW">Chinese (Traditional) - 中文（繁體）</option>
                                                        <option value="co">Corsican</option>
                                                        <option value="hr">Croatian - hrvatski</option>
                                                        <option value="cs">Czech - čeština</option>
                                                        <option value="da">Danish - dansk</option>
                                                        <option value="nl">Dutch - Nederlands</option>
                                                        <option value="en">English</option>
                                                        <option value="en_AU">English (Australia)</option>
                                                        <option value="en_CA">English (Canada)</option>
                                                        <option value="en_IN">English (India)</option>
                                                        <option value="en_NZ">English (New Zealand)</option>
                                                        <option value="en_ZA">English (South Africa)</option>
                                                        <option value="en_GB">English (United Kingdom)</option>
                                                        <option value="en_US">English (United States)</option>
                                                        <option value="eo">Esperanto - esperanto</option>
                                                        <option value="et">Estonian - eesti</option>
                                                        <option value="fo">Faroese - føroyskt</option>
                                                        <option value="fil">Filipino</option>
                                                        <option value="fi">Finnish - suomi</option>
                                                        <option value="fr">French - français</option>
                                                        <option value="fr_CA">French (Canada) - français (Canada)</option>
                                                        <option value="fr_FR">French (France) - français (France)</option>
                                                        <option value="fr_CH">French (Switzerland) - français (Suisse)</option>
                                                        <option value="gl">Galician - galego</option>
                                                        <option value="ka">Georgian - ქართული</option>
                                                        <option value="de">German - Deutsch</option>
                                                        <option value="de_AT">German (Austria) - Deutsch (Österreich)</option>
                                                        <option value="de_DE">German (Germany) - Deutsch (Deutschland)</option>
                                                        <option value="de_LI">German (Liechtenstein) - Deutsch (Liechtenstein)</option>
                                                        <option value="de_CH">German (Switzerland) - Deutsch (Schweiz)</option>
                                                        <option value="el">Greek - Ελληνικά</option>
                                                        <option value="gn">Guarani</option>
                                                        <option value="gu">Gujarati - ગુજરાતી</option>
                                                        <option value="ha">Hausa</option>
                                                        <option value="haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
                                                        <option value="he">Hebrew - עברית</option>
                                                        <option value="hi">Hindi - हिन्दी</option>
                                                        <option value="hu">Hungarian - magyar</option>
                                                        <option value="is">Icelandic - íslenska</option>
                                                        <option value="id">Indonesian - Indonesia</option>
                                                        <option value="ia">Interlingua</option>
                                                        <option value="ga">Irish - Gaeilge</option>
                                                        <option value="it">Italian - italiano</option>
                                                        <option value="it_IT">Italian (Italy) - italiano (Italia)</option>
                                                        <option value="it_CH">Italian (Switzerland) - italiano (Svizzera)</option>
                                                        <option value="ja">Japanese - 日本語</option>
                                                        <option value="kn">Kannada - ಕನ್ನಡ</option>
                                                        <option value="kk">Kazakh - қазақ тілі</option>
                                                        <option value="km">Khmer - ខ្មែរ</option>
                                                        <option value="ko">Korean - 한국어</option>
                                                        <option value="ku">Kurdish - Kurdî</option>
                                                        <option value="ky">Kyrgyz - кыргызча</option>
                                                        <option value="lo">Lao - ລາວ</option>
                                                        <option value="la">Latin</option>
                                                        <option value="lv">Latvian - latviešu</option>
                                                        <option value="ln">Lingala - lingála</option>
                                                        <option value="lt">Lithuanian - lietuvių</option>
                                                        <option value="mk">Macedonian - македонски</option>
                                                        <option value="ms">Malay - Bahasa Melayu</option>
                                                        <option value="ml">Malayalam - മലയാളം</option>
                                                        <option value="mt">Maltese - Malti</option>
                                                        <option value="mr">Marathi - मराठी</option>
                                                        <option value="mn">Mongolian - монгол</option>
                                                        <option value="ne">Nepali - नेपाली</option>
                                                        <option value="no">Norwegian - norsk</option>
                                                        <option value="nb">Norwegian Bokmål - norsk bokmål</option>
                                                        <option value="nn">Norwegian Nynorsk - nynorsk</option>
                                                        <option value="oc">Occitan</option>
                                                        <option value="or">Oriya - ଓଡ଼ିଆ</option>
                                                        <option value="om">Oromo - Oromoo</option>
                                                        <option value="ps">Pashto - پښتو</option>
                                                        <option value="fa">Persian - فارسی</option>
                                                        <option value="pl">Polish - polski</option>
                                                        <option value="pt">Portuguese - português</option>
                                                        <option value="pt_BR">Portuguese (Brazil) - português (Brasil)</option>
                                                        <option value="pt_PT">Portuguese (Portugal) - português (Portugal)</option>
                                                        <option value="pa">Punjabi - ਪੰਜਾਬੀ</option>
                                                        <option value="qu">Quechua</option>
                                                        <option value="ro">Romanian - română</option>
                                                        <option value="mo">Romanian (Moldova) - română (Moldova)</option>
                                                        <option value="rm">Romansh - rumantsch</option>
                                                        <option value="ru">Russian - русский</option>
                                                        <option value="gd">Scottish Gaelic</option>
                                                        <option value="sr">Serbian - српски</option>
                                                        <option value="sh">Serbo-Croatian - Srpskohrvatski</option>
                                                        <option value="sn">Shona - chiShona</option>
                                                        <option value="sd">Sindhi</option>
                                                        <option value="si">Sinhala - සිංහල</option>
                                                        <option value="sk">Slovak - slovenčina</option>
                                                        <option value="sl">Slovenian - slovenščina</option>
                                                        <option value="so">Somali - Soomaali</option>
                                                        <option value="st">Southern Sotho</option>
                                                        <option value="es">Spanish - español</option>
                                                        <option value="es_AR">Spanish (Argentina) - español (Argentina)</option>
                                                        <option value="es_419">Spanish (Latin America) - español (Latinoamérica)</option>
                                                        <option value="es_MX">Spanish (Mexico) - español (México)</option>
                                                        <option value="es_ES">Spanish (Spain) - español (España)</option>
                                                        <option value="es_US">Spanish (United States) - español (Estados Unidos)</option>
                                                        <option value="su">Sundanese</option>
                                                        <option value="sw">Swahili - Kiswahili</option>
                                                        <option value="sv">Swedish - svenska</option>
                                                        <option value="tg">Tajik - тоҷикӣ</option>
                                                        <option value="ta">Tamil - தமிழ்</option>
                                                        <option value="tt">Tatar</option>
                                                        <option value="te">Telugu - తెలుగు</option>
                                                        <option value="th">Thai - ไทย</option>
                                                        <option value="ti">Tigrinya - ትግርኛ</option>
                                                        <option value="to">Tongan - lea fakatonga</option>
                                                        <option value="tr">Turkish - Türkçe</option>
                                                        <option value="tk">Turkmen</option>
                                                        <option value="tw">Twi</option>
                                                        <option value="uk">Ukrainian - українська</option>
                                                        <option value="ur">Urdu - اردو</option>
                                                        <option value="ug">Uyghur</option>
                                                        <option value="uz">Uzbek - o‘zbek</option>
                                                        <option value="vi">Vietnamese - Tiếng Việt</option>
                                                        <option value="wa">Walloon - wa</option>
                                                        <option value="cy">Welsh - Cymraeg</option>
                                                        <option value="fy">Western Frisian</option>
                                                        <option value="xh">Xhosa</option>
                                                        <option value="yi">Yiddish</option>
                                                        <option value="yo">Yoruba - Èdè Yorùbá</option>
                                                        <option value="zu">Zulu - isiZulu</option>
                                                    </select>
                                                    <script>jQuery('select[name=sq_google_language]').val('<?php echo SQ_Classes_Helpers_Tools::getOption('sq_google_language')?>').attr('selected', true);</script>

                                                </div>
                                            </div>

                                            <div class="col-12 row py-2 mx-0 my-3">
                                                <div class="col-4 p-1 pr-3">
                                                    <div class="font-weight-bold"><?php echo esc_html__("Device", _SQ_PLUGIN_NAME_); ?>:</div>
                                                    <div class="small text-black-50"><?php echo esc_html__("Select the Device for which Squirrly will check the Google rank.", _SQ_PLUGIN_NAME_); ?></div>
                                                </div>
                                                <div class="col-8 p-0 input-group">
                                                    <select name="sq_google_device" class="form-control bg-input mb-1">
                                                        <option value="desktop">Desktop</option>
                                                        <option value="tablet">Tablet</option>
                                                        <option value="mobile">Mobile</option>
                                                    </select>
                                                    <script>jQuery('select[name=sq_google_device]').val('<?php echo SQ_Classes_Helpers_Tools::getOption('sq_google_device')?>').attr('selected', true);</script>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-12 my-3 p-0">
                        <button type="submit" class="btn rounded-0 btn-success btn-lg px-5 mx-4"><?php echo esc_html__("Save Settings", _SQ_PLUGIN_NAME_); ?></button>
                    </div>
                </form>
            </div>
            <div class="sq_col_side sticky">
                <div class="card col-12 p-0">
                    <?php echo SQ_Classes_ObjController::getClass('SQ_Core_BlockSupport')->init(); ?>
                    <?php echo SQ_Classes_ObjController::getClass('SQ_Core_BlockAssistant')->init(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
