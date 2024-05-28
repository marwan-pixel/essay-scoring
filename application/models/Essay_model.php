<?php
class Essay_model extends CI_Model
{
    public function add_data(array $data, string $table)
    {
        return $this->db->insert($table, $data);
    }

    public function show_data(string $column, string $table, array $param = null, bool $count = false, int $limit = null, int $offset = null)
    {
        $this->db->select($column);
        if (str_contains($column, 'kd_matkul') || str_contains($column, 'thn_akademik')) {
            $query = $this->db->distinct();
        }
        if (!is_null($param)) {
            $query = $this->db->get_where($table, $param);
        } else {

            $query = $this->db->get($table, $limit, $offset);
        }

        if ($count) {
            return $query->num_rows();
        }
        return $query->result();
    }

    public function get_only_one_data(string $column, string $table, array $param = null)
    {
        return $this->db->select($column)->distinct()->get_where($table, $param)->result();
    }

    public function get_data_login(string $column, string $table, array $param)
    {
        return $this->db->select($column)->distinct()->get_where($table, $param)->row_array();
    }

    public function update_data(array $data, string $table, array $param)
    {
        return $this->db->update($table, $data, $param);
    }
}
