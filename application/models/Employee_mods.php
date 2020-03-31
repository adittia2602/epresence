<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_mods extends CI_Model
{
    public function getUserData($nip)
    {
        $query = "SELECT *
                  FROM emp_historyjabatan
                  WHERE status = 1 AND nip_pegawai = '$nip' ";

        return $this->db->query($query)->row_array();
    }

    public function getAllPegawai()
    {
        $query = "SELECT * FROM emp_historyjabatan ORDER BY id_jabatan";

        return $this->db->query($query)->result_array();
    }

    public function getLaporanPegawai($nip)
    {
        $query = "SELECT * FROM emp_absensi where nip_pegawai = '$nip' ORDER BY clockin";

        return $this->db->query($query)->result_array();
    }

    public function getLaporanDivisi($nip)
    {
        $query_user = "SELECT * FROM emp_historyjabatan where nip_pegawai = '$nip' ";
        $my = $this->db->query($query_user)->row_array();
        $lv = $my['level'] + 1;

        $query = "SELECT a.*, b.nama_pegawai FROM emp_absensi a, emp_pegawai b
                    WHERE a.nip_pegawai = b.nip AND 
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE level = '".$lv."' AND id_divisi = '".$my['id_divisi']."') 
                    ORDER BY clockin DESC";
        return $this->db->query($query)->result_array();
    }

    public function inputLaporan($data)
    {
        $result = $this->db->insert('emp_absensi', $data);
        return $result;
    }

    public function updateLaporan($idLaporan, $data)
    {
        $this->db->where('id', $idLaporan);
        $this->db->update('emp_absensi', $data);
        return 1;
    }

}
