# Modifier les champs

### Modifier le formulaire

application/config/form.php est le fichier de configuration permettant de modifier simplement les formulaires

```php
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
        'label' => 'I have read and accept the <a href="public/pdf/research_rules.pdf">research rules</a> and the <a href="public/pdf/safety_rules.pdf">safety rules</a>',
        'rules' => 'required',
        'tip' => ''
    )
```

### Modifier le modèle

application/models/Charter_model.php

La fonction insertCharter prend un tableau en entrée et l'insère dans la base de données.

```php
public function insertCharter(Array $d)
    {
        $string = array(
            'information_investigators' => $d['information_investigators'],
            'names_involve' => $d['names_involve'],
            'title_research' => $d['title_research'],
            'summary_research' => $d['summary_research'],
            'location_field' => $d['location_field'],
            'timeline' => $d['timeline'],
            'detailed_method' => $d['detailed_method'],
            'non_disclosure' => $d['non_disclosure'],
            'date' => $d['date'],
            'name_principal_investigator' => $d['name_principal_investigator'],
            'condition_use_approve' => $d['condition_use_approve'],
            'email' => $d['email']
        );
        $q = $this->db->insert_string('charter', $string);
        $this->db->query($q);
        return $this->db->insert_id();
    }
```

### Modifier la base de données

Il faut ajouter/supprimer/modifier les colonnes qui correspondent au nom des champs ajoutés dans le code.

### Exemple

Je veux ajouter un champ "âge" au formulaire :

Je modifie la vue : 

```php
    'email' => array(
        'type' => 'text',
        'label' => 'E-mail of the principal investigator',
        'rules' => 'required|valid_email',
        'tip' => ''
    ),
    'condition_use_approve' => array(
        'type' => 'checkbox',
        'label' => 'I have read and accept the <a href="public/pdf/research_rules.pdf">research rules</a> and the <a href="public/pdf/safety_rules.pdf">safety rules</a>',
        'rules' => 'required',
        'tip' => ''
    ),
    'age' => array(
        'type' => 'text',
        'label' => 'Age of the principal investigator',
        'rules' => 'required',
        'tip' => ''
    )
);
```
Je modifie le modèle : 

```php
public function insertCharter(Array $d)
    {
        $string = array(
            'information_investigators' => $d['information_investigators'],
            'names_involve' => $d['names_involve'],
            'title_research' => $d['title_research'],
            'summary_research' => $d['summary_research'],
            'location_field' => $d['location_field'],
            'timeline' => $d['timeline'],
            'detailed_method' => $d['detailed_method'],
            'non_disclosure' => $d['non_disclosure'],
            'date' => $d['date'],
            'name_principal_investigator' => $d['name_principal_investigator'],
            'condition_use_approve' => $d['condition_use_approve'],
            'email' => $d['email']
            'age' => $d['age']
        );
        $q = $this->db->insert_string('charter', $string);
        $this->db->query($q);
        return $this->db->insert_id();
    }
```

Je modifie la base de données : 

Je me connecte grace à PUTTY via SSH sur le serveur CIRAD (voir MDP.7z pour les mots de passes)
```
[root@gannat ~]# mysql -u root -p
MariaDB [(none)]> USE charter_form
MariaDB [users]> ALTER TABLE charter ADD COLUMN age INT(15);
```