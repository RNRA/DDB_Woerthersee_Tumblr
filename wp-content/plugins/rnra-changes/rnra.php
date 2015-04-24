<?php

/*
  Plugin Name: RNRA Changes
  Plugin URI: http://rnra.de
  Description: Alle Änderungen an der Website
  Version: 1.0
  Author: Christian Schrut
  Author URI: http://rnra.de
 */

class RNRA {

	public static function init() {
		// Bühnen als Posttype hinzufügen
		Maxxdev_Helper_Posttype::registerPostTypeShort("stageslides", "Bühnen-Slides", "Bühnen-Slide");

		// Seite "stage" anlegen
		Maxxdev_Helper_Pages::createPage("Stage");
	}

}

class RNRA_Stage {

	public static function loadSlides() {
		$language = self::recognizeLanguage();

		return get_posts(array(
			"post_type" => "stageslides",
			"post_status" => "publish",
			"posts_per_page" => -1,
			"orderby" => "meta_value",
			"meta_key" => "slide_sort",
			"order" => "ASC",
			"meta_query" => array(
				array(
					"key" => "slide_language",
					"value" => $language
				)
			)
		));
	}

	private static function recognizeLanguage() {
		$language = $_GET["language"];
		$valid_languages = array("de", "en");
		$default_language = "de";

		if (in_array($language, $valid_languages)) {
			return $language;
		} else {
			return $default_language;
		}
	}

}

add_action("init", array(RNRA, "init"));
