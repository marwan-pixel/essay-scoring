<?php
class Essay_model extends CI_Model
{
    public function add_data(array $data, string $table)
    {
        return $this->db->insert($table, $data);
    }

    public function show_data(string $column, string $table, array $param = null)
    {
        $this->db->select($column);
        if (!is_null($param)) {
            $query = $this->db->get_where($table, $param);
        } else {
            $query = $this->db->get($table);
        }
        return $query->result();
    }

    public function update_data(array $data, string $table, array $param)
    {
        return $this->db->update($table, $data, $param);
    }
}
