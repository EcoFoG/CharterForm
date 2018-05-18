<?php

$config['charter_form'] = array(
				'information_investigators' => array(
					'type' => 'textarea',
					'label' => 'Name, affiliation, and address (email and full address) of the principal investigators',
					'rules' => 'required',
					'tip' => ''
				),
				'names_involve' => array(
					'type' => 'textarea',
					'label' => 'Names of all the people involved in the field research conducted in Paracou',
					'rules' => 'required',
					'tip' => ''
				),
				'title_research' => array(
					'type' => 'textarea',
					'label' => 'Title of the proposed research ',
					'rules' => 'required|max_length[512]',
					'tip' => ''
				),
				'summary_research' => array(
					'type' => 'textarea',
					'label' => 'Summary of the proposed research (detailing the background, objectives and expected results)',
					'rules' => 'required',
					'tip' => ''
				),
				'location_field' => array(
					'type' => 'textarea',
					'label' => 'Location of field research',
					'rules' => 'required',
					'tip' => 'This section must include the motivation for the choice of the location, especially if within a permanent forest plot.'
				),
				'timeline' => array(
					'type' => 'textarea',
					'label' => 'Timeline of the study',
					'rules' => 'required',
					'tip' => 'This section must include the dates of installation and removal of all tags and field equipment. '
				),
				'detailed_method' => array(
					'type' => 'textarea',
					'label' => 'Detailed Methods',
					'rules' => '',
					'tip' => 'This section must list all the observations, measurements and experiments planned, the field equipment that will be used, the nature and number of samples that will be collected (please consider carefully the list of permitted and forbidden activities in the section General rules), and all equipment and tags that will be set on site.'
				),
				'non_disclosure' => array(
					'type' => 'textarea',
					'label' => 'Non-disclosure statement',
					'rules' => '',
					'tip' => 'We list the activities conducted in Paracou on the website (https://paracou.cirad.fr/working-in-the-station/planning). Please state here if you prefer that this document remain confidential (in which case, only the name of the PI, the dates and the tittle of the research will be displayed on the website). '
				),
				'name_principal_investigator' => array(
					'type' => 'text',
					'label' => 'Name of the principal investigator',
					'rules' => 'required|max_length[255]',
					'tip' => ''
				),
				'email' => array(
					'type' => 'text',
					'label' => 'E-mail of the principal investigator',
					'rules' => 'required|valid_email',
					'tip' => ''
				),
				'condition_use_approve' => array(
					'type' => 'checkbox',
					'label' => 'I have read and accept the charter conditions',
					'rules' => 'required',
					'tip' => ''
				)
			);
$config['admin_charter_form'] = array(
		'name_principal_investigator' => array(
			'type' => 'text',
			'label' => 'Name of the principal investigator',
			'rules' => 'required|max_length[255]',
			'tip' => ''
		),
		'email' => array(
			'type' => 'text',
			'label' => 'E-mail of the principal investigator',
			'rules' => 'required|valid_email',
			'tip' => ''
		),
		'information_investigators' => array(
			'type' => 'textarea',
			'label' => 'Name, affiliation, and address (email and full address) of the principal investigators',
			'rules' => 'required',
			'tip' => ''
		),
		'names_involve' => array(
			'type' => 'textarea',
			'label' => 'Names of all the people involved in the field research conducted in Paracou',
			'rules' => 'required',
			'tip' => ''
		),
		'title_research' => array(
			'type' => 'textarea',
			'label' => 'Title of the proposed research ',
			'rules' => 'required|max_length[512]',
			'tip' => ''
		),
		'summary_research' => array(
			'type' => 'textarea',
			'label' => 'Summary of the proposed research (detailing the background, objectives and expected results)',
			'rules' => 'required',
			'tip' => ''
		),
		'location_field' => array(
			'type' => 'textarea',
			'label' => 'Location of field research',
			'rules' => 'required',
			'tip' => 'This section must include the motivation for the choice of the location, especially if within a permanent forest plot.'
		),
		'timeline' => array(
			'type' => 'textarea',
			'label' => 'Timeline of the study',
			'rules' => 'required',
			'tip' => 'This section must include the dates of installation and removal of all tags and field equipment. '
		),
		'detailed_method' => array(
			'type' => 'textarea',
			'label' => 'Detailed Methods',
			'rules' => '',
			'tip' => 'This section must list all the observations, measurements and experiments planned, the field equipment that will be used, the nature and number of samples that will be collected (please consider carefully the list of permitted and forbidden activities in the section General rules), and all equipment and tags that will be set on site.'
		),
		'non_disclosure' => array(
			'type' => 'textarea',
			'label' => 'Non-disclosure statement',
			'rules' => '',
			'tip' => 'We list the activities conducted in Paracou on the website (https://paracou.cirad.fr/working-in-the-station/planning). Please state here if you prefer that this document remain confidential (in which case, only the name of the PI, the dates and the tittle of the research will be displayed on the website). '
		)
	);