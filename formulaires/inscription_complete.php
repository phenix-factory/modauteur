<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function formulaires_inscription_complete_saisies_dist() {

    // Charger les saisies du formulaire de modification d'auteur
    $saisie_compte = charger_fonction('saisies', 'formulaires/modifier_compte');
    $saisies = $saisie_compte();

    return $saisies;
}

function formulaires_inscription_complete_charger_dist() {
    // Contexte du formulaire.
    $contexte = array(
        '' => '',
    );

    return $contexte;
}

/*
 *   Fonction de vérification, cela fonction avec un tableau d'erreur.
 *   Le tableau est formater de la sorte:
 *   if (!_request('NomErreur')) {
 *       $erreurs['message_erreur'] = '';
 *       $erreurs['NomErreur'] = '';
 *   }
 *   Pensez à utiliser _T('info_obligatoire'); pour les éléments obligatoire.
 */
function formulaires_inscription_complete_verifier_dist() {
    $erreurs = array();

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