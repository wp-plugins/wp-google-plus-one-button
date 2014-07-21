<?php 
/*
 * Plugin Name:WP Google Plus One Button
 * Plugin URI: http://vivacityinfotech.net
 * Description: A simple Google Plus Like and Share Button plugin for your posts/pages or Home page in your own language.
 * Version: 1.2
 * Author: Vivacity Infotech Pvt. Ltd.
 * Author URI: http://vivacityinfotech.net
 * License: GPL2
*/
?>
<?php
/*
Copyright 2014  Vivacity InfoTech Pvt. Ltd.  (email : support@vivacityinfotech.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
$enable_plugin = 0;
$placing_loc = "above";
$icon_size = 'medium';
$language = 'en';
$width= 150;
$data_ann = 'inline';
if(isset($_REQUEST['save_settings']))
{
		global $enable_plugin, $placing_loc,$icon_size,$language,$width,$data_ann;
		if(isset($_REQUEST['enable_google']))
		{
				$enable_plugin = 1;
				update_option('wp_google_plus_enable', 1);
		}
		else
		{
				$enable_plugin = 0;
				update_option('wp_google_plus_enable', 0);
		}
				
		$placing_loc = $_REQUEST['btn_pos'];
		update_option('wp_google_plus_location', $placing_loc);
		
		$icon_size = $_REQUEST['btn_size'];
		update_option('wp_google_plus_icon_size', $icon_size);
		
		$language = $_REQUEST['lang'];
		update_option('wp_google_plus_language', $language);
		
		if(!empty($_REQUEST['width']))
		{
			$width= $_REQUEST['width'];
			update_option('wp_google_plus_width', $width);
		}
			
		$data_ann = $_REQUEST['dann'];
		update_option('wp_google_plus_ann',$data_ann);
		//add_filter('the_content','wp_google_plus_script');	
		
}
else
{
		global $enable_plugin, $placing_loc,$icon_size,$language,$width,$data_ann;
		$enable_plugin =  get_option('wp_google_plus_enable');
		$placing_loc = get_option('wp_google_plus_location');
		$icon_size = get_option('wp_google_plus_icon_size');
		$language = get_option('wp_google_plus_language');
		$width= get_option('wp_google_plus_width');
		$data_ann = get_option('wp_google_plus_ann');	
		
}
add_filter('the_content','viva_wp_google_plus_script');

function viva_wp_google_plus_script(){
		global $enable_plugin, $placing_loc,$icon_size,$language,$width,$data_ann;
		//echo $enable_plugin.$placing_loc.$icon_size.$language.$width.$data_ann;	 exit;
		$newdata='';
		$content = get_the_content();
		if($enable_plugin == 1)
		{	//return $enable_plugin." in";
			$script = '<!-- Place this tag where you want the +1 button to render. -->
				<div class="g-plusone" data-size="'.$icon_size.'" data-annotation="'.$data_ann.'" data-width="'.$width.'"></div>
				
				<!-- Place this tag after the last +1 button tag. -->
				<script type="text/javascript">
				window.___gcfg = {lang: \''.$language.'\'};
				  (function() {
					var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
					po.src = \'https://apis.google.com/js/platform.js\';
					var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>';
			
			if($placing_loc == 'below')
				$newdata = $content."<br/>".$script;
			else
				$newdata = $script."<br/>".$content;
				
			return $newdata;
		}
		else
			//return $enable_plugin." out";
			return $content = get_the_content();
		
}


function viva_init_call(){
		add_submenu_page(
						'options-general.php', // the slud name of the parent menu
						__('WP Google Plus One Button', 'wp-gpob-plugin' ), // menu title of the plugin
						__('WP Google Plus One Button', 'wp-gpob-plugin' ), // menu text to be displayed on the menu option
						10, // capabilities of the menu
						'wp-google-plus-one-button', // menu slud
						'viva_create_google_gui'	 // function to be called.
					);
	}

function viva_create_google_gui(){
		global $enable_plugin, $placing_loc,$icon_size,$language,$width,$data_ann;
		
		$above='';$below='';$small=''; $medium=''; $standard=''; $tall='';
		$af= ''; $am= ''; $ar = ''; $eq=''; $bn= ''; $bg= ''; $ca= ''; $zhHK = '';$zhCN= ''; $zhTW= ''; $hr= '';
		$cs= ''; $da= ''; $ni= ''; $enGB = ''; $en = ''; $et= ''; $fil= ''; $fi= ''; $frCA= ''; $fr = ''; 
		$gl= '';	$de = ''; $el= ''; $gu= ''; $iw= ''; $hi = ''; $hu= ''; $is= ''; $id= ''; $it = ''; $ja= ''; $kn= '';
		$ko = ''; $lv= ''; $lt= ''; $ms= ''; $ml= ''; $mr= ''; $no= ''; $fa= ''; $pl= ''; $ptPR= ''; $ptPT = '';
		$ro= ''; $ru = ''; $sr= ''; $sk= ''; $sl= ''; $es419= ''; $es = ''; $sw= ''; $sv= ''; $ta= ''; $te= '';
		$th= ''; $tr= ''; $uk = ''; $ur= ''; $vi= ''; $zu= '';
		
		if($enable_plugin == true)
			$check=' checked=checked';
		else
			$check= ' ';
		
		
		if($placing_loc == 'above') 
			$above = ' selected=selected'; 
		else
			$below = ' selected=selected'; 
		
		if($icon_size == 'small')
			$small = ' selected=selected'; 
		else if($icon_size == 'medium')
			$medium = ' selected=selected'; 
		else if($icon_size == 'standard')
			$standard = ' selected=selected'; 
		else if($icon_size == 'tall')
			$tall = ' selected=selected'; 
			
		if($language == 'af')
					$af = ' selected=selected'; 
		if($language == 'am')
					$am = ' selected=selected'; 
		if($language == 'ar')
					$ar = ' selected=selected'; 
		if($language == 'eq')
					$eq = ' selected=selected'; 
		if($language == 'bn')
					$bn = ' selected=selected'; 
		if($language == 'bg')
					$bg = ' selected=selected'; 
		if($language == 'ca')
					$ca = ' selected=selected'; 
		if($language == 'zh-HK')
					$zhHK = ' selected=selected'; 
		if($language == 'zh-CN')
					$zhCN = ' selected=selected'; 
		if($language == 'zh-TW')
					$zhTW = ' selected=selected'; 
		if($language == 'hr')
					$hr = ' selected=selected'; 
		if($language == 'cs')
					$cs = ' selected=selected'; 
		if($language == 'da')
					$da = ' selected=selected'; 
		if($language == 'ni')
					$ni = ' selected=selected'; 
		if($language == 'en-GB')
					$enGB = ' selected=selected'; 
		if($language == 'en')
					$en = ' selected=selected'; 
		if($language == 'et')
					$et = ' selected=selected'; 
		if($language == 'fil')
					$fil = ' selected=selected'; 
		if($language == 'fi')
					$fi = ' selected=selected'; 
		if($language == 'fr-CA')
					$frCA = ' selected=selected'; 
		if($language == 'fr')
					$fr = ' selected=selected'; 
		if($language == 'gl')
					$gl = ' selected=selected'; 
		if($language == 'de')
					$de = ' selected=selected'; 
		if($language == 'el')
					$el = ' selected=selected'; 
		if($language == 'de')
					$de = ' selected=selected'; 
		if($language == 'iw')
					$iw = ' selected=selected'; 
		if($language == 'hi')
					$hi = ' selected=selected'; 
		if($language == 'hu')
					$hu = ' selected=selected'; 
		if($language == 'is')
					$is = ' selected=selected'; 
		if($language == 'id')
					$id = ' selected=selected'; 
		if($language == 'it')
					$it = ' selected=selected'; 
		if($language == 'ja')
					$ja = ' selected=selected'; 
		if($language == 'kn')
					$kn = ' selected=selected'; 
		if($language == 'ko')
					$ko = ' selected=selected'; 
		if($language == 'lv')
					$lv = ' selected=selected'; 
		if($language == 'lt')
					$lt = ' selected=selected'; 
		if($language == 'ms')
					$ms = ' selected=selected'; 
		if($language == 'ml')
					$ml = ' selected=selected'; 
		if($language == 'mr')
					$mr = ' selected=selected'; 
		if($language == 'no')
					$no = ' selected=selected'; 
		if($language == 'fa')
					$fa = ' selected=selected'; 
		if($language == 'pl')
					$pl = ' selected=selected'; 
		if($language == 'pt-PR')
					$ptPR = ' selected=selected'; 
		if($language == 'pt-PT')
					$ptPT = ' selected=selected'; 
		if($language == 'ro')
					$ro = ' selected=selected'; 
		if($language == 'ru')
					$ru = ' selected=selected'; 
		if($language == 'sr')
					$sr = ' selected=selected'; 
		if($language == 'sk')
					$sk = ' selected=selected'; 
		if($language == 'sl')
					$sl = ' selected=selected'; 
		if($language == 'es419')
					$es419 = ' selected=selected'; 
		if($language == 'es')
					$es = ' selected=selected'; 
		if($language == 'sw')
					$sw = ' selected=selected'; 
		if($language == 'sv')
					$sv = ' selected=selected'; 
		if($language == 'ta')
					$ta = ' selected=selected'; 
		if($language == 'te')
					$te = ' selected=selected'; 
		if($language == 'th')
					$th = ' selected=selected'; 
		if($language == 'tr')
					$tr = ' selected=selected'; 
		if($language == 'uk')
					$uk = ' selected=selected'; 
		if($language == 'ur')
					$ur = ' selected=selected'; 
		if($language == 'vi')
					$vi = ' selected=selected'; 
		if($language == 'zu')
					$zu = ' selected=selected'; 
					
		$inline=''; $bubble=''; $none='';
		if($data_ann == 'inline')
			$inline = ' selected=selected'; 
		else if($data_ann == 'bubble')
			$bubble = ' selected=selected'; 
		else if($data_ann == 'none')
			$none = ' selected=selected'; 
			
		$plugin_url = plugin_dir_url(__FILE__);
		$form_url = '';
		echo '<link href="'.$plugin_url.'css/googlestyle.css" rel="stylesheet" type="text/css" />';
		echo '<style type="text/css">#wpbody { background:url('.$plugin_url.'images/google.jpg) no-repeat !important;background-size: cover !important;}</style>';
		?>
		<script type="text/javascript">var msg1 = "<?= __('The width should be in between 120 to 450', 'wp-gpob-plugin' ) ?>";</script>
		<script type="text/javascript">var msg2 = "<?= __('Width should be a number', 'wp-gpob-plugin' ) ?>";</script>
		<?php 
		echo '<script src="'.$plugin_url.'js/custom.js" type="text/javascript" /></script>'; 
		
		$data='';
		$data = '<div id="google_container" >
					<div class="wrapper">
					<h1>'.__('WP Google Plus One Button', 'wp-gpob-plugin' ).'</h1>
					<form action="'.$form_url.'" method="post" >
						<div class="google_settings">
							<table>
								<tr>
									<td>'.__('Enable Google Plus Like and Share', 'wp-gpob-plugin' ).'</td>
									<td><input type="checkbox" name="enable_google" '.$check.'/> </td>
								</tr>
								<tr>
									<td>'.__('Place Google Plus Like at', 'wp-gpob-plugin' ).'</td>
									<td>
										<select name="btn_pos">
											<option value="above" '.$above.'>'.__('Above the content', 'wp-gpob-plugin' ).'</option>
											<option value="below" '.$below.'>'.__('Below the content', 'wp-gpob-plugin' ).'</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>'.__('Size', 'wp-gpob-plugin' ).'</td>
									<td>
										<select name="btn_size">
											<option value="small" '.$small.'>'.__('Small', 'wp-gpob-plugin' ).'</option>
											<option value="medium" '.$medium.'>'.__('Medium', 'wp-gpob-plugin' ).'</option>
											<option value="standard" '.$standard.'>'.__('Standard', 'wp-gpob-plugin' ).'</option>
											<option value="tall" '.$tall.'>'.__('Tall', 'wp-gpob-plugin' ).'</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>'.__('Language settings', 'wp-gpob-plugin' ).'</td>
									<td>
										<select name="lang">
											<option value="af" '.$af.'>'.__('Afrikaans', 'wp-gpob-plugin' ).'</option>
											<option value="am" '.$am.'>'.__('Amharic - ‪አማርኛ‬', 'wp-gpob-plugin' ).'</option>
											<option value="ar" '.$ar.'>'.__('Arabic - ‫العربية‬', 'wp-gpob-plugin' ).'</option>
											<option value="eq" '.$eq.'>'.__('Basque - ‪euskara‬', 'wp-gpob-plugin' ).'</option>
											<option value="bn" '.$bn.'>'.__('Bengali - ‪বাংলা‬', 'wp-gpob-plugin' ).'</option>
											<option value="bg" '.$bg.'>'.__('Bulgarian - ‪български‬', 'wp-gpob-plugin' ).'</option>
											<option value="ca" '.$ca.'>'.__('Catalan - ‪català‬', 'wp-gpob-plugin' ).'</option>
											<option value="zh-HK" '.$zhHK.'>'.__('Chinese (Hong Kong) - ‪中文（香港）‬', 'wp-gpob-plugin' ).'</option>
											<option value="zh-CN" '.$zhCN.'>'.__('Chinese (Simplified) - ‪简体中文‬', 'wp-gpob-plugin' ).'</option>
											<option value="zh-TW" '.$zhTw.'>'.__('Chinese (Traditional) - ‪繁體中文‬', 'wp-gpob-plugin' ).'</option>
											<option value="hr" '.$hr.'>'.__('Croatian - ‪Hrvatski‬', 'wp-gpob-plugin' ).'</option>
											<option value="cs" '.$cs.'>'.__('Czech - ‪Čeština‬', 'wp-gpob-plugin' ).'</option>
											<option value="da" '.$da.'>'.__('Danish - ‪Dansk‬', 'wp-gpob-plugin' ).'</option>
											<option value="ni" '.$ni.'>'.__('Dutch - ‪Nederlands‬', 'wp-gpob-plugin' ).'</option>
											<option value="en-GB" '.$enGB.'>'.__('English (United Kingdom)', 'wp-gpob-plugin' ).'</option>
											<option value="en" '.$en.'>'.__('English (USA)', 'wp-gpob-plugin' ).'</option>
											<option value="et" '.$et.'>'.__('Estonian - ‪eesti‬', 'wp-gpob-plugin' ).'</option>
											<option value="fil" '.$fil.'>'.__('Filipino', 'wp-gpob-plugin' ).'</option>
											<option value="fi" '.$fi.'>'.__('Finnish - ‪Suomi‬', 'wp-gpob-plugin' ).'</option>
											<option value="fr-CA" '.$frCA.'>'.__('French (Canada) - ‪Français (Canada)‬', 'wp-gpob-plugin' ).'</option>
											<option value="fr" '.$fr.'>'.__('French (France) - ‪Français (France)', 'wp-gpob-plugin' ).'</option>
											<option value="gl" '.$gl.'>'.__('Galician - ‪galego‬', 'wp-gpob-plugin' ).'</option>
											<option value="de" '.$de.'>'.__('German -Deutsch', 'wp-gpob-plugin' ).'</option>
											<option value="el" '.$el.'>'.__('Greek - ‪Ελληνικά‬', 'wp-gpob-plugin' ).'</option>
											<option value="gu" '.$gu.'>'.__('Gujarati - ‪ગુજરાતી‬', 'wp-gpob-plugin' ).'</option>
											<option value="iw" '.$iw.'>'.__('Hebrew - ‫עברית‬', 'wp-gpob-plugin' ).'</option>
											<option value="hi" '.$hi.'>'.__('Hindi - ‪हिन्दी', 'wp-gpob-plugin' ).'</option>
											<option value="hu" '.$hu.'>'.__('Hungarian - ‪magyar‬', 'wp-gpob-plugin' ).'</option>
											<option value="is" '.$is.'>'.__('Icelandic - ‪íslenska‬', 'wp-gpob-plugin' ).'</option>
											<option value="id" '.$id.'>'.__('Indonesian - ‪Bahasa Indonesia‬', 'wp-gpob-plugin' ).'</option>
											<option value="it" '.$it.'>'.__('Italian - ‪Italiano', 'wp-gpob-plugin' ).'</option>
											<option value="ja" '.$ja.'>'.__('Japanese - ‪日本語‬', 'wp-gpob-plugin' ).'</option>
											<option value="kn" '.$kn.'>'.__('Kannada - ‪ಕನ್ನಡ‬', 'wp-gpob-plugin' ).'</option>
											<option value="ko" '.$ko.'>'.__('Korean - ‪한국어', 'wp-gpob-plugin' ).'</option>
											<option value="lv" '.$lv.'>'.__('Latvian - ‪latviešu‬', 'wp-gpob-plugin' ).'</option>
											<option value="lt" '.$lt.'>'.__('Lithuanian - ‪lietuvių‬', 'wp-gpob-plugin' ).'</option>
											<option value="ms" '.$ms.'>'.__('Malay - ‪Bahasa Melayu‬', 'wp-gpob-plugin' ).'</option>
											<option value="ml" '.$ml.'>'.__('Malayalam - ‪മലയാളം‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="mr" '.$mr.'>'.__('Marathi - ‪मराठी‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="no" '.$no.'>'.__('Norwegian - ‪norsk‬', 'wp-gpob-plugin' ).'</option>
											<option value="fa" '.$fa.'>'.__('Persian - ‫فارسی‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="pl" '.$pl.'>'.__('Polish - ‪polski‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="pt-PR" '.$ptPR.'>'.__('Portuguese (Brazil) - ‪Português (Brasil)‬‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="pt-PT" '.$ptPT.'>'.__('Portuguese (Portugal) - ‪Português (Portugal)', 'wp-gpob-plugin' ).'</option>
											<option value="ro" '.$ro.'>'.__('Romanian - ‪română‬', 'wp-gpob-plugin' ).'</option>
											<option value="ru" '.$ru.'>'.__('Russian - ‪Русский‬', 'wp-gpob-plugin' ).'</option>
											<option value="sr" '.$sr.'>'.__('Serbian - ‪Српски‬', 'wp-gpob-plugin' ).'</option>
											<option value="sk" '.$sk.'>'.__('Slovak - ‪Slovenčina‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="sl" '.$sl.'>'.__('Slovenian - ‪slovenščina‬‬', 'wp-gpob-plugin' ).'</option>
											<option value="es-419" '.$es419.'>'.__('Spanish (Latin America) - ‪Español (Latinoamérica)‬', 'wp-gpob-plugin' ).'</option>
											<option value="es" '.$es.'>'.__('Spanish (Spain) - ‪Español (España)', 'wp-gpob-plugin' ).'</option>
											<option value="sw" '.$sw.'>'.__('Swahili - ‪Kiswahili‬', 'wp-gpob-plugin' ).'</option>
											<option value="sv" '.$sv.'>'.__('Swedish - ‪Svenska‬', 'wp-gpob-plugin' ).'</option>
											<option value="ta" '.$ta.'>'.__('Tamil - ‪தமிழ்‬', 'wp-gpob-plugin' ).'</option>
											<option value="te" '.$te.'>'.__('Telugu - ‪తెలుగు‬', 'wp-gpob-plugin' ).'</option>
											<option value="th" '.$th.'>'.__('Thai - ‪ไทย‬', 'wp-gpob-plugin' ).'</option>
											<option value="tr" '.$tr.'>'.__('Turkish - ‪Türkçe', 'wp-gpob-plugin' ).'</option>
											<option value="uk" '.$uk.'>'.__('Ukrainian - ‪Українська', 'wp-gpob-plugin' ).'</option>
											<option value="ur" '.$ur.'>'.__('Urdu - ‫اردو‬', 'wp-gpob-plugin' ).'</option>
											<option value="vi" '.$vi.'>'.__('Vietnamese - ‪Tiếng Việt‬', 'wp-gpob-plugin' ).'</option>
											<option value="zu" '.$zu.'>'.__('Zulu - ‪isiZulu‬', 'wp-gpob-plugin' ).'</option>

										</select>
									</td>
								</tr>
								<tr>
									<td>'.__('Width', 'wp-gpob-plugin' ).'</td>
									<td><input type="text" name="width" value="'.$width.'" id="google_width" /></td>
								</tr>
								<tr>
									<td>'.__('Data Annotation', 'wp-gpob-plugin' ).'</td>
									<td>
										<select name="dann">
											<option value="inline" '.$inline.'>'.__('Inline', 'wp-gpob-plugin' ).'</option>
											<option value="bubble" '.$bubble.'>'.__('Bubble', 'wp-gpob-plugin' ).'</option>
											<option value="none" '.$none.'>'.__('None', 'wp-gpob-plugin' ).'</option>
										</select>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="save_settings" value="'.__('Save', 'wp-gpob-plugin' ).'" id="save_settings" /> </td>
								</tr>
							</table>
						</div>
						
					</form>
					</div>
					<div style="clear:both;"></div>
				</div>
		';
		
		
		echo $data;
	}
	
add_action('admin_menu', 'viva_init_call');

//load translated strings
add_action( 'init', 'wp_google_plus_load_textdomain' );

function wp_google_plus_load_textdomain() {
	load_plugin_textdomain( 'wp-gpob-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
?>