<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function formulaires_inscription_complete_saisies_dist($statut = '6forum') {

	// Charger les saisies du formulaire de modification d'auteur
	$saisie_compte = charger_fonction('saisies', 'formulaires/modifier_compte');
	$saisies = $saisie_compte();

	// Quelques remplacement pour être conforme avec les fonctions du formulaire
	// d'inscription
	include_spip('inc/saisies');
	$saisies = saisies_transformer_noms($saisies, '#nom#', 'nom_inscription');
	$saisies = saisies_transformer_noms($saisies, '#email#', 'mail_inscription');

	return $saisies;
}

/**
 *	 Fonction de vérification, cela fonction avec un tableau d'erreur.
 *	 Le tableau est formater de la sorte:
 *	 if (!_request('NomErreur')) {
 *		 $erreurs['message_erreur'] = '';
 *		 $erreurs['NomErreur'] = '';
 *	 }
 *	 Pensez à utiliser _T('info_obligatoire'); pour les éléments obligatoire.
 */
function formulaires_inscription_complete_verifier_dist($statut = '6forum') {
	$erreurs = array();

	// Charger la fonction de vérification du formulaire d'inscription
	$verifications = charger_fonction('verifier', 'formulaires/inscription');
	$erreurs = $verifications($statut);

	return $erreurs;
}

function formulaires_inscription_complete_traiter_dist() {
    //Traitement du formulaire.

    // Donnée de retour.
    return array(
        'editable' => true,
        'message_ok' => '',
        'redirect' => ''
    );
}