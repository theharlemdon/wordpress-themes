<?php

//POWERMAG CUSTOM TYPOGRAPHY FUNCTIONS


/**
 * Returns a typography option in a format that can be outputted as inline CSS
 */

function pm_font_styles ($option, $selectors) /*Output only font-familly AND size for body*/ {
	
		$output = $selectors . '{';
		$output .= 'font-family:' . $option['face'] . ';' ;
		//$output .= 'font-size:' . $option['size'] . ';' ;
		$output .= '}';
		$output .= "\n";
		
		return $output;
}


/**
 * Checking if a Google font is selected and enqueueing it only once in case of double selection
 */
 
if ( !function_exists( 'pm_google_fonts' ) ) {
	function pm_google_fonts() {
		if ( !is_admin() ) {
			$all_google_fonts = array_keys( pm_get_google_fonts() );
			
			// Define all the options that possibly have a unique Google font
			$pm_headings_font = of_get_option('pm_headings_font', 'serif');
			$pm_body_font = of_get_option('pm_body_font', false);
			
			
			// Get the font face for each option and put it in an array
			$selected_fonts = array(
				$pm_headings_font['face'],
				$pm_body_font['face']
				);
				
			// Remove any duplicates in the list
			$selected_fonts = array_unique($selected_fonts);
			
			// Check each of the unique fonts against the defined Google fonts
			// If it is a Google font, go ahead and call the function to enqueue it
			foreach ( $selected_fonts as $font ) {
				if ( in_array( $font, $all_google_fonts ) ) {
					pm_enqueue_google_font($font);
				}
			}
		}
	}
}

add_action( 'init', 'pm_google_fonts' );


/**
 * Enqueuing the Google $font that is passed
 */
 
function pm_enqueue_google_font($font) {
	
 	if ( of_get_option( 'pm_enable_styles' ) ) {
	
		$font = explode(',', $font);
		$font = $font[0];
		// Certain Google fonts need slight tweaks in order to load properly
		// Like our friend "Raleway"
		if ( $font == 'Raleway' )
			$font = 'Raleway:100';
		$font = str_replace(" ", "+", $font);
		wp_enqueue_style( "pm_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
		
		if ( $font == 'Open+Sans' )
			$font = 'Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800';
		$font = str_replace(" ", "+", $font);
		wp_enqueue_style( "pm_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
		
			if ( $font == 'Lobster+Two' )
			$font = 'Lobster+Two:400,700italic';
		$font = str_replace(" ", "+", $font);
		wp_enqueue_style( "pm_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
	}
}

function pm_styles() {
 	
 	// If this is selected no inline styles will be outputted into the <head>
 	if ( of_get_option( 'pm_enable_styles' ) ) {
		$output = '';
		$input = '';
		
		//Headings and Nav (BebasNeue substitute)
		if ( of_get_option( 'pm_headings_font' ) ) {
			$output .= pm_font_styles( of_get_option( 'pm_headings_font' ) , '
				h1,h2,h3,h4,h5,h6,
				.utilities ul,
				.main-navigation,
				.main-small-navigation ul,
				footer.entry-meta span,
				footer.entry-meta a,
				.page-nav,
				.flex-cat,
				#carousel div span,
				.carousel-text a,
				.widget-title-bg .widget-title span.inner,
				.widget-title-bg .simil-widget-comment span.inner,
				.widget a.twtr-join-conv,
				#comments .simil-widget-comment,
				#comments .bypostauthor .widget-title-bg:before,
				.reply ,
				.nocomments,
				.lwa .lwa-title,
				.lwa-register .lwa-title,
				.lwa .dropdown-menu li > a,
				.date a,
				.entry-rating,
				.rw-criteria,
				.rw-end .rw-overall,
				.rw-end .rw-overall-titles,
				.info-stripe .cat-stripe,
				.info-stripe .percent-stripe,
				.wpcf7 label,
				.socialbox span.number,
				.cat-tabs ul li a,
				.accordion-heading,
				.vc_text_separator div,
				#content .wpb_accordion .ui-accordion .ui-accordion-header a,
				.wpb_accordion .ui-accordion .ui-accordion-header a,
				#content .wpb_content_element .ui-tabs .ui-tabs-nav,
				.jackbox-modal h2,
				.jackbox-modal h3,
				.jackbox-title-text
			');
		}
		
		//Body
		if ( of_get_option( 'pm_body_font' ) ) {
			$output .= pm_font_styles( of_get_option( 'pm_body_font' ) , 'body');
		}
		
		if ( of_get_option( 'pm_font_size' ) ) {
			$output .= 'body {font-size:'.of_get_option('pm_font_size').'px }';
		}
		
		if ( $output != '' ) {
			$output = '<style>' . $output . '</style>';
			echo $output;
		}
	}
	
}
add_action('wp_head', 'pm_styles');


/* FONTS ARRAYS */

//Returns an array of system fonts
//Feel free to edit this, update the fallbacks, etc.
function pm_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif' => 'Arial',
		'"Avant Garde", sans-serif' => 'Avant Garde',
		'Cambria, Georgia, serif' => 'Cambria',
		'Copse, sans-serif' => 'Copse',
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
		'Georgia, serif' => 'Georgia',
		'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma'
	);
	return $os_faces;
}

//Returns a select list of Google fonts
//Feel free to edit this, update the fallbacks, etc.
function pm_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		"Abel" => "Abel",
		"Abril Fatface" => "Abril Fatface",
		"Aclonica" => "Aclonica",
		"Acme" => "Acme",
		"Actor" => "Actor",
		"Adamina" => "Adamina",
		"Advent Pro" => "Advent Pro",
		"Aguafina Script" => "Aguafina Script",
		"Aladin" => "Aladin",
		"Aldrich" => "Aldrich",
		"Alegreya" => "Alegreya",
		"Alegreya SC" => "Alegreya SC",
		"Alex Brush" => "Alex Brush",
		"Alfa Slab One" => "Alfa Slab One",
		"Alice" => "Alice",
		"Alike" => "Alike",
		"Alike Angular" => "Alike Angular",
		"Allan" => "Allan",
		"Allerta" => "Allerta",
		"Allerta Stencil" => "Allerta Stencil",
		"Allura" => "Allura",
		"Almendra" => "Almendra",
		"Almendra SC" => "Almendra SC",
		"Amarante" => "Amarante",
		"Amaranth" => "Amaranth",
		"Amatic SC" => "Amatic SC",
		"Amethysta" => "Amethysta",
		"Andada" => "Andada",
		"Andika" => "Andika",
		"Angkor" => "Angkor",
		"Annie Use Your Telescope" => "Annie Use Your Telescope",
		"Anonymous Pro" => "Anonymous Pro",
		"Antic" => "Antic",
		"Antic Didone" => "Antic Didone",
		"Antic Slab" => "Antic Slab",
		"Anton" => "Anton",
		"Arapey" => "Arapey",
		"Arbutus" => "Arbutus",
		"Architects Daughter" => "Architects Daughter",
		"Arimo" => "Arimo",
		"Arizonia" => "Arizonia",
		"Armata" => "Armata",
		"Artifika" => "Artifika",
		"Arvo" => "Arvo",
		"Asap" => "Asap",
		"Asset" => "Asset",
		"Astloch" => "Astloch",
		"Asul" => "Asul",
		"Atomic Age" => "Atomic Age",
		"Aubrey" => "Aubrey",
		"Audiowide" => "Audiowide",
		"Average" => "Average",
		"Averia Gruesa Libre" => "Averia Gruesa Libre",
		"Averia Libre" => "Averia Libre",
		"Averia Sans Libre" => "Averia Sans Libre",
		"Averia Serif Libre" => "Averia Serif Libre",
		"Bad Script" => "Bad Script",
		"Balthazar" => "Balthazar",
		"Bangers" => "Bangers",
		"Basic" => "Basic",
		"Battambang" => "Battambang",
		"Baumans" => "Baumans",
		"Bayon" => "Bayon",
		"Belgrano" => "Belgrano",
		"Belleza" => "Belleza",
		"Bentham" => "Bentham",
		"Berkshire Swash" => "Berkshire Swash",
		"Bevan" => "Bevan",
		"Bigshot One" => "Bigshot One",
		"Bilbo" => "Bilbo",
		"Bilbo Swash Caps" => "Bilbo Swash Caps",
		"Bitter" => "Bitter",
		"Black Ops One" => "Black Ops One",
		"Bokor" => "Bokor",
		"Bonbon" => "Bonbon",
		"Boogaloo" => "Boogaloo",
		"Bowlby One" => "Bowlby One",
		"Bowlby One SC" => "Bowlby One SC",
		"Brawler" => "Brawler",
		"Bree Serif" => "Bree Serif",
		"Bubblegum Sans" => "Bubblegum Sans",
		"Bubbler One" => "Bubbler One",
		"Buda" => "Buda",
		"Buenard" => "Buenard",
		"Butcherman" => "Butcherman",
		"Butterfly Kids" => "Butterfly Kids",
		"Cabin" => "Cabin",
		"Cabin Condensed" => "Cabin Condensed",
		"Cabin Sketch" => "Cabin Sketch",
		"Caesar Dressing" => "Caesar Dressing",
		"Cagliostro" => "Cagliostro",
		"Calligraffitti" => "Calligraffitti",
		"Cambo" => "Cambo",
		"Candal" => "Candal",
		"Cantarell" => "Cantarell",
		"Cantata One" => "Cantata One",
		"Cantora One" => "Cantora One",
		"Capriola" => "Capriola",
		"Cardo" => "Cardo",
		"Carme" => "Carme",
		"Carter One" => "Carter One",
		"Caudex" => "Caudex",
		"Cedarville Cursive" => "Cedarville Cursive",
		"Ceviche One" => "Ceviche One",
		"Changa One" => "Changa One",
		"Chango" => "Chango",
		"Chau Philomene One" => "Chau Philomene One",
		"Chelsea Market" => "Chelsea Market",
		"Chenla" => "Chenla",
		"Cherry Cream Soda" => "Cherry Cream Soda",
		"Chewy" => "Chewy",
		"Chicle" => "Chicle",
		"Chivo" => "Chivo",
		"Coda" => "Coda",
		"Coda Caption" => "Coda Caption",
		"Codystar" => "Codystar",
		"Comfortaa" => "Comfortaa",
		"Coming Soon" => "Coming Soon",
		"Concert One" => "Concert One",
		"Condiment" => "Condiment",
		"Content" => "Content",
		"Contrail One" => "Contrail One",
		"Convergence" => "Convergence",
		"Cookie" => "Cookie",
		"Copse" => "Copse",
		"Corben" => "Corben",
		"Courgette" => "Courgette",
		"Cousine" => "Cousine",
		"Coustard" => "Coustard",
		"Covered By Your Grace" => "Covered By Your Grace",
		"Crafty Girls" => "Crafty Girls",
		"Creepster" => "Creepster",
		"Crete Round" => "Crete Round",
		"Crimson Text" => "Crimson Text",
		"Crushed" => "Crushed",
		"Cuprum" => "Cuprum",
		"Cutive" => "Cutive",
		"Damion" => "Damion",
		"Dancing Script" => "Dancing Script",
		"Dangrek" => "Dangrek",
		"Dawning of a New Day" => "Dawning of a New Day",
		"Days One" => "Days One",
		"Delius" => "Delius",
		"Delius Swash Caps" => "Delius Swash Caps",
		"Delius Unicase" => "Delius Unicase",
		"Della Respira" => "Della Respira",
		"Devonshire" => "Devonshire",
		"Didact Gothic" => "Didact Gothic",
		"Diplomata" => "Diplomata",
		"Diplomata SC" => "Diplomata SC",
		"Doppio One" => "Doppio One",
		"Dorsa" => "Dorsa",
		"Dosis" => "Dosis",
		"Dr Sugiyama" => "Dr Sugiyama",
		"Droid Sans" => "Droid Sans",
		"Droid Sans Mono" => "Droid Sans Mono",
		"Droid Serif" => "Droid Serif",
		"Duru Sans" => "Duru Sans",
		"Dynalight" => "Dynalight",
		"EB Garamond" => "EB Garamond",
		"Eagle Lake" => "Eagle Lake",
		"Eater" => "Eater",
		"Economica" => "Economica",
		"Electrolize" => "Electrolize",
		"Emblema One" => "Emblema One",
		"Emilys Candy" => "Emilys Candy",
		"Engagement" => "Engagement",
		"Enriqueta" => "Enriqueta",
		"Erica One" => "Erica One",
		"Esteban" => "Esteban",
		"Euphoria Script" => "Euphoria Script",
		"Ewert" => "Ewert",
		"Exo" => "Exo",
		"Expletus Sans" => "Expletus Sans",
		"Fanwood Text" => "Fanwood Text",
		"Fascinate" => "Fascinate",
		"Fascinate Inline" => "Fascinate Inline",
		"Fasthand" => "Fasthand",
		"Federant" => "Federant",
		"Federo" => "Federo",
		"Felipa" => "Felipa",
		"Fjord One" => "Fjord One",
		"Flamenco" => "Flamenco",
		"Flavors" => "Flavors",
		"Fondamento" => "Fondamento",
		"Fontdiner Swanky" => "Fontdiner Swanky",
		"Forum" => "Forum",
		"Francois One" => "Francois One",
		"Fredericka the Great" => "Fredericka the Great",
		"Fredoka One" => "Fredoka One",
		"Freehand" => "Freehand",
		"Fresca" => "Fresca",
		"Frijole" => "Frijole",
		"Fugaz One" => "Fugaz One",
		"GFS Didot" => "GFS Didot",
		"GFS Neohellenic" => "GFS Neohellenic",
		"Galdeano" => "Galdeano",
		"Galindo" => "Galindo",
		"Gentium Basic" => "Gentium Basic",
		"Gentium Book Basic" => "Gentium Book Basic",
		"Geo" => "Geo",
		"Geostar" => "Geostar",
		"Geostar Fill" => "Geostar Fill",
		"Germania One" => "Germania One",
		"Give You Glory" => "Give You Glory",
		"Glass Antiqua" => "Glass Antiqua",
		"Glegoo" => "Glegoo",
		"Gloria Hallelujah" => "Gloria Hallelujah",
		"Goblin One" => "Goblin One",
		"Gochi Hand" => "Gochi Hand",
		"Gorditas" => "Gorditas",
		"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
		"Graduate" => "Graduate",
		"Gravitas One" => "Gravitas One",
		"Great Vibes" => "Great Vibes",
		"Griffy" => "Griffy",
		"Gruppo" => "Gruppo",
		"Gudea" => "Gudea",
		"Habibi" => "Habibi",
		"Hammersmith One" => "Hammersmith One",
		"Handlee" => "Handlee",
		"Hanuman" => "Hanuman",
		"Happy Monkey" => "Happy Monkey",
		"Headland One" => "Headland One",
		"Henny Penny" => "Henny Penny",
		"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
		"Holtwood One SC" => "Holtwood One SC",
		"Homemade Apple" => "Homemade Apple",
		"Homenaje" => "Homenaje",
		"IM Fell DW Pica" => "IM Fell DW Pica",
		"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
		"IM Fell Double Pica" => "IM Fell Double Pica",
		"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
		"IM Fell English" => "IM Fell English",
		"IM Fell English SC" => "IM Fell English SC",
		"IM Fell French Canon" => "IM Fell French Canon",
		"IM Fell French Canon SC" => "IM Fell French Canon SC",
		"IM Fell Great Primer" => "IM Fell Great Primer",
		"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
		"Iceberg" => "Iceberg",
		"Iceland" => "Iceland",
		"Imprima" => "Imprima",
		"Inconsolata" => "Inconsolata",
		"Inder" => "Inder",
		"Indie Flower" => "Indie Flower",
		"Inika" => "Inika",
		"Irish Grover" => "Irish Grover",
		"Istok Web" => "Istok Web",
		"Italiana" => "Italiana",
		"Italianno" => "Italianno",
		"Jacques Francois" => "Jacques Francois",
		"Jacques Francois Shadow" => "Jacques Francois Shadow",
		"Jim Nightshade" => "Jim Nightshade",
		"Jockey One" => "Jockey One",
		"Jolly Lodger" => "Jolly Lodger",
		"Josefin Sans" => "Josefin Sans",
		"Josefin Slab" => "Josefin Slab",
		"Judson" => "Judson",
		"Julee" => "Julee",
		"Junge" => "Junge",
		"Jura" => "Jura",
		"Just Another Hand" => "Just Another Hand",
		"Just Me Again Down Here" => "Just Me Again Down Here",
		"Kameron" => "Kameron",
		"Karla" => "Karla",
		"Kaushan Script" => "Kaushan Script",
		"Kelly Slab" => "Kelly Slab",
		"Kenia" => "Kenia",
		"Khmer" => "Khmer",
		"Knewave" => "Knewave",
		"Kotta One" => "Kotta One",
		"Koulen" => "Koulen",
		"Kranky" => "Kranky",
		"Kreon" => "Kreon",
		"Kristi" => "Kristi",
		"Krona One" => "Krona One",
		"La Belle Aurore" => "La Belle Aurore",
		"Lancelot" => "Lancelot",
		"Lato" => "Lato",
		"League Script" => "League Script",
		"Leckerli One" => "Leckerli One",
		"Ledger" => "Ledger",
		"Lekton" => "Lekton",
		"Lemon" => "Lemon",
		"Life Savers" => "Life Savers",
		"Lilita One" => "Lilita One",
		"Limelight" => "Limelight",
		"Linden Hill" => "Linden Hill",
		"Lobster" => "Lobster",
		"Lobster Two" => "Lobster Two",
		"Londrina Outline" => "Londrina Outline",
		"Londrina Shadow" => "Londrina Shadow",
		"Londrina Sketch" => "Londrina Sketch",
		"Londrina Solid" => "Londrina Solid",
		"Lora" => "Lora",
		"Love Ya Like A Sister" => "Love Ya Like A Sister",
		"Loved by the King" => "Loved by the King",
		"Lovers Quarrel" => "Lovers Quarrel",
		"Luckiest Guy" => "Luckiest Guy",
		"Lusitana" => "Lusitana",
		"Lustria" => "Lustria",
		"Macondo" => "Macondo",
		"Macondo Swash Caps" => "Macondo Swash Caps",
		"Magra" => "Magra",
		"Maiden Orange" => "Maiden Orange",
		"Mako" => "Mako",
		"Marck Script" => "Marck Script",
		"Marko One" => "Marko One",
		"Marmelad" => "Marmelad",
		"Marvel" => "Marvel",
		"Mate" => "Mate",
		"Mate SC" => "Mate SC",
		"Maven Pro" => "Maven Pro",
		"McLaren" => "McLaren",
		"Meddon" => "Meddon",
		"MedievalSharp" => "MedievalSharp",
		"Medula One" => "Medula One",
		"Megrim" => "Megrim",
		"Meie Script" => "Meie Script",
		"Merienda One" => "Merienda One",
		"Merriweather" => "Merriweather",
		"Metal" => "Metal",
		"Metal Mania" => "Metal Mania",
		"Metamorphous" => "Metamorphous",
		"Metrophobic" => "Metrophobic",
		"Michroma" => "Michroma",
		"Miltonian" => "Miltonian",
		"Miltonian Tattoo" => "Miltonian Tattoo",
		"Miniver" => "Miniver",
		"Miss Fajardose" => "Miss Fajardose",
		"Modern Antiqua" => "Modern Antiqua",
		"Molengo" => "Molengo",
		"Monofett" => "Monofett",
		"Monoton" => "Monoton",
		"Monsieur La Doulaise" => "Monsieur La Doulaise",
		"Montaga" => "Montaga",
		"Montez" => "Montez",
		"Montserrat" => "Montserrat",
		"Moul" => "Moul",
		"Moulpali" => "Moulpali",
		"Mountains of Christmas" => "Mountains of Christmas",
		"Mr Bedfort" => "Mr Bedfort",
		"Mr Dafoe" => "Mr Dafoe",
		"Mr De Haviland" => "Mr De Haviland",
		"Mrs Saint Delafield" => "Mrs Saint Delafield",
		"Mrs Sheppards" => "Mrs Sheppards",
		"Muli" => "Muli",
		"Mystery Quest" => "Mystery Quest",
		"Neucha" => "Neucha",
		"Neuton" => "Neuton",
		"News Cycle" => "News Cycle",
		"Niconne" => "Niconne",
		"Nixie One" => "Nixie One",
		"Nobile" => "Nobile",
		"Nokora" => "Nokora",
		"Norican" => "Norican",
		"Nosifer" => "Nosifer",
		"Nothing You Could Do" => "Nothing You Could Do",
		"Noticia Text" => "Noticia Text",
		"Nova Cut" => "Nova Cut",
		"Nova Flat" => "Nova Flat",
		"Nova Mono" => "Nova Mono",
		"Nova Oval" => "Nova Oval",
		"Nova Round" => "Nova Round",
		"Nova Script" => "Nova Script",
		"Nova Slim" => "Nova Slim",
		"Nova Square" => "Nova Square",
		"Numans" => "Numans",
		"Nunito" => "Nunito",
		"Odor Mean Chey" => "Odor Mean Chey",
		"Old Standard TT" => "Old Standard TT",
		"Oldenburg" => "Oldenburg",
		"Oleo Script" => "Oleo Script",
		"Open Sans" => "Open Sans",
		"Open Sans Condensed" => "Open Sans Condensed",
		"Oranienbaum" => "Oranienbaum",
		"Orbitron" => "Orbitron",
		"Oregano" => "Oregano",
		"Orienta" => "Orienta",
		"Original Surfer" => "Original Surfer",
		"Oswald" => "Oswald",
		"Over the Rainbow" => "Over the Rainbow",
		"Overlock" => "Overlock",
		"Overlock SC" => "Overlock SC",
		"Ovo" => "Ovo",
		"Oxygen" => "Oxygen",
		"Oxygen Mono" => "Oxygen Mono",
		"PT Mono" => "PT Mono",
		"PT Sans" => "PT Sans",
		"PT Sans Caption" => "PT Sans Caption",
		"PT Sans Narrow" => "PT Sans Narrow",
		"PT Serif" => "PT Serif",
		"PT Serif Caption" => "PT Serif Caption",
		"Pacifico" => "Pacifico",
		"Parisienne" => "Parisienne",
		"Passero One" => "Passero One",
		"Passion One" => "Passion One",
		"Patrick Hand" => "Patrick Hand",
		"Patua One" => "Patua One",
		"Paytone One" => "Paytone One",
		"Peralta" => "Peralta",
		"Permanent Marker" => "Permanent Marker",
		"Petit Formal Script" => "Petit Formal Script",
		"Petrona" => "Petrona",
		"Philosopher" => "Philosopher",
		"Piedra" => "Piedra",
		"Pinyon Script" => "Pinyon Script",
		"Plaster" => "Plaster",
		"Play" => "Play",
		"Playball" => "Playball",
		"Playfair Display" => "Playfair Display",
		"Podkova" => "Podkova",
		"Poiret One" => "Poiret One",
		"Poller One" => "Poller One",
		"Poly" => "Poly",
		"Pompiere" => "Pompiere",
		"Pontano Sans" => "Pontano Sans",
		"Port Lligat Sans" => "Port Lligat Sans",
		"Port Lligat Slab" => "Port Lligat Slab",
		"Prata" => "Prata",
		"Preahvihear" => "Preahvihear",
		"Press Start 2P" => "Press Start 2P",
		"Princess Sofia" => "Princess Sofia",
		"Prociono" => "Prociono",
		"Prosto One" => "Prosto One",
		"Puritan" => "Puritan",
		"Quando" => "Quando",
		"Quantico" => "Quantico",
		"Quattrocento" => "Quattrocento",
		"Quattrocento Sans" => "Quattrocento Sans",
		"Questrial" => "Questrial",
		"Quicksand" => "Quicksand",
		"Qwigley" => "Qwigley",
		"Racing Sans One" => "Racing Sans One",
		"Radley" => "Radley",
		"Raleway" => "Raleway",
		"Raleway Dots" => "Raleway Dots",
		"Rammetto One" => "Rammetto One",
		"Ranchers" => "Ranchers",
		"Rancho" => "Rancho",
		"Rationale" => "Rationale",
		"Redressed" => "Redressed",
		"Reenie Beanie" => "Reenie Beanie",
		"Revalia" => "Revalia",
		"Ribeye" => "Ribeye",
		"Ribeye Marrow" => "Ribeye Marrow",
		"Righteous" => "Righteous",
		"Rochester" => "Rochester",
		"Rock Salt" => "Rock Salt",
		"Rokkitt" => "Rokkitt",
		"Romanesco" => "Romanesco",
		"Ropa Sans" => "Ropa Sans",
		"Rosario" => "Rosario",
		"Rosarivo" => "Rosarivo",
		"Rouge Script" => "Rouge Script",
		"Ruda" => "Ruda",
		"Ruge Boogie" => "Ruge Boogie",
		"Ruluko" => "Ruluko",
		"Ruslan Display" => "Ruslan Display",
		"Russo One" => "Russo One",
		"Ruthie" => "Ruthie",
		"Rye" => "Rye",
		"Sail" => "Sail",
		"Salsa" => "Salsa",
		"Sancreek" => "Sancreek",
		"Sansita One" => "Sansita One",
		"Sarina" => "Sarina",
		"Satisfy" => "Satisfy",
		"Schoolbell" => "Schoolbell",
		"Seaweed Script" => "Seaweed Script",
		"Sevillana" => "Sevillana",
		"Shadows Into Light" => "Shadows Into Light",
		"Shadows Into Light Two" => "Shadows Into Light Two",
		"Shanti" => "Shanti",
		"Share" => "Share",
		"Shojumaru" => "Shojumaru",
		"Short Stack" => "Short Stack",
		"Siemreap" => "Siemreap",
		"Sigmar One" => "Sigmar One",
		"Signika" => "Signika",
		"Signika Negative" => "Signika Negative",
		"Simonetta" => "Simonetta",
		"Sirin Stencil" => "Sirin Stencil",
		"Six Caps" => "Six Caps",
		"Skranji" => "Skranji",
		"Slackey" => "Slackey",
		"Smokum" => "Smokum",
		"Smythe" => "Smythe",
		"Sniglet" => "Sniglet",
		"Snippet" => "Snippet",
		"Sofia" => "Sofia",
		"Sonsie One" => "Sonsie One",
		"Sorts Mill Goudy" => "Sorts Mill Goudy",
		"Source Sans Pro" => "Source Sans Pro",
		"Special Elite" => "Special Elite",
		"Spicy Rice" => "Spicy Rice",
		"Spinnaker" => "Spinnaker",
		"Spirax" => "Spirax",
		"Squada One" => "Squada One",
		"Stardos Stencil" => "Stardos Stencil",
		"Stint Ultra Condensed" => "Stint Ultra Condensed",
		"Stint Ultra Expanded" => "Stint Ultra Expanded",
		"Stoke" => "Stoke",
		"Sue Ellen Francisco" => "Sue Ellen Francisco",
		"Sunshiney" => "Sunshiney",
		"Supermercado One" => "Supermercado One",
		"Suwannaphum" => "Suwannaphum",
		"Swanky and Moo Moo" => "Swanky and Moo Moo",
		"Syncopate" => "Syncopate",
		"Tangerine" => "Tangerine",
		"Taprom" => "Taprom",
		"Telex" => "Telex",
		"Tenor Sans" => "Tenor Sans",
		"The Girl Next Door" => "The Girl Next Door",
		"Tienne" => "Tienne",
		"Tinos" => "Tinos",
		"Titan One" => "Titan One",
		"Trade Winds" => "Trade Winds",
		"Trocchi" => "Trocchi",
		"Trochut" => "Trochut",
		"Trykker" => "Trykker",
		"Tulpen One" => "Tulpen One",
		"Ubuntu" => "Ubuntu",
		"Ubuntu Condensed" => "Ubuntu Condensed",
		"Ubuntu Mono" => "Ubuntu Mono",
		"Ultra" => "Ultra",
		"Uncial Antiqua" => "Uncial Antiqua",
		"UnifrakturCook" => "UnifrakturCook",
		"UnifrakturMaguntia" => "UnifrakturMaguntia",
		"Unkempt" => "Unkempt",
		"Unlock" => "Unlock",
		"Unna" => "Unna",
		"VT323" => "VT323",
		"Varela" => "Varela",
		"Varela Round" => "Varela Round",
		"Vast Shadow" => "Vast Shadow",
		"Vibur" => "Vibur",
		"Vidaloka" => "Vidaloka",
		"Viga" => "Viga",
		"Voces" => "Voces",
		"Volkhov" => "Volkhov",
		"Vollkorn" => "Vollkorn",
		"Voltaire" => "Voltaire",
		"Waiting for the Sunrise" => "Waiting for the Sunrise",
		"Wallpoet" => "Wallpoet",
		"Walter Turncoat" => "Walter Turncoat",
		"Warnes" => "Warnes",
		"Wellfleet" => "Wellfleet",
		"Wire One" => "Wire One",
		"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
		"Yellowtail" => "Yellowtail",
		"Yeseva One" => "Yeseva One",
		"Yesteryear" => "Yesteryear",
		"Zeyada" => "Zeyad"
		);
	return $google_faces;
}

?>