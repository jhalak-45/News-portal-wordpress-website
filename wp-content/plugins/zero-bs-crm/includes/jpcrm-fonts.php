<?php 
/*!
 * Jetpack CRM
 * https://jetpackcrm.com
 *
 * Logic concerned with installing and using different fonts, primarily in the creation of PDF files
 *
 */

// Require DOMPDF
global $zbs; $zbs->libLoad('dompdf');
use FontLib\Font;

defined( 'ZEROBSCRM_PATH' ) || exit;



/*
* Class encapsulating logic concerned with installing and using different fonts
*/
class JPCRM_Fonts {

	// dompdf font cache
	private $dompdf_font_cache_file = ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-1/lib/fonts/dompdf_font_family_cache.php';

	public function __construct( ) {


	}


	/*
	* Returns a list of fonts available via our CDN:
	*
	* @param: $cleaned_alphabetical bool - if true return the list with 'Noto' moved to back of string and re-ordered to be alphabetic
	* ... e.g. 'Noto Kufi Arabic' => 'Kufi Arabic (Noto)'
	*/
	public function list_all_available( $cleaned_alphabetical=false ){

		// generated by WH 30/11/21
		// while we can add: ,"NotoSansJP.zip":"Noto Sans JP" - unfortunately dompdf isn't supporting .otf files yet
		// TBD: adding Japanese, Korean, sadly CJK?
		// Removed, though present in gh repo: "Arimo.zip":"Arimo","Cousine.zip":"Cousine"
		$font_json = '{"Boku2.zip":"Boku2","NotoKufiArabic.zip":"Noto Kufi Arabic","NotoLoopedLao.zip":"Noto Looped Lao","NotoLoopedLaoUI.zip":"Noto Looped Lao UI","NotoLoopedThai.zip":"Noto Looped Thai","NotoLoopedThaiUI.zip":"Noto Looped Thai UI","NotoMusic.zip":"Noto Music","NotoNaskhArabic.zip":"Noto Naskh Arabic","NotoNaskhArabicUI.zip":"Noto Naskh Arabic UI","NotoNastaliqUrdu.zip":"Noto Nastaliq Urdu","NotoRashiHebrew.zip":"Noto Rashi Hebrew","NotoSansAdlam.zip":"Noto Sans Adlam","NotoSansAdlamUnjoined.zip":"Noto Sans Adlam Unjoined","NotoSansAnatolianHieroglyphs.zip":"Noto Sans Anatolian Hieroglyphs","NotoSansArabic.zip":"Noto Sans Arabic","NotoSansArabicUI.zip":"Noto Sans Arabic UI","NotoSansArmenian.zip":"Noto Sans Armenian","NotoSansAvestan.zip":"Noto Sans Avestan","NotoSansBalinese.zip":"Noto Sans Balinese","NotoSansBamum.zip":"Noto Sans Bamum","NotoSansBassaVah.zip":"Noto Sans Bassa Vah","NotoSansBatak.zip":"Noto Sans Batak","NotoSansBengali.zip":"Noto Sans Bengali","NotoSansBengaliUI.zip":"Noto Sans Bengali UI","NotoSansBhaiksuki.zip":"Noto Sans Bhaiksuki","NotoSansBrahmi.zip":"Noto Sans Brahmi","NotoSansBuginese.zip":"Noto Sans Buginese","NotoSansBuhid.zip":"Noto Sans Buhid","NotoSansCanadianAboriginal.zip":"Noto Sans Canadian Aboriginal","NotoSansCarian.zip":"Noto Sans Carian","NotoSansCaucasianAlbanian.zip":"Noto Sans Caucasian Albanian","NotoSansChakma.zip":"Noto Sans Chakma","NotoSansCham.zip":"Noto Sans Cham","NotoSansCherokee.zip":"Noto Sans Cherokee","NotoSansCoptic.zip":"Noto Sans Coptic","NotoSansCuneiform.zip":"Noto Sans Cuneiform","NotoSansCypriot.zip":"Noto Sans Cypriot","NotoSansDeseret.zip":"Noto Sans Deseret","NotoSansDevanagari.zip":"Noto Sans Devanagari","NotoSansDevanagariUI.zip":"Noto Sans Devanagari UI","NotoSansDisplay.zip":"Noto Sans Display","NotoSansDuployan.zip":"Noto Sans Duployan","NotoSansEgyptianHieroglyphs.zip":"Noto Sans Egyptian Hieroglyphs","NotoSansElbasan.zip":"Noto Sans Elbasan","NotoSansElymaic.zip":"Noto Sans Elymaic","NotoSansEthiopic.zip":"Noto Sans Ethiopic","NotoSansGeorgian.zip":"Noto Sans Georgian","NotoSansGlagolitic.zip":"Noto Sans Glagolitic","NotoSansGothic.zip":"Noto Sans Gothic","NotoSansGrantha.zip":"Noto Sans Grantha","NotoSansGujarati.zip":"Noto Sans Gujarati","NotoSansGujaratiUI.zip":"Noto Sans Gujarati UI","NotoSansGunjalaGondi.zip":"Noto Sans Gunjala Gondi","NotoSansGurmukhi.zip":"Noto Sans Gurmukhi","NotoSansGurmukhiUI.zip":"Noto Sans Gurmukhi UI","NotoSansHanifiRohingya.zip":"Noto Sans Hanifi Rohingya","NotoSansHanunoo.zip":"Noto Sans Hanunoo","NotoSansHatran.zip":"Noto Sans Hatran","NotoSansHebrew.zip":"Noto Sans Hebrew","NotoSansImperialAramaic.zip":"Noto Sans Imperial Aramaic","NotoSansIndicSiyaqNumbers.zip":"Noto Sans Indic Siyaq Numbers","NotoSansInscriptionalPahlavi.zip":"Noto Sans Inscriptional Pahlavi","NotoSansInscriptionalParthian.zip":"Noto Sans Inscriptional Parthian","NotoSansJavanese.zip":"Noto Sans Javanese","NotoSansKaithi.zip":"Noto Sans Kaithi","NotoSansKannada.zip":"Noto Sans Kannada","NotoSansKannadaUI.zip":"Noto Sans Kannada UI","NotoSansKayahLi.zip":"Noto Sans Kayah Li","NotoSansKharoshthi.zip":"Noto Sans Kharoshthi","NotoSansKhmer.zip":"Noto Sans Khmer","NotoSansKhmerUI.zip":"Noto Sans Khmer UI","NotoSansKhojki.zip":"Noto Sans Khojki","NotoSansKhudawadi.zip":"Noto Sans Khudawadi","NotoSansLao.zip":"Noto Sans Lao","NotoSansLaoUI.zip":"Noto Sans Lao UI","NotoSansLepcha.zip":"Noto Sans Lepcha","NotoSansLimbu.zip":"Noto Sans Limbu","NotoSansLinearA.zip":"Noto Sans Linear A","NotoSansLinearB.zip":"Noto Sans Linear B","NotoSansLisu.zip":"Noto Sans Lisu","NotoSansLycian.zip":"Noto Sans Lycian","NotoSansLydian.zip":"Noto Sans Lydian","NotoSansMahajani.zip":"Noto Sans Mahajani","NotoSansMalayalam.zip":"Noto Sans Malayalam","NotoSansMalayalamUI.zip":"Noto Sans Malayalam UI","NotoSansMandaic.zip":"Noto Sans Mandaic","NotoSansManichaean.zip":"Noto Sans Manichaean","NotoSansMarchen.zip":"Noto Sans Marchen","NotoSansMasaramGondi.zip":"Noto Sans Masaram Gondi","NotoSansMath.zip":"Noto Sans Math","NotoSansMayanNumerals.zip":"Noto Sans Mayan Numerals","NotoSansMedefaidrin.zip":"Noto Sans Medefaidrin","NotoSansMeeteiMayek.zip":"Noto Sans Meetei Mayek","NotoSansMendeKikakui.zip":"Noto Sans Mende Kikakui","NotoSansMeroitic.zip":"Noto Sans Meroitic","NotoSansMiao.zip":"Noto Sans Miao","NotoSansModi.zip":"Noto Sans Modi","NotoSansMongolian.zip":"Noto Sans Mongolian","NotoSansMono.zip":"Noto Sans Mono","NotoSansMro.zip":"Noto Sans Mro","NotoSansMultani.zip":"Noto Sans Multani","NotoSansMyanmar.zip":"Noto Sans Myanmar","NotoSansMyanmarUI.zip":"Noto Sans Myanmar UI","NotoSansNKo.zip":"Noto Sans N Ko","NotoSansNabataean.zip":"Noto Sans Nabataean","NotoSansNewTaiLue.zip":"Noto Sans New Tai Lue","NotoSansNewa.zip":"Noto Sans Newa","NotoSansNushu.zip":"Noto Sans Nushu","NotoSansOgham.zip":"Noto Sans Ogham","NotoSansOlChiki.zip":"Noto Sans Ol Chiki","NotoSansOldHungarian.zip":"Noto Sans Old Hungarian","NotoSansOldItalic.zip":"Noto Sans Old Italic","NotoSansOldNorthArabian.zip":"Noto Sans Old North Arabian","NotoSansOldPermic.zip":"Noto Sans Old Permic","NotoSansOldPersian.zip":"Noto Sans Old Persian","NotoSansOldSogdian.zip":"Noto Sans Old Sogdian","NotoSansOldSouthArabian.zip":"Noto Sans Old South Arabian","NotoSansOldTurkic.zip":"Noto Sans Old Turkic","NotoSansOriya.zip":"Noto Sans Oriya","NotoSansOriyaUI.zip":"Noto Sans Oriya UI","NotoSansOsage.zip":"Noto Sans Osage","NotoSansOsmanya.zip":"Noto Sans Osmanya","NotoSansPahawhHmong.zip":"Noto Sans Pahawh Hmong","NotoSansPalmyrene.zip":"Noto Sans Palmyrene","NotoSansPauCinHau.zip":"Noto Sans Pau Cin Hau","NotoSansPhagsPa.zip":"Noto Sans Phags Pa","NotoSansPhoenician.zip":"Noto Sans Phoenician","NotoSansPsalterPahlavi.zip":"Noto Sans Psalter Pahlavi","NotoSansRejang.zip":"Noto Sans Rejang","NotoSansRunic.zip":"Noto Sans Runic","NotoSansSamaritan.zip":"Noto Sans Samaritan","NotoSansSaurashtra.zip":"Noto Sans Saurashtra","NotoSansSharada.zip":"Noto Sans Sharada","NotoSansShavian.zip":"Noto Sans Shavian","NotoSansSiddham.zip":"Noto Sans Siddham","NotoSansSignWriting.zip":"Noto Sans Sign Writing","NotoSansSinhala.zip":"Noto Sans Sinhala","NotoSansSinhalaUI.zip":"Noto Sans Sinhala UI","NotoSansSogdian.zip":"Noto Sans Sogdian","NotoSansSoraSompeng.zip":"Noto Sans Sora Sompeng","NotoSansSoyombo.zip":"Noto Sans Soyombo","NotoSansSundanese.zip":"Noto Sans Sundanese","NotoSansSylotiNagri.zip":"Noto Sans Syloti Nagri","NotoSansSymbols.zip":"Noto Sans Symbols","NotoSansSymbols2.zip":"Noto Sans Symbols2","NotoSansSyriac.zip":"Noto Sans Syriac","NotoSansTagalog.zip":"Noto Sans Tagalog","NotoSansTagbanwa.zip":"Noto Sans Tagbanwa","NotoSansTaiLe.zip":"Noto Sans Tai Le","NotoSansTaiTham.zip":"Noto Sans Tai Tham","NotoSansTaiViet.zip":"Noto Sans Tai Viet","NotoSansTakri.zip":"Noto Sans Takri","NotoSansTamil.zip":"Noto Sans Tamil","NotoSansTamilSupplement.zip":"Noto Sans Tamil Supplement","NotoSansTamilUI.zip":"Noto Sans Tamil UI","NotoSansTelugu.zip":"Noto Sans Telugu","NotoSansTeluguUI.zip":"Noto Sans Telugu UI","NotoSansThaana.zip":"Noto Sans Thaana","NotoSansThai.zip":"Noto Sans Thai","NotoSansThaiUI.zip":"Noto Sans Thai UI","NotoSansTifinagh.zip":"Noto Sans Tifinagh","NotoSansTirhuta.zip":"Noto Sans Tirhuta","NotoSansUgaritic.zip":"Noto Sans Ugaritic","NotoSansVai.zip":"Noto Sans Vai","NotoSansWancho.zip":"Noto Sans Wancho","NotoSansWarangCiti.zip":"Noto Sans Warang Citi","NotoSansYi.zip":"Noto Sans Yi","NotoSansZanabazarSquare.zip":"Noto Sans Zanabazar Square","NotoSerifAhom.zip":"Noto Serif Ahom","NotoSerifArmenian.zip":"Noto Serif Armenian","NotoSerifBalinese.zip":"Noto Serif Balinese","NotoSerifBengali.zip":"Noto Serif Bengali","NotoSerifDevanagari.zip":"Noto Serif Devanagari","NotoSerifDisplay.zip":"Noto Serif Display","NotoSerifDogra.zip":"Noto Serif Dogra","NotoSerifEthiopic.zip":"Noto Serif Ethiopic","NotoSerifGeorgian.zip":"Noto Serif Georgian","NotoSerifGrantha.zip":"Noto Serif Grantha","NotoSerifGujarati.zip":"Noto Serif Gujarati","NotoSerifGurmukhi.zip":"Noto Serif Gurmukhi","NotoSerifHebrew.zip":"Noto Serif Hebrew","NotoSerifKannada.zip":"Noto Serif Kannada","NotoSerifKhmer.zip":"Noto Serif Khmer","NotoSerifKhojki.zip":"Noto Serif Khojki","NotoSerifLao.zip":"Noto Serif Lao","NotoSerifMalayalam.zip":"Noto Serif Malayalam","NotoSerifMyanmar.zip":"Noto Serif Myanmar","NotoSerifNyiakengPuachueHmong.zip":"Noto Serif Nyiakeng Puachue Hmong","NotoSerifOriya.zip":"Noto Serif Oriya","NotoSerifSinhala.zip":"Noto Serif Sinhala","NotoSerifTamil.zip":"Noto Serif Tamil","NotoSerifTamilSlanted.zip":"Noto Serif Tamil Slanted","NotoSerifTangut.zip":"Noto Serif Tangut","NotoSerifTelugu.zip":"Noto Serif Telugu","NotoSerifThai.zip":"Noto Serif Thai","NotoSerifTibetan.zip":"Noto Serif Tibetan","NotoSerifVithkuqi.zip":"Noto Serif Vithkuqi","NotoSerifYezidi.zip":"Noto Serif Yezidi","NotoTraditionalNushu.zip":"Noto Traditional Nushu"}';


		$return_array = json_decode( $font_json, true );

		if ( $cleaned_alphabetical ){

			$cleaned_array = array();
			foreach ( $return_array as $zip_name => $font_name ){

				$cleaned_name = $font_name;
				if ( substr( $font_name, 0, 9 ) == 'Noto Sans' ){
					$cleaned_name = substr( $cleaned_name, 10 ) . ' (Noto Sans)';
				}
				if ( substr( $font_name, 0, 10 ) == 'Noto Serif' ){
					$cleaned_name = substr( $cleaned_name, 11 ) . ' (Noto Serif)';
				}

				// special cases here (lets us keep our font array clean but show more info in UI)
				switch ( $cleaned_name ){

					case 'Boku2':
						$cleaned_name = 'Boku2 (JP)';
						break;

				}

				$cleaned_array[ $font_name ] = $cleaned_name;

			}

			// sort alphabetically
			asort( $cleaned_array );

			return $cleaned_array;

		}

		return $return_array;

	}

	/*
	* Converts a font-name to its zip filename
	*/
	public function zip_to_font_name( $zip_file_name='' ){

		return str_replace( '.zip', '',  jpcrm_string_split_at_caps( $zip_file_name ) );

	}

	/*
	* Converts a font-name to its zip filename
	*/
	public function font_name_to_zip( $font_name='' ){

		return str_replace( ' ', '',  $font_name ) . '.zip';

	}

	/*
	* Converts a font-name to its *-Regular.ttf filename
	*/
	public function font_name_to_regular_ttf_name( $font_name='' ){

		return str_replace( ' ', '',  $font_name ) . '-Regular.ttf';

	}

	/*
	* Converts a font-name to its ultimate directory
	*/
	public function font_name_to_dir( $font_name='' ){

		return str_replace( '.zip', '', $this->font_name_to_zip( $font_name ) );

	}

	/*
	* Converts a slug to a font name
	*/
	public function font_slug_to_name( $font_slug='' ){

		return ucwords( str_replace( '-', ' ', $font_slug ) );

	}

	/*
	* Converts a font-name to a slug equivalent
	*/
	public function font_name_to_slug( $font_name='' ){

		global $zbs;
		return $zbs->DAL->makeSlug( $font_name );

	}

	/*
	* Checks a font is on our available list
	*/
	public function font_is_available( $font_name='' ){

		$fonts = $this->list_all_available();

		if ( isset( $fonts[ $this->font_name_to_zip( $font_name ) ] ) ) {
			
			return true;

		}

		return false;

	}

	/*
	* Checks a font is on our available list
	*/
	public function font_is_installed( $font_name='' ){

		if ( $this->font_is_available( $font_name ) ){

			// Available?
			if ( file_exists( ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-fonts/' . $this->font_name_to_dir( $font_name ) ) ){

				// Installed? (check setting)
				$font_install_setting = zeroBSCRM_getSetting('pdf_extra_fonts_installed');
				if ( !is_array( $font_install_setting ) ){
					$font_install_setting = array();
				}

				if ( array_key_exists( $this->font_name_to_slug( $font_name ), $font_install_setting ) ){
					return true;
				}

			} 

		}

		return false; // font doesn't exist or isn't installed

	}


	/*
	* Installs fonts (which have already been downloaded, but are not marked installed)
	*/
	public function install_font( $font_name='', $force_reinstall=false ){

		// is available, and not installed (or $force_reinstall)
		if ( 
			$this->font_is_available( $font_name ) && 
			(!$this->font_is_installed( $font_name ) || $force_reinstall )
		){

			$font_directory_name = $this->font_name_to_dir( $font_name );
			$font_directory = ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-fonts/' . $font_directory_name;

			// Discern available variations
			$font_regular_path 		= $font_directory . '/' . $this->font_name_to_regular_ttf_name( $font_name ); // 'NotoSans-Regular.ttf' - ALL variations have a `*-Regular.ttf` as at 01/12/21
			$font_bold_path 		= null;
			$font_italic_path 		= null;
			$font_bolditalic_path 	= null;

			if ( file_exists( $font_directory . '/' . $font_directory_name . '-Bold.ttf' ) ){
				$font_bold_path 		= $font_directory . '/' . $font_directory_name . '-Bold.ttf';
			}
			if ( file_exists( $font_directory . '/' . $font_directory_name . '-Italic.ttf' ) ){
				$font_italic_path 		= $font_directory . '/' . $font_directory_name . '-Italic.ttf';
			}
			if ( file_exists( $font_directory . '/' . $font_directory_name . '-BoldItalic.ttf' ) ){
				$font_bolditalic_path 	= $font_directory . '/' . $font_directory_name . '-BoldItalic.ttf';
			}

			// Attempt to install
			if ($this->load_font(
			    str_replace( ' ' ,'', $font_name ), // e.g. NotoSansJP
			    $font_regular_path,
			    $font_bold_path,
			    $font_italic_path,
			    $font_bolditalic_path
			  )){

			  	global $zbs;

				// Update setting
				$font_install_setting = $zbs->settings->get('pdf_extra_fonts_installed');
				if ( !is_array( $font_install_setting ) ){
					$font_install_setting = array();
				}
				$font_install_setting[ $this->font_name_to_slug( $font_name ) ] = time();
				$zbs->settings->update( 'pdf_extra_fonts_installed', $font_install_setting );

				return true;

			}

		}

		return false;

	}


	/*
	* Installs default fonts (which have already been downloaded, but are not marked installed)
	* can use $this->retrieve_and_install_default_fonts() if from scratch (downloads + installs)
	*/
	public function install_default_fonts( $force_reinstall = false ){

		// also install the font(s) if not already installed (if present)
		$fontsInstalled = zeroBSCRM_getSetting('pdf_fonts_installed');
		if (
			( $fontsInstalled !== 1 && file_exists(ZEROBSCRM_PATH . 'includes/lib/dompdf-fonts/fonts-info.txt') ) 
			||
			( !$this->default_fonts_installed() )
			||
			$force_reinstall
		){

			#} attempt to install
			$fontDir = ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-fonts/';
			if ($this->load_font(
			    'NotoSansGlobal', 
			    $fontDir.'NotoSans-Regular.ttf', 
			    $fontDir.'NotoSans-Bold.ttf', 
			    $fontDir.'NotoSans-Italic.ttf', 
			    $fontDir.'NotoSans-BoldItalic.ttf'
			  )){

				#} update setting
				global $zbs;
				$zbs->settings->update('pdf_fonts_installed',1);

			}

		}

	}


	/**
	 * Installs a new font family
	 * This function maps a font-family name to a font.  It tries to locate the
	 * bold, italic, and bold italic versions of the font as well.  Once the
	 * files are located, ttf versions of the font are copied to the fonts
	 * directory.  Changes to the font lookup table are saved to the cache.
	 *
	 * This is an an adapted version of install_font_family() from https://github.com/dompdf/utils
	 *
	 * @param Dompdf $dompdf      dompdf main object 
	 * @param string $fontname    the font-family name
	 * @param string $normal      the filename of the normal face font subtype
	 * @param string $bold        the filename of the bold face font subtype
	 * @param string $italic      the filename of the italic face font subtype
	 * @param string $bold_italic the filename of the bold italic face font subtype
	 *
	 * @throws Exception
	 */
	public function install_font_family($dompdf, $fontname, $normal, $bold = null, $italic = null, $bold_italic = null, $debug = false) {
	  
	  try {

		  $fontMetrics = $dompdf->getFontMetrics();
		  
		  // Check if the base filename is readable
		  if ( !is_readable($normal) ) {
		    throw new Exception("Unable to read '$normal'.");
		  }

		  $dir = dirname($normal);
		  $basename = basename($normal);
		  $last_dot = strrpos($basename, '.');
		  if ($last_dot !== false) {
		    $file = substr($basename, 0, $last_dot);
		    $ext = strtolower(substr($basename, $last_dot));
		  } else {
		    $file = $basename;
		    $ext = '';
		  }

		  // dompdf will eventually support .otf, but for now limit to .ttf
		  if ( !in_array($ext, array(".ttf")) ) {
		    throw new Exception("Unable to process fonts of type '$ext'.");
		  }

		  // Try $file_Bold.$ext etc.
		  $path = "$dir/$file";
		  
		  $patterns = array(
		    "bold"        => array("_Bold", "b", "B", "bd", "BD"),
		    "italic"      => array("_Italic", "i", "I"),
		    "bold_italic" => array("_Bold_Italic", "bi", "BI", "ib", "IB"),
		  );
		  
		  foreach ($patterns as $type => $_patterns) {
		    if ( !isset($$type) || !is_readable($$type) ) {
		      foreach($_patterns as $_pattern) {
		        if ( is_readable("$path$_pattern$ext") ) {
		          $$type = "$path$_pattern$ext";
		          break;
		        }
		      }
		      
		      if ( is_null($$type) )
		        if ($debug) echo ("Unable to find $type face file.\n");
		    }
		  }

		  $fonts = compact("normal", "bold", "italic", "bold_italic");
		  $entry = array();

		  // Copy the files to the font directory.
		  foreach ($fonts as $var => $src) {
		    if ( is_null($src) ) {
		      $entry[$var] = $dompdf->getOptions()->get('fontDir') . '/' . mb_substr(basename($normal), 0, -4);
		      continue;
		    }

		    // Verify that the fonts exist and are readable
		    if ( !is_readable($src) ) {
		      throw new Exception("Requested font '$src' is not readable");
		    }

		    $dest = $dompdf->getOptions()->get('fontDir') . '/' . basename($src);

		    if ( !is_writeable(dirname($dest)) ) {
		      throw new Exception("Unable to write to destination '$dest'.");
		    }

		    if ($debug) echo "Copying $src to $dest...\n";

		    if ( !copy($src, $dest) ) {
		      throw new Exception("Unable to copy '$src' to '$dest'");
		    }
		    
		    $entry_name = mb_substr($dest, 0, -4);
		    
		    if ($debug) echo "Generating Adobe Font Metrics for $entry_name...\n";
		    
		    $font_obj = Font::load($dest);
		    $font_obj->saveAdobeFontMetrics("$entry_name.ufm");
		    $font_obj->close();

		    $entry[$var] = $entry_name;

		  }

		  // Store the fonts in the lookup table
		  $fontMetrics->setFontFamily($fontname, $entry);

		  // Save the changes
		  $fontMetrics->saveFontFamilies();

		  // Fini
		  return true;

		} catch (Exception $e){

			// nada

		}

		return false;

	}

	/*
	* Retrieves a font zip from our CDN and installs it locally
	*/
	public function retrieve_and_install_specific_font( $font_name='', $force_reinstall = false){

		global $zbs;

		// font exists?
		if ( !$this->font_is_available( $font_name) ){

			return false;

		}

		// font already installed?
		if ( $this->font_is_installed( $font_name ) && !$force_reinstall ){

			return true;

		}

		// Retrieve & install the font

		// Directories & filenames
		$working_dir = ZEROBSCRM_PATH.'temp'.time(); 
		if ( !file_exists( $working_dir ) ){ 
			wp_mkdir_p( $working_dir );
		}
		$target_dir = ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-fonts/' . $this->font_name_to_dir( $font_name ); 
		if ( !file_exists( $target_dir ) ) {
			wp_mkdir_p( $target_dir );
		}
		$zip_name = $this->font_name_to_zip( $font_name );
		$font_file_name = $this->font_name_to_regular_ttf_name( $font_name );

		// Attempt to download and install
		if ( file_exists( $target_dir ) && file_exists( $working_dir ) ){

			// Retrieve zip 
			$libs = zeroBSCRM_retrieveFile( $zbs->urls['extdlfonts'] . $zip_name, $working_dir . '/' . $zip_name );

			// Process zip
			if ( file_exists( $working_dir.'/' . $zip_name ) ){

				// Expand
				$expanded = zeroBSCRM_expandArchive( $working_dir . '/' . $zip_name, $target_dir . '/' );

				// Check success?
				if ( file_exists( $target_dir . '/' . $font_file_name ) ){

					// appears to have worked, tidy up:
					if ( file_exists( $working_dir . '/' . $zip_name ) ){
						unlink( $working_dir . '/' . $zip_name  );
					}
					if ( file_exists( $working_dir ) ){
						@unlink( $working_dir  );
					}

					// install the font
					return $this->install_font( $font_name, true );

				} else {

					// Add error msg
					global $zbsExtensionInstallError;
					$zbsExtensionInstallError = __('CRM was not able to retrieve the requested font.',"zero-bs-crm") . ' ' . __('(Failed to install font.)',"zero-bs-crm");
					##WLREMOVE
					$zbsExtensionInstallError = __('Jetpack CRM was not able to retrieve the requested font.',"zero-bs-crm") . ' ' . __('(Failed to install font.)',"zero-bs-crm");
					##/WLREMOVE

				}


			} else {

				// Add error msg
				global $zbsExtensionInstallError;
				$zbsExtensionInstallError = __('CRM was not able to retrieve the requested font.',"zero-bs-crm") . ' ' . __('(Failed to download font.)',"zero-bs-crm");
				##WLREMOVE
				$zbsExtensionInstallError = __('Jetpack CRM was not able to retrieve the requested font.',"zero-bs-crm") . ' ' . __('(Failed to download font.)',"zero-bs-crm");
				##/WLREMOVE

			}


		} else {

			// Add error msg
			global $zbsExtensionInstallError;
			$zbsExtensionInstallError = __('CRM was not able to retrieve the requested font.',"zero-bs-crm") . ' ' . __('(Failed to create directory.)',"zero-bs-crm");
			##WLREMOVE
			$zbsExtensionInstallError = __('Jetpack CRM was not able to retrieve the requested font.',"zero-bs-crm") . ' ' . __('(Failed to create directory.)',"zero-bs-crm");
			##/WLREMOVE

		}


		return false;


	}


	/*
	* Retrieve (and install) default fonts which dompdf uses to provide global lang supp
	* Note: This is somewhat deprecated as we now package noto-sans within core version (`/includes/dompdf-fonts/*`)
	* This function is therefor only used if somebody were to delete these default fonts.
	* Instead, use retrieve_and_install() to retrieve locale specific fonts (from v4.7.0)
	*/
	public function retrieve_and_install_default_fonts(){

		#} Check if already downloaded libs:
		if (!file_exists( ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-fonts/fonts-info.txt')){

			global $zbs;

			#} Libs appear to need downloading..
				
				#} dirs
				$workingDir = ZEROBSCRM_PATH.'temp'.time(); if (!file_exists($workingDir)) wp_mkdir_p($workingDir);
				$endingDir = ZEROBSCRM_INCLUDE_PATH . 'lib/dompdf-fonts'; if (!file_exists($endingDir)) wp_mkdir_p($endingDir);

				if (file_exists($endingDir) && file_exists($workingDir)){

					#} Retrieve zip 
					$libs = zeroBSCRM_retrieveFile($zbs->urls['extdlrepo'].'pdffonts.zip',$workingDir.'/pdffonts.zip');

					#} Expand
					if (file_exists($workingDir.'/pdffonts.zip')){

						#} Should checksum?

						#} For now, expand zip
						$expanded = zeroBSCRM_expandArchive($workingDir.'/pdffonts.zip',$endingDir.'/');

						#} Check success?
						if (file_exists($endingDir.'fonts-info.txt')){

							#} All appears good, clean up
							if (file_exists($workingDir.'/pdffonts.zip')) unlink($workingDir.'/pdffonts.zip');
							if (file_exists($workingDir)) rmdir($workingDir);

							// install em
							$this->install_default_fonts();

						} else {

							#} Add error msg
							global $zbsExtensionInstallError;
							$zbsExtensionInstallError = __('Jetpack CRM was not able to extract the libraries it needs to in order to install PDF Engine.',"zero-bs-crm").' '.__('(fonts)','zero-bs-crm');

						}


					} else {

						#} Add error msg
						global $zbsExtensionInstallError;
						$zbsExtensionInstallError = __('Jetpack CRM was not able to download the libraries it needs to in order to install PDF Engine.',"zero-bs-crm").' '.__('(fonts)','zero-bs-crm');

					}


				} else {

					#} Add error msg
					global $zbsExtensionInstallError;
					$zbsExtensionInstallError = __('Jetpack CRM was not able to create the directories it needs to in order to install PDF Engine.',"zero-bs-crm").' '.__('(fonts)','zero-bs-crm');

				}


		} else {

			#} Already exists...

				// check they're installed
				$this->install_default_fonts();

		}

		#} Return fail
		return false;

	}


   /*
   * Loads a font file collection (.ttf's) onto the server for dompdf
   * only needs to fire once
   */
   public function load_font( $font_name='', $normalFile='', $boldFile=null, $italicFile=null, $boldItalicFile=null ){

	    global $zbs;

	    if ( zeroBSCRM_isZBSAdminOrAdmin() && $zbs->isDAL3() && !empty($font_name)
	    	 && file_exists($normalFile)
	    	 && ( file_exists($boldFile) || $boldFile == null )
	    	 && ( file_exists($italicFile) || $italicFile == null )
	    	 && ( file_exists($boldItalicFile) || $boldItalicFile == null )
			){

	        // PDF Install check (importantly skipp the fontcheck with false first param)
	        zeroBSCRM_extension_checkinstall_pdfinv(false);

	        // Initialise dompdf
	        $dompdf = new Dompdf\Dompdf();

	  		// Install the font(s)
			return $this->install_font_family($dompdf, $font_name, $normalFile, $boldFile, $italicFile, $boldItalicFile);

		}

		return false; 

	}


	/*
	* Retrieves the font cache from dompdf and returns all loaded fonts
	*/
	public function loaded_fonts(){

		if ( file_exists( $this->dompdf_font_cache_file ) ){

			$fontDir = '';
        	
        	$cacheData = require $this->dompdf_font_cache_file;

        	return $cacheData;

        }

		return array();

	}

	/*
	* Returns bool whether or not our key font (Noto Sans global) is installed according to dompdf
	*/
	public function default_fonts_installed(){

		$existing_fonts = $this->loaded_fonts();

		if ( isset( $existing_fonts['notosansglobal'] ) ){

			return true;
		}

		return false;
	}

}