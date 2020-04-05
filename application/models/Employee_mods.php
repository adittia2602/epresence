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

    public function getUserAbsence($nip)
    {
        $query = "SELECT *, date(reg_ts) as tgl, time(clockin) as t_clockin, time(clockout) as t_clockout 
                FROM emp_absensi where nip_pegawai = '$nip' ORDER BY reg_ts DESC";

        return $this->db->query($query)->result_array();
    }

    public function getUserLaporan($nip)
    {
        $query = "SELECT * FROM emp_laporan where nip_pegawai = '$nip' ORDER BY reg_ts DESC";

        return $this->db->query($query)->result_array();
    }

    public function getFileLaporan($id)
    {
        $query = "SELECT * FROM emp_laporan where id = '$id' ";

        return $this->db->query($query)->row_array();
    }

    public function getAllPegawai()
    {
        $query = "SELECT * FROM emp_historyjabatan WHERE status = '1' ORDER BY id_jabatan ";

        return $this->db->query($query)->result_array();
    }

    public function getDataPegawai($nip)
    {
        $query_user = "SELECT * FROM emp_historyjabatan where nip_pegawai = '$nip' AND status = 1 ";
        $my = $this->db->query($query_user)->row_array();
        $lv = $my['level'] + 1;

        if ($my){
            // Level Dirut : List Direksi
            if ($my['level'] === '1'){
                $query = "SELECT * FROM emp_historyjabatan ORDER BY ";
                $result = $this->db->query($query)->result_array();
            } 
            // Level Direktur : list Kadiv
            else if ($my['level'] === '2'){
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
    }

    public function getAllLaporan()
    {
        $query = "SELECT a.*, b.nama_pegawai, b.divisi, b.direktorat, b.level
                    FROM emp_laporan a, emp_historyjabatan b
                    WHERE b.status = 1 AND a.nip_pegawai = b.nip_pegawai
                    ORDER BY reg_ts DESC";
        return $this->db->query($query)->result_array();
    }

    public function getLaporanPegawai($nip)
    {
        $query_user = "SELECT * FROM emp_historyjabatan where nip_pegawai = '$nip' AND status = '1'";
        $my = $this->db->query($query_user)->row_array();
        $lv = $my['level'] + 1;

        if ($my){
            // Level Dirut : list laporan direksi
            if ($my['level'] === '1'){
                $query = "SELECT a.*, b.nama_pegawai, b.divisi, b.direktorat, b.level FROM emp_laporan a, emp_historyjabatan b
                    WHERE a.nip_pegawai = b.nip_pegawai AND 
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE nip_pegawai != '$nip' AND status = 1) 
                    ORDER BY reg_ts DESC";
            } 
            // Level Direktur : list laporan kadiv
            else if ($my['level'] === '2'){
                $query = "SELECT a.*, b.nama_pegawai , b.divisi, b.direktorat, b.level FROM emp_laporan a, emp_historyjabatan b
                WHERE a.nip_pegawai = b.nip_pegawai AND status = 1 AND
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE direktorat = '".$my['direktorat']."' AND nip_pegawai != '$nip' AND status = 1) 
                    ORDER BY reg_ts DESC";
            }
            // Level Kadiv : list laporan pelaksana
            else if ($my['level'] === '3'){
                $query = "SELECT a.*, b.nama_pegawai, b.divisi, b.direktorat, b.level FROM emp_laporan a, emp_historyjabatan b
                    WHERE a.nip_pegawai = b.nip_pegawai AND status = 1 AND
                    a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE level = '".$lv."' AND id_divisi = '".$my['id_divisi']."' AND status = 1) 
                    ORDER BY reg_ts DESC";
            }  
            $result = $this->db->query($query)->result_array();

        } else {
            // Administrator
            $result = $this->getAllLaporan();
        }
        return $result;
    }

    public function getAllAbsence($tglawal,$tglakhir)
    {
        $query = "SELECT a.*, b.*,  date(a.reg_ts) as tgl, time(a.clockin) as t_clockin, time(a.clockout) as t_clockout 
                    FROM emp_absensi a, emp_historyjabatan b
                    WHERE b.status = '1' AND date(a.reg_ts) >= '".$tglawal."' AND date(a.reg_ts) <= '".$tglakhir."'AND a.nip_pegawai = b.nip_pegawai
                    ORDER BY reg_ts DESC";
        return $this->db->query($query)->result_array();
    }

    public function getAbsencePegawai($nip,$tglawal,$tglakhir)
    {
        $query_user = "SELECT * FROM emp_historyjabatan where nip_pegawai = '$nip' AND status = '1' ";
        $my = $this->db->query($query_user)->row_array();

        if ($my){
            if ($my['level'] === '1'){
                $query = "SELECT a.*, b.*,  date(a.reg_ts) as tgl, time(a.clockin) as t_clockin, time(a.clockout) as t_clockout 
                        FROM emp_absensi a, emp_historyjabatan b
                        WHERE date(a.reg_ts) >= '".$tglawal."' AND date(a.reg_ts) <= '".$tglakhir."' AND status = 1
                        AND a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE level > '".$my['level']."' AND status = 1) 
                        AND a.nip_pegawai = b.nip_pegawai 
                        ORDER BY reg_ts DESC";
            } 
            else if ($my['level'] === '2') {
                $query = "SELECT a.*, b.*,  date(a.reg_ts) as tgl, time(a.clockin) as t_clockin, time(a.clockout) as t_clockout 
                            FROM emp_absensi a, emp_historyjabatan b
                            WHERE date(a.reg_ts) >= '".$tglawal."' AND date(a.reg_ts) <= '".$tglakhir."' AND status = 1
                            AND a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE direktorat = '".$my['direktorat']."' AND nip_pegawai != '$nip' AND status = 1 ) 
                            AND a.nip_pegawai = b.nip_pegawai 
                            ORDER BY reg_ts DESC"; 
            } 
            else if ($my['level'] === '3') {
                $query = "SELECT a.*, b.*,  date(a.reg_ts) as tgl, time(a.clockin) as t_clockin, time(a.clockout) as t_clockout 
                            FROM emp_absensi a, emp_historyjabatan b
                            WHERE date(a.reg_ts) >= '".$tglawal."' AND date(a.reg_ts) <= '".$tglakhir."' AND status = 1
                            AND a.nip_pegawai IN (SELECT nip_pegawai FROM emp_historyjabatan WHERE id_divisi = '".$my['id_divisi']."' AND nip_pegawai != '$nip' AND status = 1 ) 
                            AND a.nip_pegawai = b.nip_pegawai 
                            ORDER BY reg_ts DESC"; 
            } 
            $result = $this->db->query($query)->result_array();
        } else {
            // Administrator
            $result = $this->getAllAbsence($tglawal,$tglakhir);
        }
        return $result;
    }

    public function clockIn($data)
    {
        $result = $this->db->insert('emp_absensi', $data);
        return $result;
    }

    public function clockOut($nip, $data)
    {
        $this->db->where('nip_pegawai', $nip);
        $this->db->where('date(reg_ts)', date('Y-m-d'));
        $result = $this->db->update('emp_absensi', $data);
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
        $result = $this->db->update('emp_laporan', $data);
        return $result;
    }

    public function deleteLaporan($idLaporan)
    {
        $this->db->where('id', $idLaporan);
        $result = $this->db->delete('emp_laporan');
        return $result;
    }

}
