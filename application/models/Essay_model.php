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
        if (!is_null($param)) {
            $query = $this->db->get_where($table, $param);
        } else {
            if (str_contains($column, 'kd_matkul') || str_contains($column, 'semester') || str_contains($column, 'thn_akademik') || str_contains($column, 'kd_kelas') || str_contains($column, 'ctype')) {
                $query = $this->db->distinct();
            }
            $query = $this->db->get($table, $limit, $offset);
        }

        if ($count) {
            return $query->num_rows();
        }
        return $query->result();
    }

    public function update_data(array $data, string $table, array $param)
    {
        return $this->db->update($table, $data, $param);
    }
}
