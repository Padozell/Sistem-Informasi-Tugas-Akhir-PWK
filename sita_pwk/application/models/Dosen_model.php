<?php
class Dosen_model extends CI_Model {

  function dosen_list(){
		$hasil=$this->db->get('dosen');
		return $hasil->result();
	}

	function save_dosen(){

		$data = array(
				'NIP' 	=> $this->input->post('nip'),
				'Nama' 	=> $this->input->post('nama'),
				'password' => MD5($this->input->post('password')),
        'Email' => $this->input->post('email'),
        'No_telepon' => $this->input->post('no_telepon'),
        'Alamat' => $this->input->post('alamat'),
			);
		$result=$this->db->insert('dosen',$data);
		return $result;
	}

	function update_dosen(){
    $nip=$this->input->post('nip');
		$nama=$this->input->post('nama');
		$password=MD5($this->input->post('password'));
    $email=$this->input->post('email');
    $no_telepon=$this->input->post('no_telepon');
    $alamat=$this->input->post('alamat');

		$this->db->set('Nama', $nama);
		$this->db->set('password', $password);
    $this->db->set('Email', $email);
    $this->db->set('No_telepon', $no_telepon);
    $this->db->set('Alamat', $alamat);
    $this->db->where('NIP', $nip);
		$result=$this->db->update('dosen');
		return $result;
	}

	function delete_dosen(){
		$nip=$this->input->post('nip');
		$this->db->where('NIP', $nip);
		$result=$this->db->delete('dosen');
		return $result;
	}

  function update_profile($nip,$nama,$email,$no_telepon,$alamat,$foto) {
    $this->db->set('Nama', $nama);
    $this->db->set('Email', $email);
    $this->db->set('No_telepon', $no_telepon);
    $this->db->set('Alamat', $alamat);
    $this->db->set('foto', $foto);
    $this->db->where('NIP', $nip);
    $this->db->update('dosen');
    return $this->db->affected_rows();
  }

  function get_dosen($nip) {
    $query = $this->db->get_where('dosen', array('NIP' => $nip));
    return $query;
  }

  function cek_pw_lama($pw) {
    $pw = MD5($pw);
    $query = $this->db->get_where('dosen', array('password' => $pw));
    return $query;
  }

  function updatePassword($new_password, $nip){
    $this->db->set('password', MD5($new_password));
    $this->db->where('NIP', $nip);
    $result=$this->db->update('dosen');
    return $result;
  }

}
