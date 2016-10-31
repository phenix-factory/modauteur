<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * #CHERCHER_LOGO{objet, id_objet}
 * Retrouver le logo d'un objet sans avoir à lancer tout le système de boucle.
 *
 * @param mixed $p
 * @access public
 * @return mixed
 */
if (!function_exists('balise_CHERCHER_LOGO_dist')) {
	function balise_CHERCHER_LOGO_dist($p) {
		$objet = interprete_argument_balise(1, $p);
		$id_objet = interprete_argument_balise(2, $p);

		// Faire la conversion pour la fonction chercher_logo
		$objet = "id_table_objet($objet)";

		include_spip('inc/filtres');
		include_spip('public/quete');
		$p->code = "http_img_pack(_DIR_IMG.quete_logo($objet, 'on', $id_objet, '', true), '', 'class=\"spip_logos\"')";
		$p->interdire_scripts = false;

		return $p;
	}
}
