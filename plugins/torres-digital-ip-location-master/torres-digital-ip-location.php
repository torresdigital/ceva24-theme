<?php /* The Silence is Gold!

Plugin Name: Torres Digital IP and Geolocation
Plugin URI: http://torresdigital.com.br/
Description: This plugin is a simple options to display on post or page a Geolocalization of visitants. <strong>Use the ShortCode to Display informations: [torresdigital-geolocation]</strong>
Version: 2.0.2020
Author: Torres Digital -Sites → Lojas Virtuais e e-Commerce
Author URI: https://facebook.com/torresdigital */

     /**
        *IP and GEO Location By Torres Digital ! // Source https://extreme-ip-lookup.com/
        *
        */
function torres_digital_geo_location_shortcode( $atts, $content) {

 $user_ip = getenv('REMOTE_ADDR');
 $geo = json_decode(file_get_contents("http://extreme-ip-lookup.com/json/$user_ip"));
 $country = $geo->country;
 $city = $geo->city;
 $ipType = $geo->ipType;
 $businessName = $geo->businessName;
 $businessWebsite = $geo->businessWebsite;
 $continent = $geo->continent;
    $countryCode = $geo->countryCode;
    $region = $geo->region;
    $lat = $geo->lat;
    $lon = $geo->lon;
    $ipName =$geo->ipName;
    $org = $geo->org;
    $isp = $geo->isp;
    $status = $geo->status;
    $message = $geo->message;

 echo " <div id=\"informacoes\" class=\"informacoes\">
 <p>Seu IP: <span id=\"ip\"> $user_ip</span></p>
 <p>Cidade: $city.</p>
 <p>Estado: $region.</p>
 <p>País: $country ($countryCode)</p>
 <p>Latitude: $lat.</p>
 <p>Longitude: $lon.</p>
 <p>Geolocalização:$continent.</p>
 <p>Empresa: $org.</p>
 <p id=\"url\">ISP - Proverdor: $ispName</p>
 <button><a id=\"ip\" onclick=\"CopyToClipboard('ip')\" href=\"#\" name=\"copy_pre\">Copiar IP</a></button>

 </div>";

    echo <<<ADMIN_OPTIONS
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

function CopyToClipboard(containerid) {
  if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy");
  } else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
    alert("IP COPIADO COM SUCESSO !")
  }
}


 </script>

ADMIN_OPTIONS;

    }

add_shortcode( 'torresdigital-geolocation', 'torres_digital_geo_location_shortcode' );

/* Style */
function torres_digital_geo_location__load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . 'css/style.css' );
   /* wp_enqueue_style( 'style2', $plugin_url . 'css/style2.css' );*/

}
add_action( 'wp_enqueue_scripts', 'torres_digital_geo_location__load_plugin_css' );

?>
