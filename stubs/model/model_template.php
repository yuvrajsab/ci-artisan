<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class {$model_name} extends CI_Model
{

    protected $table = 'table_name';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    public function all()
    {
        $q = $this->db->get($this->table);
        return $q->result_array();
    }

    public function create(array $data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($value)
    {
        $this->db->delete($this->table, [$this->primary_key => $value]);
        return $this->db->affected_rows();
    }

    public function find($value)
    {
        $q = $this->db->get_where($this->table, [$this->primary_key => $value]);
        return $q->row_array();
    }

    public function where($name = 'id', $operator = '=', $value)
    {
        $q = $this->db->where("$name $operator", $value)->get($this->table);
        return $q->result_array();
    }

    public function first(array $data)
    {
        if (sizeof($data) > 0) {
            return $data[0];
        }
    }

    public function update(array $data)
    {
        $this->db->replace($this->table, $data);
        return $this->db->affected_rows();
    }
}