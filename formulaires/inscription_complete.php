<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function formulaires_inscription_complete_saisies_dist($statut = '6forum', $cextra_position = 0) {

	// Charger les saisies du formulaire de modification d'auteur
	$saisie_compte = charger_fonction('saisies', 'formulaires/modifier_compte');
	$saisies = $saisie_compte(null, $cextra_position);

	// Quelques remplacement pour être conforme avec les fonctions du formulaire
	// d'inscription
	include_spip('inc/saisies');
	$saisies = saisies_transformer_noms($saisies, '#^nom$#', 'nom_inscription');
	$saisies = saisies_transformer_noms($saisies, '#^email$#', 'mail_inscription');

	// On ne veux surtout pas créer de password
	$saisies = saisies_supprimer($saisies, 'danger_zone');

	return $saisies;
}

function formulaires_inscription_complete_charger_dist($statut = '6forum', $cextra_position = 0) {
	$charger = array();

	// Si la configuration des inscriptions du mode est désactivée, on le
	// signale par une erreur et on ne laisse pas le formulaire s'afficher
	include_spip('inc/autoriser');
	if (!autoriser('inscrireauteur', $statut)) {
		include_spip('inc/filtres_ecrire');
		$charger['message_erreur'] = _T(
			'modauteur:inscription_desactive',
			array('statut' => traduire_statut_auteur($statut))
		);
		$charger['editable'] = false;
	}

	return $charger;
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
function formulaires_inscription_complete_verifier_dist($statut = '6forum', $cextra_position = 0) {
	$erreurs = array();

	// Charger la fonction de vérification du formulaire d'inscription
	$verifications = charger_fonction('verifier', 'formulaires/inscription');
	$erreurs = $verifications($statut);

	// En cas de petit malin
	set_request('new_pass', null);
	set_request('new_pass2', null);

	return $erreurs;
}

function formulaires_inscription_complete_traiter_dist($statut = '6forum', $cextra_position = 0) {
	//Traitement du formulaire.
	$traitement = charger_fonction('traiter', 'formulaires/inscription');
	$res = $traitement($statut);

	// On exécute le pipeline formulaire traiter du formulaire d'inscription
	$res = pipeline(
		'formulaire_traiter',
		array(
			'args' => array('form' => 'inscription', 'args' => array()),
			'data' => $res
		)
	);

	// On veux que le mail ne change pas.
	set_request('email', _request('mail_inscription'));

	// Ajouter les informations supplémentaire
	include_spip('inc/autoriser');
	autoriser_exception('modifier', 'auteur', $res['id_auteur']);
	$formulaire_editer_auteur = charger_fonction('traiter', 'formulaires/modifier_compte');
	$formulaire_editer_auteur($res['id_auteur']);
	autoriser_exception('modifier', 'auteur', $res['id_auteur'], false);

	// Donnée de retour.
	return $res;
}
