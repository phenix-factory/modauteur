<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function formulaires_configurer_modauteur_saisies_dist() {
	$saisies = array(
	);

	$plugin = charger_filtre('info_plugin');
	if ($plugin('uploadhtml5', 'est_actif')) {
		$saisies[] = array(
			'saisie' => 'case',
			'options' => array(
				'nom' => 'uploadhtml5_logo',
				'label' => _T('modauteur:logo_with_uploadhtml5'),
				'label_case' => _T('modauteur:case_logo_with_uploadhtml5')
			)
		);
	}

	return $saisies;
}

function formulaires_configurer_modauteur_charger_dist() {
	// Contexte du formulaire.
	include_spip('inc/config');
	$config = lire_config('modauteur');
	return (empty($config)) ? array() : $config;
}
