<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
 }

include_spip('inc/editer');
include_spip('formulaires/editer_auteur');
include_spip('inc/session');

function formulaires_modifier_compte_saisies_dist($id_auteur = null, $cextra_position = 0, $mode_new = '6forum') {

	// Le formulaire de base sans les saisies
	$saisies = array(
		'nom' => array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'nom',
				'label' => _T('entree_nom_pseudo')
			)
		),
		'email' => array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'email',
				'label' => _T('entree_adresse_email')
			),
			'verifier' => array(
				'type' => 'email',
				'options' => array(
					'disponible' => true,
					'id_auteur' => session_get('id_auteur')
				)
			)
		),
		'bio' => array(
			'saisie' => 'textarea',
			'options' => array(
				'nom' => 'bio',
				'explication' => _T('entree_biographie'),
				'label' => _T('entree_infos_perso'),
				'class' => 'inserer_barre_forum',
				'rows' => 3
			)
		),
		'password' => array(
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'danger_zone',
				'label' => _T('entree_nouveau_passe')
			),
			'saisies' => array(
				array(
					'saisie' => 'input',
					'options' => array(
						'nom' => 'new_pass',
						'type' => 'password',
						'label' => _T('entree_nouveau_passe')
					),
					'verifier' => array(
						'type' => 'password',
						'options' => array(
							'longueur' => 'spip',
							'match' => 'new_pass2'
						)
					)
				),
				array(
					'saisie' => 'input',
					'options' => array(
						'nom' => 'new_pass2',
						'type' => 'password',
						'label' => _T('info_confirmer_passe')
					)
				)
			)
		)
	);

	// Support du plugin champs extras
	$plugin = chercher_filtre('info_plugin');
	if ($plugin('cextras', 'est_actif')) {
		include_spip('cextras_pipelines');
		$champs_extras = champs_extras_objet('spip_auteurs');

		// On inject les champs extras via la fonction de bonux
		$saisies = spip_array_insert($saisies, $cextra_position, $champs_extras);
	}

	return $saisies;
}


function formulaires_modifier_compte_charger_dist($id_auteur = null, $cextra_position = 0, $mode_new = '6forum') {

	if (is_null($id_auteur)) {
		$id_auteur = session_get('id_auteur');
	}

	// Ne pas charger le formulaire si on a pas le droit de le modifier.
	if (!autoriser('modifier', 'auteur', intval($id_auteur))) {
		return false;
	}

	// On va charger la fonction du formulaire editer_auteur
	// Le but de la fonction étant le meme
	$formulaire_editer_auteur = charger_fonction('editer_auteur_charger', 'formulaires');
	$valeurs = $formulaire_editer_auteur($id_auteur);

	return $valeurs;
}

function formulaires_modifier_compte_traiter_dist($id_auteur = null, $cextra_position = 0, $mode_new = '6forum') {

	// on récupère l'id_auteur de la session
	if (is_null($id_auteur)) {
		$id_auteur = session_get('id_auteur');
	}

	// Dans le cas ou l'ont créer un auteur à partir de ce formulaire, on passe
	// le statut.
	if ($id_auteur == 'new') {
		set_request('statut', $mode_new);
	}

	// On va charger la fonction du formulaire editer_auteur
	// Le but de la fonction étant le meme
	$formulaire_editer_auteur = charger_fonction('editer_auteur_traiter', 'formulaires');
	$res = $formulaire_editer_auteur($id_auteur);

	// Pas de redirection
	$res['redirect'] = '';

	// On peu éditer le profile
	$res['editable'] = true;

	// Donnée de retour.
	return $res;
}
