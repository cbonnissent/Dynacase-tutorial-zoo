<?php
namespace Dcp\Family {
	/** classe  */
	class Zoo_classe extends \Dcp\Family\Document { const familyName="ZOO_CLASSE";}
	/** espèce  */
	class Zoo_espece extends \Zoo\Espece { const familyName="ZOO_ESPECE";}
	/** espèce menacée  */
	class Zoo_espece_menacee extends \Dcp\Family\Zoo_espece { const familyName="ZOO_ESPECE_MENACEE";}
	/** enclos  */
	class Zoo_enclos extends \Zoo\Enclos { const familyName="ZOO_ENCLOS";}
	/** animal  */
	class Zoo_animal extends \Zoo\Animal { const familyName="ZOO_ANIMAL";}
	/** carnet de sante  */
	class Zoo_carnetsante extends \Zoo\Carnet { const familyName="ZOO_CARNETSANTE";}
	/** entrée  */
	class Zoo_entree extends \Zoo\Entree { const familyName="ZOO_ENTREE";}
	/** Contact  */
	class Zoo_contact extends \Zoo\Contact { const familyName="ZOO_CONTACT";}
	/** Cuisinier  */
	class Zoo_demandeadoption extends \Zoo\Adoption { const familyName="ZOO_DEMANDEADOPTION";}
	/** Cycle demande Adoption  */
	class Zoo_wdemandeadoption extends \Zoo\WAdoption { const familyName="ZOO_WDEMANDEADOPTION";}
	/** Cycle Animal  */
	class Zoo_wanimal extends \Zoo\WAnimal { const familyName="ZOO_WANIMAL";}
	/** Gardien  */
	class Zoo_gardien extends \Dcp\Family\Iuser { const familyName="ZOO_GARDIEN";}
	/** Veterinaire  */
	class Zoo_veterinaire extends \Dcp\Family\Iuser { const familyName="ZOO_VETERINAIRE";}
	/** Cuisinier  */
	class Zoo_cuisinier extends \Zoo\Cuisinier { const familyName="ZOO_CUISINIER";}
}
namespace Dcp\AttributeIdentifiers {
	/** classe  */
	class Zoo_classe {
		/** [frame] Identification */
		const cl_identification='cl_identification';
		/** [text] nom scientifique */
		const cl_nomscientifique='cl_nomscientifique';
		/** [text] nom */
		const cl_nom='cl_nom';
		/** [longtext] caractéristique */
		const cl_caracteristique='cl_caracteristique';
	}
	/** espèce  */
	class Zoo_espece {
		/** [frame] Identification */
		const es_identification='es_identification';
		/** [text] nom */
		const es_nom='es_nom';
		/** [docid("ZOO_CLASSE")] classe */
		const es_classe='es_classe';
		/** [text] ordre */
		const es_ordre='es_ordre';
		/** [image] photo */
		const es_photo='es_photo';
		/** [enum] protégée */
		const es_protegee='es_protegee';
		/** [frame] caractéristique */
		const es_caracteristique='es_caracteristique';
		/** [enum] continents */
		const es_continent='es_continent';
		/** [double] poids */
		const es_poids='es_poids';
		/** [htmltext] Informations et répartition */
		const es_repartition='es_repartition';
		/** [text] alimentation */
		const es_alimentation='es_alimentation';
		/** [longtext] reproduction */
		const es_reproduction='es_reproduction';
		/** [text] habitat */
		const es_habitat='es_habitat';
		/** [longtext] comportement */
		const es_comportement='es_comportement';
		/** [menu] continents */
		const es_editcontinent='es_editcontinent';
	}
	/** enclos  */
	class Zoo_enclos {
		/** [frame] Identification */
		const en_identification='en_identification';
		/** [text] nom */
		const en_nom='en_nom';
		/** [text] référence */
		const en_reference='en_reference';
		/** [array] liste espèce */
		const en_t_especes='en_t_especes';
		/** [image] protégé */
		const en_espprotected='en_espprotected';
		/** [image] photo */
		const en_photo='en_photo';
		/** [docid("ZOO_ESPECE")] espèce */
		const en_espece='en_espece';
		/** [text] commentaire */
		const en_comment='en_comment';
		/** [int] capacité */
		const en_capacite='en_capacite';
		/** [frame] localisation */
		const en_localisation='en_localisation';
		/** [double] surface */
		const en_surface='en_surface';
		/** [text] Coordonnées */
		const en_coordonnees='en_coordonnees';
		/** [int] nombre d'animaux */
		const en_nbre='en_nbre';
		/** [frame] Contenu */
		const en_contenu='en_contenu';
		/** [array] liste animaux */
		const en_t_animaux='en_t_animaux';
		/** [docid("ZOO_ANIMAL")] animaux */
		const en_animaux='en_animaux';
	}
	/** animal  */
	class Zoo_animal {
		/** [frame] Identification */
		const an_identification='an_identification';
		/** [text] nom */
		const an_nom='an_nom';
		/** [int] tatouage */
		const an_tatouage='an_tatouage';
		/** [docid('ZOO_ESPECE')] espèce */
		const an_espece='an_espece';
		/** [text] espèce (titre) */
		const an_espece_title='an_espece_title';
		/** [text] ordre */
		const an_ordre='an_ordre';
		/** [docid("ZOO_CLASSE")] classe */
		const an_classe='an_classe';
		/** [enum] sexe */
		const an_sexe='an_sexe';
		/** [image] photo */
		const an_photo='an_photo';
		/** [account("ZOO_GARDIEN")] gardien responsable */
		const an_gardien='an_gardien';
		/** [date] date de naissance */
		const an_naissance='an_naissance';
		/** [date] date d'entrée */
		const an_entree='an_entree';
		/** [array] liste enfant */
		const an_enfant_t='an_enfant_t';
		/** [docid("ZOO_ANIMAL")] enfant */
		const an_enfant='an_enfant';
		/** [menu] Carnet Santé */
		const an_carnetsante='an_carnetsante';
		/** [menu] Enclos */
		const an_enclos='an_enclos';
		/** [menu] Parents */
		const an_parent='an_parent';
		/** [docid('ZOO_ANIMAL')] père */
		const an_pere='an_pere';
		/** [docid('ZOO_ANIMAL')] mère */
		const an_mere='an_mere';
		/** [menu] Dossier */
		const an_folder='an_folder';
	}
	/** carnet de sante  */
	class Zoo_carnetsante {
		/** [frame] Identification */
		const ca_identification='ca_identification';
		/** [text] nom de l'animal */
		const ca_nom='ca_nom';
		/** [docid("ZOO_ANIMAL")] identifiant de l'animal */
		const ca_idnom='ca_idnom';
		/** [frame] Intervention */
		const ca_intervention='ca_intervention';
		/** [array] liste intervention */
		const ca_intervention_t='ca_intervention_t';
		/** [date] date */
		const ca_date='ca_date';
		/** [text] description */
		const ca_description='ca_description';
		/** [account] vétérinaire */
		const ca_idveterinaire='ca_idveterinaire';
		/** [menu] maladie */
		const ca_maladie='ca_maladie';
	}
	/** entrée  */
	class Zoo_entree {
		/** [frame] Identification */
		const ent_fr_identification='ent_fr_identification';
		/** [account] Responsable de caisse */
		const ent_caissiere='ent_caissiere';
		/** [int] N°caisse */
		const ent_ncaisse='ent_ncaisse';
		/** [date] Date d'encaissement */
		const ent_date='ent_date';
		/** [frame] Entrées */
		const ent_fr_entrees='ent_fr_entrees';
		/** [int] nombre adulte */
		const ent_adulte='ent_adulte';
		/** [int] nombre enfant */
		const ent_enfant='ent_enfant';
		/** [money("%s &euro --- ")] Prix */
		const ent_prix='ent_prix';
		/** [menu] Tickets */
		const ent_printticket='ent_printticket';
		/** [menu] Recette */
		const ent_daysales='ent_daysales';
		/** [menu] Recette du jour */
		const ent_todaysales='ent_todaysales';
		/** [frame] Prix */
		const ent_fr_prix='ent_fr_prix';
		/** [money] prix enfant */
		const ent_prixenfant='ent_prixenfant';
		/** [money] prix adulte */
		const ent_prixadulte='ent_prixadulte';
	}
	/** Contact  */
	class Zoo_contact {
		/** [frame] État civil */
		const zct_fr_ident='zct_fr_ident';
		/** [enum] civilité */
		const zct_civility='zct_civility';
		/** [text] nom */
		const zct_lname='zct_lname';
		/** [text] prénom */
		const zct_fname='zct_fname';
		/** [text] mail */
		const zct_mail='zct_mail';
		/** [frame] Informations professionnelles */
		const zct_fr_coord='zct_fr_coord';
		/** [image] photographie */
		const zct_photo='zct_photo';
		/** [text] téléphone */
		const zct_phone='zct_phone';
		/** [text] mobile */
		const zct_mobile='zct_mobile';
		/** [longtext] adresse */
		const zct_workaddr='zct_workaddr';
		/** [text] code postal */
		const zct_workpostalcode='zct_workpostalcode';
		/** [text] ville */
		const zct_worktown='zct_worktown';
	}
	/** Cuisinier  */
	class Zoo_demandeadoption {
		/** [frame] Référence */
		const de_fr_reference='de_fr_reference';
		/** [text] Référence */
		const de_reference='de_reference';
		/** [tab] Identification */
		const de_tab_ident='de_tab_ident';
		/** [frame] Identification demandeur */
		const de_fr_identification='de_fr_identification';
		/** [account] rédacteur */
		const de_idredac='de_idredac';
		/** [docid("ZOO_CONTACT")] demandeur */
		const de_iddemand='de_iddemand';
		/** [longtext] Adresse */
		const de_postaladdress='de_postaladdress';
		/** [text] téléphone */
		const de_phone='de_phone';
		/** [text] mobile */
		const de_mobile='de_mobile';
		/** [frame] Animal */
		const de_fr_anidentification='de_fr_anidentification';
		/** [text] nom */
		const de_nom='de_nom';
		/** [text] Nom de l'espèce */
		const de_espece='de_espece';
		/** [docid("ZOO_ESPECE")] Espèce */
		const de_idespece='de_idespece';
		/** [date] date de naissance */
		const de_naissance='de_naissance';
		/** [image] photo */
		const de_photo='de_photo';
		/** [tab] Complément */
		const de_tab_info='de_tab_info';
		/** [frame] Provenance */
		const de_fr_provenance='de_fr_provenance';
		/** [text] pays */
		const de_pays='de_pays';
		/** [text] région */
		const de_region='de_region';
		/** [docid("ZOO_CONTACT")] propriétaire actuel */
		const de_proprietaire='de_proprietaire';
		/** [htmltext] Remarques */
		const de_info='de_info';
		/** [frame] Réalisation */
		const de_fr_realisation='de_fr_realisation';
		/** [date] date  */
		const de_date='de_date';
		/** [time ] heure */
		const de_heure='de_heure';
		/** [frame] Refus */
		const de_fr_refus='de_fr_refus';
		/** [longtext] Motif du refus */
		const de_motif='de_motif';
		/** [frame] Validation */
		const de_fr_valid='de_fr_valid';
		/** [account] Valideur  */
		const de_idval='de_idval';
		/** [account] Réalisation */
		const de_idrealised='de_idrealised';
		/** [frame] Validation groupe */
		const de_fr_pval='de_fr_pval';
		/** [account] groupe demandeur */
		const de_idgdemand='de_idgdemand';
		/** [account] groupe valideur */
		const de_idgvalid='de_idgvalid';
		/** [account] groupe prise en charge */
		const de_idgreal='de_idgreal';
	}
	/** Cycle demande Adoption  */
	class Zoo_wdemandeadoption extends Wdoc {
		/** [frame] Paramètre de transition */
		const wad_fr_transition='wad_fr_transition';
		/** [longtext] Motif de Refus */
		const wad_refus='wad_refus';
		/** [frame] Modèle de courriels */
		const wad_fr_mail='wad_fr_mail';
		/** [docid("MAILTEMPLATE")] Espèce protégée */
		const wad_mailsecure='wad_mailsecure';
		/** [docid("MAILTEMPLATE")] Espèce commune */
		const wad_mailcurrent='wad_mailcurrent';
	}
	/** Cycle Animal  */
	class Zoo_wanimal extends Wdoc {
		/** [frame] Paramètre de transition */
		const wan_fr_transition='wan_fr_transition';
		/** [docid('ZOO_VETERINAIRE')] vétérinaire */
		const wan_veto='wan_veto';
	}
	/** Gardien  */
	class Zoo_gardien extends Iuser {
		/** [tab] Gardien */
		const gar_tab_garde='gar_tab_garde';
		/** [frame] garde */
		const gar_fr_garde='gar_fr_garde';
		/** [time] Début Heure Garde */
		const gar_debgarde='gar_debgarde';
		/** [time] Fin Heure Garde */
		const gar_fingarde='gar_fingarde';
		/** [array] Enclos */
		const gar_enclos_t='gar_enclos_t';
		/** [docid("ZOO_ENCLOS")] Enclos */
		const gar_idenclos='gar_idenclos';
	}
	/** Veterinaire  */
	class Zoo_veterinaire extends Iuser {
		/** [frame] garde */
		const us_fr_garde='us_fr_garde';
		/** [time] Début Heure Garde */
		const us_debgarde='us_debgarde';
		/** [time] Fin Heure Garde */
		const us_fingarde='us_fingarde';
		/** [array] Spécialite */
		const us_specialite_t='us_specialite_t';
		/** [docid("ZOO_ESPECE")] Spécialité */
		const us_specialite='us_specialite';
	}
	/** Cuisinier  */
	class Zoo_cuisinier extends Iuser {
		/** [frame] nourriture */
		const us_fr_nourriture='us_fr_nourriture';
		/** [array] Spécialite */
		const us_specialite_t='us_specialite_t';
		/** [docid("ZOO_ESPECE")] Spécialité */
		const us_specialite='us_specialite';
		/** [menu] Lions HTML */
		const us_lion='us_lion';
		/** [menu] Lions Odt */
		const us_lion_odt='us_lion_odt';
		/** [menu] Lions Pdf */
		const us_lion_pdf='us_lion_pdf';
	}
}
