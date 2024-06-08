<?php
class Essay_model extends CI_Model
{
    public function add_data(array $data, string $table)
    {
        return $this->db->insert($table, $data);
    }

    public function show_data(string $column, string $table, array $param = null, bool $count = false, int $limit = null, int $offset = null, string $order_by = '', string $item_order = '')
    {
        $this->db->select($column);
        if (str_contains($column, 'kd_matkul') || str_contains($column, 'thn_akademik')) {
            $query = $this->db->distinct();
        }
        if ($order_by == 'ASC') {
            $this->db->order_by($item_order, 'ASC');
        } else if ($order_by == 'DESC') {
            $this->db->order_by($item_order, 'DESC');
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

    public function get_only_one_data(string $column, string $table, array $param = null, $desc = false, $item_desc = "")
    {
        $this->db->select($column)->distinct();
        if ($desc) {
            $this->db->order_by($item_desc, 'DESC');
        } else {
            $this->db->order_by($item_desc, 'ASC');
        }
        return $this->db->get_where($table, $param)->result();
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
