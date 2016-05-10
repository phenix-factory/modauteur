<?php
/**
 * Définit les autorisations du plugin Modifier auteur (publique)
 *
 * @plugin     Modifier auteur (publique)
 * @copyright  2016
 * @author     Phenix
 * @licence    GNU/GPL
 * @package    SPIP\Modauteur\Autorisations
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/*
 * Un fichier d'autorisations permet de regrouper
 * les fonctions d'autorisations de votre plugin
 */

/**
 * Fonction d'appel pour le pipeline
 * @pipeline autoriser */
function modauteur_autoriser(){}


/**
 * Surcharge de la fonction d'autorisation des auteurs
 * Cela permet à un auteur de modifier son profile
 *
 * @param string $faire
 * @param string $type
 * @param int $id
 * @param mixed $qui
 * @param mixed $opt
 * @access public
 * @return bool
 */
function autoriser_auteur_modifier($faire, $type, $id, $qui, $opt) {

    include_spip('inc/session');

    // Il faut être connecté (et donc avec un id_auteur)
	if ($qui['id_auteur'] === 0) {
        return false;
    }

    // Si l'id_auteur est égale à celui de la session, on autorise
    if ($id == session_get('id_auteur')) {
        return true;
    }

	// Sinon, appeler l'autorisation de SPIP
    return autoriser_auteur_modifier_dist($faire, $type, $id, $qui, $opt);
}
