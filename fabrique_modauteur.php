<?php

/**
 *  Fichier généré par la Fabrique de plugin v6
 *   le 2016-05-10 16:23:10
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined("_ECRIRE_INC_VERSION")) return;

$data = array (
  'fabrique' => 
  array (
    'version' => 6,
  ),
  'paquet' => 
  array (
    'prefixe' => 'modauteur',
    'nom' => 'Modifier auteur (publique)',
    'slogan' => '',
    'description' => 'Permettre aux visiteurs de modifier leur informations sur l\'espace publique',
    'version' => '1.0.0',
    'auteur' => 'Phenix',
    'auteur_lien' => 'http://p.henix.be',
    'licence' => 'GNU/GPL',
    'categorie' => 'auteur',
    'etat' => 'dev',
    'compatibilite' => '[3.1.1;3.1.*]',
    'documentation' => '',
    'administrations' => '',
    'schema' => '1.0.0',
    'formulaire_config' => '',
    'formulaire_config_titre' => '',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'options',
      3 => 'pipelines',
    ),
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => 'on',
  ),
  'objets' => 
  array (
  ),
  'images' => 
  array (
    'paquet' => 
    array (
      'logo' => 
      array (
        0 => 
        array (
          'extension' => 'png',
          'contenu' => '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',
        ),
      ),
    ),
    'objets' => 
    array (
    ),
  ),
);