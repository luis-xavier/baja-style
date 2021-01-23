<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( function_exists( 'vc_add_shortcode_param' ) ) {

	function grve_osmosis_vce_icon_settings_field( $param, $param_value ) {
		$dependency = '';

		$subset = $subset_class = '';
		if( isset( $param['param_subset'] ) ) {
			$subset = $param['param_subset'];
			$subset_class = 'grve-subset';
		}

		return '<div class="grve-modal-select-icon-container ' . $subset_class . '">'
				. grve_get_awsome_fonts_icons( $subset ) .
				'</div>' .
				'<input type="hidden" name="' . $param['param_name'] . '" id="grve-icon-field" class="wpb_vc_param_value grve-modal-textfield' . $param['param_name'] . ' ' . $param['type'] . '_field" value="' . $param_value . '" ' . $dependency . '/>'
				;

	}
	vc_add_shortcode_param( 'grve_icon', 'grve_osmosis_vce_icon_settings_field', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL . '/assets/js/grve-icon-preview.js' );

	function grve_osmosis_vce_multi_checkbox_settings_field( $param, $param_value ) {

		$param_line = '';
		$current_value = explode(",", $param_value);
		$values = is_array($param['value']) ? $param['value'] : array();

		foreach ( $values as $label => $v ) {
			$checked = in_array($v, $current_value) ? ' checked="checked"' : '';
			$checkbox_input_class = 'grve-checkbox-input-item';
			$checkbox_class = 'grve-checkbox-item';
			if ( '' == $v ) {
				$checkbox_input_class = 'grve-checkbox-input-item-all';
				$checkbox_class = 'grve-checkbox-item grve-checkbox-item-all';
			}
			$param_line .= '<div class="' . $checkbox_class . '"><input id="'. $param['param_name'] . '-' . $v .'" value="' . $v . '" class="'. $checkbox_input_class .'" type="checkbox" '.$checked.'> ' . __($label, "js_composer") . '</div>';
		}

		return '<div class="grve-multi-checkbox-container">' .
			   '  <input class="wpb_vc_param_value wpb-checkboxes '.$param['param_name'].' '.$param['type'].'_field" type="hidden" value="'.$param_value.'" name="'.$param['param_name'].'"/>'
				. $param_line .
				'</div>';

	}
	vc_add_shortcode_param( 'grve_multi_checkbox', 'grve_osmosis_vce_multi_checkbox_settings_field', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL . '/assets/js/grve-multi-checkbox.js' );

}

if ( ! function_exists( 'grve_get_awsome_fonts_icons' ) ) {

	function grve_get_awsome_fonts_icons( $subset = '' ) {
		//Font Awesome 4.7.0
		if ( empty( $subset ) ) {
			$grve_awsome_fonts = array( "500px", "address-book", "address-book-o", "address-card", "address-card-o", "adjust", "adn", "align-center", "align-justify", "align-left", "align-right", "amazon", "ambulance", "american-sign-language-interpreting", "anchor", "android", "angellist", "angle-double-down", "angle-double-left", "angle-double-right", "angle-double-up", "angle-down", "angle-left", "angle-right", "angle-up", "apple", "archive", "area-chart", "arrow-circle-down", "arrow-circle-left", "arrow-circle-o-down", "arrow-circle-o-left", "arrow-circle-o-right", "arrow-circle-o-up", "arrow-circle-right", "arrow-circle-up", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "arrows", "arrows-alt", "arrows-h", "arrows-v", "asl-interpreting", "assistive-listening-systems", "asterisk", "at", "audio-description", "automobile", "backward", "balance-scale", "ban", "bandcamp", "bank", "bar-chart", "bar-chart-o", "barcode", "bars", "bath", "bathtub", "battery", "battery-0", "battery-1", "battery-2", "battery-3", "battery-4", "battery-empty", "battery-full", "battery-half", "battery-quarter", "battery-three-quarters", "bed", "beer", "behance", "behance-square", "bell", "bell-o", "bell-slash", "bell-slash-o", "bicycle", "binoculars", "birthday-cake", "bitbucket", "bitbucket-square", "bitcoin", "black-tie", "blind", "bluetooth", "bluetooth-b", "bold", "bolt", "bomb", "book", "bookmark", "bookmark-o", "braille", "briefcase", "btc", "bug", "building", "building-o", "bullhorn", "bullseye", "bus", "buysellads", "cab", "calculator", "calendar", "calendar-check-o", "calendar-minus-o", "calendar-o", "calendar-plus-o", "calendar-times-o", "camera", "camera-retro", "car", "caret-down", "caret-left", "caret-right", "caret-square-o-down", "caret-square-o-left", "caret-square-o-right", "caret-square-o-up", "caret-up", "cart-arrow-down", "cart-plus", "cc", "cc-amex", "cc-diners-club", "cc-discover", "cc-jcb", "cc-mastercard", "cc-paypal", "cc-stripe", "cc-visa", "certificate", "chain", "chain-broken", "check", "check-circle", "check-circle-o", "check-square", "check-square-o", "chevron-circle-down", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "child", "chrome", "circle", "circle-o", "circle-o-notch", "circle-thin", "clipboard", "clock-o", "clone", "close", "cloud", "cloud-download", "cloud-upload", "cny", "code", "code-fork", "codepen", "codiepie", "coffee", "cog", "cogs", "columns", "comment", "comment-o", "commenting", "commenting-o", "comments", "comments-o", "compass", "compress", "connectdevelop", "contao", "copy", "copyright", "creative-commons", "credit-card", "credit-card-alt", "crop", "crosshairs", "css3", "cube", "cubes", "cut", "cutlery", "dashboard", "dashcube", "database", "deaf", "deafness", "dedent", "delicious", "desktop", "deviantart", "diamond", "digg", "dollar", "dot-circle-o", "download", "dribbble", "drivers-license", "drivers-license-o", "dropbox", "drupal", "edge", "edit", "eercast", "eject", "ellipsis-h", "ellipsis-v", "empire", "envelope", "envelope-o", "envelope-open", "envelope-open-o", "envelope-square", "envira", "eraser", "etsy", "eur", "euro", "exchange", "exclamation", "exclamation-circle", "exclamation-triangle", "expand", "expeditedssl", "external-link", "external-link-square", "eye", "eye-slash", "eyedropper", "fa", "facebook", "facebook-f", "facebook-official", "facebook-square", "fast-backward", "fast-forward", "fax", "feed", "female", "fighter-jet", "file", "file-archive-o", "file-audio-o", "file-code-o", "file-excel-o", "file-image-o", "file-movie-o", "file-o", "file-pdf-o", "file-photo-o", "file-picture-o", "file-powerpoint-o", "file-sound-o", "file-text", "file-text-o", "file-video-o", "file-word-o", "file-zip-o", "files-o", "film", "filter", "fire", "fire-extinguisher", "firefox", "first-order", "flag", "flag-checkered", "flag-o", "flash", "flask", "flickr", "floppy-o", "folder", "folder-o", "folder-open", "folder-open-o", "font", "font-awesome", "fonticons", "fort-awesome", "forumbee", "forward", "foursquare", "free-code-camp", "frown-o", "futbol-o", "gamepad", "gavel", "gbp", "ge", "gear", "gears", "genderless", "get-pocket", "gg", "gg-circle", "gift", "git", "git-square", "github", "github-alt", "github-square", "gitlab", "gittip", "glass", "glide", "glide-g", "globe", "google", "google-plus", "google-plus-circle", "google-plus-official", "google-plus-square", "google-wallet", "graduation-cap", "gratipay", "grav", "group", "h-square", "hacker-news", "hand-grab-o", "hand-lizard-o", "hand-o-down", "hand-o-left", "hand-o-right", "hand-o-up", "hand-paper-o", "hand-peace-o", "hand-pointer-o", "hand-rock-o", "hand-scissors-o", "hand-spock-o", "hand-stop-o", "handshake-o", "hard-of-hearing", "hashtag", "hdd-o", "header", "headphones", "heart", "heart-o", "heartbeat", "history", "home", "hospital-o", "hotel", "hourglass", "hourglass-1", "hourglass-2", "hourglass-3", "hourglass-end", "hourglass-half", "hourglass-o", "hourglass-start", "houzz", "html5", "i-cursor", "id-badge", "id-card", "id-card-o", "ils", "image", "imdb", "inbox", "indent", "industry", "info", "info-circle", "inr", "instagram", "institution", "internet-explorer", "intersex", "ioxhost", "italic", "joomla", "jpy", "jsfiddle", "key", "keyboard-o", "krw", "language", "laptop", "lastfm", "lastfm-square", "leaf", "leanpub", "legal", "lemon-o", "level-down", "level-up", "life-bouy", "life-buoy", "life-ring", "life-saver", "lightbulb-o", "line-chart", "link", "linkedin", "linkedin-square", "linode", "linux", "list", "list-alt", "list-ol", "list-ul", "location-arrow", "lock", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "low-vision", "magic", "magnet", "mail-forward", "mail-reply", "mail-reply-all", "male", "map", "map-marker", "map-o", "map-pin", "map-signs", "mars", "mars-double", "mars-stroke", "mars-stroke-h", "mars-stroke-v", "maxcdn", "meanpath", "medium", "medkit", "meetup", "meh-o", "mercury", "microchip", "microphone", "microphone-slash", "minus", "minus-circle", "minus-square", "minus-square-o", "mixcloud", "mobile", "mobile-phone", "modx", "money", "moon-o", "mortar-board", "motorcycle", "mouse-pointer", "music", "navicon", "neuter", "newspaper-o", "object-group", "object-ungroup", "odnoklassniki", "odnoklassniki-square", "opencart", "openid", "opera", "optin-monster", "outdent", "pagelines", "paint-brush", "paper-plane", "paper-plane-o", "paperclip", "paragraph", "paste", "pause", "pause-circle", "pause-circle-o", "paw", "paypal", "pencil", "pencil-square", "pencil-square-o", "percent", "phone", "phone-square", "photo", "picture-o", "pie-chart", "pied-piper", "pied-piper-alt", "pied-piper-pp", "pinterest", "pinterest-p", "pinterest-square", "plane", "play", "play-circle", "play-circle-o", "plug", "plus", "plus-circle", "plus-square", "plus-square-o", "podcast", "power-off", "print", "product-hunt", "puzzle-piece", "qq", "qrcode", "question", "question-circle", "question-circle-o", "quora", "quote-left", "quote-right", "ra", "random", "ravelry", "rebel", "recycle", "reddit", "reddit-alien", "reddit-square", "refresh", "registered", "remove", "renren", "reorder", "repeat", "reply", "reply-all", "resistance", "retweet", "rmb", "road", "rocket", "rotate-left", "rotate-right", "rouble", "rss", "rss-square", "rub", "ruble", "rupee", "s15", "safari", "save", "scissors", "scribd", "search", "search-minus", "search-plus", "sellsy", "send", "send-o", "server", "share", "share-alt", "share-alt-square", "share-square", "share-square-o", "shekel", "sheqel", "shield", "ship", "shirtsinbulk", "shopping-bag", "shopping-basket", "shopping-cart", "shower", "sign-in", "sign-language", "sign-out", "signal", "signing", "simplybuilt", "sitemap", "skyatlas", "skype", "slack", "sliders", "slideshare", "smile-o", "snapchat", "snapchat-ghost", "snapchat-square", "snowflake-o", "soccer-ball-o", "sort", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-asc", "sort-desc", "sort-down", "sort-numeric-asc", "sort-numeric-desc", "sort-up", "soundcloud", "space-shuttle", "spinner", "spoon", "spotify", "square", "square-o", "stack-exchange", "stack-overflow", "star", "star-half", "star-half-empty", "star-half-full", "star-half-o", "star-o", "steam", "steam-square", "step-backward", "step-forward", "stethoscope", "sticky-note", "sticky-note-o", "stop", "stop-circle", "stop-circle-o", "street-view", "strikethrough", "stumbleupon", "stumbleupon-circle", "subscript", "subway", "suitcase", "sun-o", "superpowers", "superscript", "support", "table", "tablet", "tachometer", "tag", "tags", "tasks", "taxi", "telegram", "television", "tencent-weibo", "terminal", "text-height", "text-width", "th", "th-large", "th-list", "themeisle", "thermometer", "thermometer-0", "thermometer-1", "thermometer-2", "thermometer-3", "thermometer-4", "thermometer-empty", "thermometer-full", "thermometer-half", "thermometer-quarter", "thermometer-three-quarters", "thumb-tack", "thumbs-down", "thumbs-o-down", "thumbs-o-up", "thumbs-up", "ticket", "times", "times-circle", "times-circle-o", "times-rectangle", "times-rectangle-o", "tint", "toggle-down", "toggle-left", "toggle-off", "toggle-on", "toggle-right", "toggle-up", "trademark", "train", "transgender", "transgender-alt", "trash", "trash-o", "tree", "trello", "tripadvisor", "trophy", "truck", "try", "tty", "tumblr", "tumblr-square", "turkish-lira", "tv", "twitch", "twitter", "twitter-square", "umbrella", "underline", "undo", "universal-access", "university", "unlink", "unlock", "unlock-alt", "unsorted", "upload", "usb", "usd", "user", "user-circle", "user-circle-o", "user-md", "user-o", "user-plus", "user-secret", "user-times", "users", "vcard", "vcard-o", "venus", "venus-double", "venus-mars", "viacoin", "viadeo", "viadeo-square", "video-camera", "vimeo", "vimeo-square", "vine", "vk", "volume-control-phone", "volume-down", "volume-off", "volume-up", "warning", "wechat", "weibo", "weixin", "whatsapp", "wheelchair", "wheelchair-alt", "wifi", "wikipedia-w", "window-close", "window-close-o", "window-maximize", "window-minimize", "window-restore", "windows", "won", "wordpress", "wpbeginner", "wpexplorer", "wpforms", "wrench", "xing", "xing-square", "y-combinator", "y-combinator-square", "yahoo", "yc", "yc-square", "yelp", "yen", "yoast", "youtube", "youtube-play", "youtube-square" );
		} else {
			$grve_awsome_fonts = array(
				"check",
				"check-square",
				"check-square-o",
				"minus",
				"minus-square",
				"minus-square-o",
				"plus",
				"plus-square",
				"plus-square-o",
				"circle",
				"circle-o",
				"dot-circle-o",
				"square",
				"square-o",
				"info-circle",
				"pencil",
				"angle-right",
				"angle-double-right",
				"hand-o-right",
				"thumbs-o-up",
				"thumbs-up",
				"thumbs-o-down",
				"thumbs-down",
			);
		}

		$options_number = count( $grve_awsome_fonts );
		$printable_awsome_fonts = "";

		for ( $i=0; $i < $options_number; $i++ ) {
			$printable_awsome_fonts .= '<i data-icon-value="' . $grve_awsome_fonts[ $i ] . '" class="grve-modal-icon-preview fa fa-' . $grve_awsome_fonts[ $i ] . '" title="' . $grve_awsome_fonts[ $i ] . '"></i>';
		}
		return $printable_awsome_fonts;
	}

}

function grve_osmosis_vce_iconpicker_type_simplelineicons( $icons ) {
	$simplelineicons_icons = array(
		array( 'smp-icon-user' => 'smp-icon-user' ),
		array( 'smp-icon-people' => 'smp-icon-people' ),
		array( 'smp-icon-user-female' => 'smp-icon-user-female' ),
		array( 'smp-icon-user-follow' => 'smp-icon-user-follow' ),
		array( 'smp-icon-user-following' => 'smp-icon-user-following' ),
		array( 'smp-icon-user-unfollow' => 'smp-icon-user-unfollow' ),
		array( 'smp-icon-login' => 'smp-icon-login' ),
		array( 'smp-icon-logout' => 'smp-icon-logout' ),
		array( 'smp-icon-emotsmile' => 'smp-icon-emotsmile' ),
		array( 'smp-icon-phone' => 'smp-icon-phone' ),
		array( 'smp-icon-call-end' => 'smp-icon-call-end' ),
		array( 'smp-icon-call-in' => 'smp-icon-call-in' ),
		array( 'smp-icon-call-out' => 'smp-icon-call-out' ),
		array( 'smp-icon-map' => 'smp-icon-map' ),
		array( 'smp-icon-location-pin' => 'smp-icon-location-pin' ),
		array( 'smp-icon-direction' => 'smp-icon-direction' ),
		array( 'smp-icon-directions' => 'smp-icon-directions' ),
		array( 'smp-icon-compass' => 'smp-icon-compass' ),
		array( 'smp-icon-layers' => 'smp-icon-layers' ),
		array( 'smp-icon-menu' => 'smp-icon-menu' ),
		array( 'smp-icon-list' => 'smp-icon-list' ),
		array( 'smp-icon-options-vertical' => 'smp-icon-options-vertical' ),
		array( 'smp-icon-options' => 'smp-icon-options' ),
		array( 'smp-icon-arrow-down' => 'smp-icon-arrow-down' ),
		array( 'smp-icon-arrow-left' => 'smp-icon-arrow-left' ),
		array( 'smp-icon-arrow-right' => 'smp-icon-arrow-right' ),
		array( 'smp-icon-arrow-up' => 'smp-icon-arrow-up' ),
		array( 'smp-icon-arrow-up-circle' => 'smp-icon-up-circle' ),
		array( 'smp-icon-arrow-left-circle' => 'smp-icon-left-circle' ),
		array( 'smp-icon-arrow-right-circle' => 'smp-icon-right-circle' ),
		array( 'smp-icon-arrow-down-circle' => 'smp-icon-down-circle' ),
		array( 'smp-icon-check' => 'smp-icon-check' ),
		array( 'smp-icon-clock' => 'smp-icon-clock' ),
		array( 'smp-icon-plus' => 'smp-icon-plus' ),
		array( 'smp-icon-close' => 'smp-icon-close' ),
		array( 'smp-icon-trophy' => 'smp-icon-trophy' ),
		array( 'smp-icon-screen-smartphone' => 'smp-icon-screen-smartphone' ),
		array( 'smp-icon-screen-desktop' => 'smp-icon-screen-desktop' ),
		array( 'smp-icon-plane' => 'smp-icon-plane' ),
		array( 'smp-icon-notebook' => 'smp-icon-notebook' ),
		array( 'smp-icon-mustache' => 'smp-icon-mustache' ),
		array( 'smp-icon-mouse' => 'smp-icon-mouse' ),
		array( 'smp-icon-magnet' => 'smp-icon-magnet' ),
		array( 'smp-icon-energy' => 'smp-icon-energy' ),
		array( 'smp-icon-disc' => 'smp-icon-disc' ),
		array( 'smp-icon-cursor' => 'smp-icon-cursor' ),
		array( 'smp-icon-cursor-move' => 'smp-icon-cursor-move' ),
		array( 'smp-icon-crop' => 'smp-icon-crop' ),
		array( 'smp-icon-chemistry' => 'smp-icon-chemistry' ),
		array( 'smp-icon-speedometer' => 'smp-icon-speedometer' ),
		array( 'smp-icon-shield' => 'smp-icon-shield' ),
		array( 'smp-icon-screen-tablet' => 'smp-icon-screen-tablet' ),
		array( 'smp-icon-magic-wand' => 'smp-icon-magic-wand' ),
		array( 'smp-icon-hourglass' => 'smp-icon-hourglass' ),
		array( 'smp-icon-graduation' => 'smp-icon-graduation' ),
		array( 'smp-icon-ghost' => 'smp-icon-ghost' ),
		array( 'smp-icon-game-controller' => 'smp-icon-game-controller' ),
		array( 'smp-icon-fire' => 'smp-icon-fire' ),
		array( 'smp-icon-eyeglass' => 'smp-icon-eyeglass' ),
		array( 'smp-icon-envelope-open' => 'smp-icon-envelope-open' ),
		array( 'smp-icon-envelope-letter' => 'smp-icon-envelope-letter' ),
		array( 'smp-icon-bell' => 'smp-icon-bell' ),
		array( 'smp-icon-badge' => 'smp-icon-badge' ),
		array( 'smp-icon-anchor' => 'smp-icon-anchor' ),
		array( 'smp-icon-wallet' => 'smp-icon-wallet' ),
		array( 'smp-icon-vector' => 'smp-icon-vector' ),
		array( 'smp-icon-speech' => 'smp-icon-speech' ),
		array( 'smp-icon-puzzle' => 'smp-icon-puzzle' ),
		array( 'smp-icon-printer' => 'smp-icon-printer' ),
		array( 'smp-icon-present' => 'smp-icon-present' ),
		array( 'smp-icon-playlist' => 'smp-icon-playlist' ),
		array( 'smp-icon-pin' => 'smp-icon-pin' ),
		array( 'smp-icon-picture' => 'smp-icon-picture' ),
		array( 'smp-icon-handbag' => 'smp-icon-handbag' ),
		array( 'smp-icon-globe-alt' => 'smp-icon-globe-alt' ),
		array( 'smp-icon-globe' => 'smp-icon-globe' ),
		array( 'smp-icon-folder-alt' => 'smp-icon-folder-alt' ),
		array( 'smp-icon-folder' => 'smp-icon-folder' ),
		array( 'smp-icon-film' => 'smp-icon-film' ),
		array( 'smp-icon-feed' => 'smp-icon-feed' ),
		array( 'smp-icon-drop' => 'smp-icon-drop' ),
		array( 'smp-icon-drawar' => 'smp-icon-drawar' ),
		array( 'smp-icon-docs' => 'smp-icon-docs' ),
		array( 'smp-icon-doc' => 'smp-icon-doc' ),
		array( 'smp-icon-diamond' => 'smp-icon-diamond' ),
		array( 'smp-icon-cup' => 'smp-icon-cup' ),
		array( 'smp-icon-calculator' => 'smp-icon-calculator' ),
		array( 'smp-icon-bubbles' => 'smp-icon-bubbles' ),
		array( 'smp-icon-briefcase' => 'smp-icon-briefcase' ),
		array( 'smp-icon-book-open' => 'smp-icon-book-open' ),
		array( 'smp-icon-basket-loaded' => 'smp-icon-basket-loaded' ),
		array( 'smp-icon-basket' => 'smp-icon-basket' ),
		array( 'smp-icon-bag' => 'smp-icon-bag' ),
		array( 'smp-icon-action-undo' => 'smp-icon-action-undo' ),
		array( 'smp-icon-action-redo' => 'smp-icon-user' ),
		array( 'smp-icon-wrench' => 'smp-icon-action-redo' ),
		array( 'smp-icon-umbrella' => 'smp-icon-umbrella' ),
		array( 'smp-icon-trash' => 'smp-icon-trash' ),
		array( 'smp-icon-tag' => 'smp-icon-tag' ),
		array( 'smp-icon-support' => 'smp-icon-support' ),
		array( 'smp-icon-frame' => 'smp-icon-frame' ),
		array( 'smp-icon-size-fullscreen' => 'smp-icon-size-fullscreen' ),
		array( 'smp-icon-size-actual' => 'smp-icon-size-actual' ),
		array( 'smp-icon-shuffle' => 'smp-icon-shuffle' ),
		array( 'smp-icon-share-alt' => 'smp-icon-share-alt' ),
		array( 'smp-icon-share' => 'smp-icon-share' ),
		array( 'smp-icon-rocket' => 'smp-icon-rocket' ),
		array( 'smp-icon-question' => 'smp-icon-question' ),
		array( 'smp-icon-pie-chart' => 'smp-icon-pie-chart' ),
		array( 'smp-icon-pencil' => 'smp-icon-pencil' ),
		array( 'smp-icon-note' => 'smp-icon-note' ),
		array( 'smp-icon-loop' => 'smp-icon-loop' ),
		array( 'smp-icon-home' => 'smp-icon-home' ),
		array( 'smp-icon-grid' => 'smp-icon-grid' ),
		array( 'smp-icon-graph' => 'smp-icon-graph' ),
		array( 'smp-icon-microphone' => 'smp-icon-microphone' ),
		array( 'smp-icon-music-tone-alt' => 'smp-icon-music-tone-alt' ),
		array( 'smp-icon-music-tone' => 'smp-icon-music-tone' ),
		array( 'smp-icon-earphones-alt' => 'smp-icon-earphones-alt' ),
		array( 'smp-icon-earphones' => 'smp-icon-earphones' ),
		array( 'smp-icon-equalizer' => 'smp-icon-equalizer' ),
		array( 'smp-icon-like' => 'smp-icon-like' ),
		array( 'smp-icon-dislike' => 'smp-icon-dislike' ),
		array( 'smp-icon-control-start' => 'smp-icon-control-start' ),
		array( 'smp-icon-control-rewind' => 'smp-icon-control-rewind' ),
		array( 'smp-icon-control-play' => 'smp-icon-control-play' ),
		array( 'smp-icon-control-pause' => 'smp-icon-control-pause' ),
		array( 'smp-icon-control-forward' => 'smp-icon-control-forward' ),
		array( 'smp-icon-control-end' => 'smp-icon-control-end' ),
		array( 'smp-icon-volume-1' => 'smp-icon-volume-1' ),
		array( 'smp-icon-volume-2' => 'smp-icon-volume-2' ),
		array( 'smp-icon-volume-off' => 'smp-icon-volume-off' ),
		array( 'smp-icon-calendar' => 'smp-icon-calendar' ),
		array( 'smp-icon-bulb' => 'smp-icon-bulb' ),
		array( 'smp-icon-chart' => 'smp-icon-chart' ),
		array( 'smp-icon-ban' => 'smp-icon-ban' ),
		array( 'smp-icon-bubble' => 'smp-icon-bubble' ),
		array( 'smp-icon-camrecorder' => 'smp-icon-camrecorder' ),
		array( 'smp-icon-camera' => 'smp-icon-camera' ),
		array( 'smp-icon-cloud-download' => 'smp-icon-cloud-download' ),
		array( 'smp-icon-cloud-upload' => 'smp-icon-cloud-upload' ),
		array( 'smp-icon-envelope' => 'smp-icon-envelope' ),
		array( 'smp-icon-eye' => 'smp-icon-eye' ),
		array( 'smp-icon-flag' => 'smp-icon-flag' ),
		array( 'smp-icon-heart' => 'smp-icon-heart' ),
		array( 'smp-icon-info' => 'smp-icon-info' ),
		array( 'smp-icon-key' => 'smp-icon-key' ),
		array( 'smp-icon-link' => 'smp-icon-link' ),
		array( 'smp-icon-lock' => 'smp-icon-lock' ),
		array( 'smp-icon-lock-open' => 'smp-icon-lock-open' ),
		array( 'smp-icon-magnifier' => 'smp-icon-magnifier' ),
		array( 'smp-icon-magnifier-add' => 'smp-icon-magnifier-add' ),
		array( 'smp-icon-magnifier-remove' => 'smp-icon-magnifier-remove' ),
		array( 'smp-icon-paper-clip' => 'smp-icon-paper-clip' ),
		array( 'smp-icon-paper-plane' => 'smp-icon-paper-plane' ),
		array( 'smp-icon-power' => 'smp-icon-power' ),
		array( 'smp-icon-refresh' => 'smp-icon-refresh' ),
		array( 'smp-icon-reload' => 'smp-icon-reload' ),
		array( 'smp-icon-settings' => 'smp-icon-settings' ),
		array( 'smp-icon-star' => 'smp-icon-star' ),
		array( 'smp-icon-symble-female' => 'smp-icon-symble-female' ),
		array( 'smp-icon-symbol-male' => 'smp-icon-symbol-male' ),
		array( 'smp-icon-target' => 'smp-icon-target' ),
		array( 'smp-icon-credit-card' => 'smp-icon-credit-card' ),
		array( 'smp-icon-paypal' => 'smp-icon-paypal' ),
		array( 'smp-icon-social-tumblr' => 'smp-icon-social-tumblr' ),
		array( 'smp-icon-social-twitter' => 'smp-icon-social-twitter' ),
		array( 'smp-icon-social-facebook' => 'smp-icon-social-facebook' ),
		array( 'smp-icon-social-instagram' => 'smp-icon-social-instagram' ),
		array( 'smp-icon-social-linkedin' => 'smp-icon-social-linkedin' ),
		array( 'smp-icon-social-pinterest' => 'smp-icon-social-pinterest' ),
		array( 'smp-icon-social-github' => 'smp-icon-social-github' ),
		array( 'smp-icon-social-gplus' => 'smp-icon-social-gplus' ),
		array( 'smp-icon-social-reddit' => 'smp-icon-social-reddit' ),
		array( 'smp-icon-social-skype' => 'smp-icon-social-skype' ),
		array( 'smp-icon-social-dribbble' => 'smp-icon-social-dribbble' ),
		array( 'smp-icon-social-behance' => 'smp-icon-social-behance' ),
		array( 'smp-icon-social-foursqare' => 'smp-icon-social-foursqare' ),
		array( 'smp-icon-social-soundcloud' => 'smp-icon-social-soundcloud' ),
		array( 'smp-icon-social-spotify' => 'smp-icon-social-spotify' ),
		array( 'smp-icon-social-stumbleupon' => 'smp-icon-social-stumbleupon' ),
		array( 'smp-icon-social-youtube' => 'smp-icon-social-youtube' ),
		array( 'smp-icon-social-dropbox' => 'smp-icon-social-dropbox' ),
	);

	return array_merge( $icons, $simplelineicons_icons );
}

add_filter( 'vc_iconpicker-type-simplelineicons', 'grve_osmosis_vce_iconpicker_type_simplelineicons' );


function grve_osmosis_vce_icon_element_fonts_enqueue( $font ) {
	switch ( $font ) {
		case 'simplelineicons':
			wp_enqueue_style( 'grve-vc-simple-line-icons' );
		break;
		default:
		break;
	}
}
add_action( 'vc_enqueue_font_icon_element', 'grve_osmosis_vce_icon_element_fonts_enqueue' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
