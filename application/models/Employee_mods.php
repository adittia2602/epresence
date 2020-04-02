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

    public function getDataPegawai($nip)
    {
        $query_user = "SELECT * FROM emp_historyjabatan where nip_pegawai = '$nip' ";
        $my = $this->db->query($query_user)->row_array();
        $lv = $my['level'] + 1;

        if ($my){
            // Level Dirut : List Direksi
            if ($my['level'] === '1'){
                // $query = "SELECT * FROM emp_historyjabatan WHERE level = '".$lv."' ";
                $query = "SELECT * FROM emp_historyjabatan ";
                $result = $this->db->query($query)->result_array();
            } 
            // Level Direktur : list Kadiv
            else if ($my['level'] === '2'){
                // $query = "SELECT * FROM emp_historyjabatan WHERE level = '".$lv."' AND direktorat = '".$my['direktorat']."' ";
                $query = "SELECT * FROM emp_historyjabatan WHERE direktorat = '".$my['direktorat']."' ";
                $result = $this->db->query($query)->result_array();
            }
            // Level Kadiv : list Pelaksana
            else if ($my['level'] === '3'){
                $query = "SELECT * FROM emp_historyjabatan WHERE level = '".$lv."' AND id_divisi = '".$my['id_divisi']."' ";
                $result = $this->db->query($query)->result_array();
            }  
        } else {
            // Administrator
            $result = $this->getAllPegawai();
        }
        return $result;
        //  ---------------------------------------------------------------------------
        $query = "SELECT * FROM emp_historyjabatan ORDER BY id_jabatan";

        return $this->db->query($query)->result_array();
    }

    public function getAllLaporan()
    {
        $query = "SELECT a.*, b.nama_pegawai FROM emp_laporan a, emp_pegawai b
                    WHERE a.nip_pegawai = b.nip
                    ORDER BY reg_ts DESC";
        return $this->db->query($query)->result_array();
    }

    public function getLaporan($nip)
    {
        $query = "SELECT * FROM emp_laporan where nip_pegawai = '$nip' ORDER BY reg_ts";

        return $this->db->query($query)->result_array();
    }

    public function getLaporanPegawai($nip)
    {
        $query_user = "SELECT * FROM emp_historyjabatan where nip_pegawai = '$nip' ";
        $my = $this->db->query($query_user)->row_array();
        $lv = $my['level'] + 1;

        if ($my){
            // Level Dirut : list laporan direksi
            if ($my['level'] === '1'){
                // $query = "SELECT a.*, b.nama_pegawai FROM emp_laporan a, emp_pegawai b
                //     WHERE a.nip_pegawai = b.nip AND 
                //     a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE level = '2') 
                //     ORDER BY reg_ts DESC";
                $query = "SELECT a.*, b.nama_pegawai, b.divisi, b.direktorat, b.level FROM emp_laporan a, emp_historyjabatan b
                    WHERE a.nip_pegawai = b.nip_pegawai AND 
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE nip_pegawai != '$nip') 
                    ORDER BY reg_ts DESC";
                $result = $this->db->query($query)->result_array();
            } 
            // Level Direktur : list laporan kadiv
            else if ($my['level'] === '2'){
                // $query = "SELECT a.*, b.nama_pegawai FROM emp_laporan a, emp_pegawai b
                //     WHERE a.nip_pegawai = b.nip AND 
                //     a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE level = '".$lv."' AND direktorat = '".$my['direktorat']."') 
                //     ORDER BY reg_ts DESC";
                $query = "SELECT a.*, b.nama_pegawai , b.divisi, b.direktorat, b.level FROM emp_laporan a, emp_historyjabatan b
                WHERE a.nip_pegawai = b.nip_pegawai AND
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE direktorat = '".$my['direktorat']."' AND nip_pegawai != '$nip') 
                    ORDER BY reg_ts DESC";
                $result = $this->db->query($query)->result_array();
            }
            // Level Kadiv : list laporan pelaksana
            else if ($my['level'] === '3'){
                $query = "SELECT a.*, b.nama_pegawai, b.divisi, b.direktorat, b.level FROM emp_laporan a, emp_historyjabatan b
                    WHERE a.nip_pegawai = b.nip_pegawai AND
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE level = '".$lv."' AND id_divisi = '".$my['id_divisi']."') 
                    ORDER BY reg_ts DESC";
                $result = $this->db->query($query)->result_array();
            }  
        } else {
            // Administrator
            $result = $this->getAllLaporan();
        }
        return $result;
    }

    public function inputLaporan($data)
    {
        $result = $this->db->insert('emp_laporan', $data);
        return $result;
    }

    public function updateLaporan($idLaporan, $data)
    {
        $this->db->where('id', $idLaporan);
        $this->db->update('emp_laporan', $data);
        return 1;
    }

}
