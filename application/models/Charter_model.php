<?php
class Charter_model extends CI_Model
{
    public function __construct(Type $var = null) {
        parent::__construct();
    }

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
            'condition_use_approve' => $d['condition_use_approve']
        );
        $q = $this->db->insert_string('charter', $string);
        $this->db->query($q);
        return $this->db->insert_id();
    }

    public function approveCharter(Array $d, String $approval)
    {
        $d["specific_conditions"] = isset($d["specific_conditions"]) ? $d["specific_conditions"] : null;
        $string = array(
            'specific_conditions' => $d['specific_conditions'],
            'approved' => $approval
        );
        $this->db->where('id', $d['id']);
        $this->db->update('requests', $data);
        $success = $this->db->affected_rows();
        if (!$success) {
            error_log('Unable to approveCharter('.$d['id'].')');
            return false;
        }
        $request_info = $this->getRequestInfo($d['id']);
        return $request_info;
    }

    public function getCharterInfo($id)
    {
        $q = $this->db->get_where('charter', array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no request found getCharterInfo('.$id.')');
            return false;
        }
    }

    public function getCharterList()
    {
        $q = $this->db->get('requests');
        return $q->result();
    }
}
