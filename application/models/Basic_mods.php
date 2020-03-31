<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basic_mods extends CI_Model
{
    public function getUsers()
    {
        $query = "SELECT a.id, a.username, a.fullname, a.email, b.role, a.role_id, a.is_active 
        FROM user a, user_role b WHERE a.role_id = b.id";

        return $this->db->query($query)->result_array();
    }

    public function getBreadcrumb($title)
    {
        $query = "SELECT user_menu.group, user_menu.menu, user_sub_menu.title
                  FROM user_menu, user_sub_menu
                  WHERE user_menu.id = user_sub_menu.menu_id AND user_sub_menu.title= '$title' ";

        return $this->db->query($query)->row_array();
    }

    public function getAllMenu()
    {
        $query = "SELECT a.group, a.menu, b.menu_id, b.title, b.id AS submenu_id, b.url, b.icon, b.is_active
                  FROM user_menu a, user_sub_menu b 
                  WHERE a.id = b.menu_id";

        return $this->db->query($query)->result_array();
    }

    public function deleteData($name, $id)
    {
        if ($name === "menu"){
            $query = "DELETE from user_menu where id = $id ";
            $query_access_role = "DELETE from user_access_menu where menu_id = $id ";

            $query_del_submenu = "DELETE from user_sub_menu where menu_id = $id ";
            $this->db->query($query_del_submenu);
        }
        elseif ($name === "submenu"){
            $query = "DELETE from user_sub_menu where id = $id ";
            $query_access_role = "DELETE from user_access_menu where submenu_id = $id ";
        }
        elseif ($name === "role"){
            $query = "DELETE from user_access_menu where role_id = $id ";
            $query_access_role = "DELETE from user_role where id = $id ";
        }

        $this->db->query($query);
        $this->db->query($query_access_role);


        return $query;
    }

    public function insertData($name, $data)
    {
        if ($name === "menu"){
            $this->db->insert('user_menu', $data);

            $idMenu = $this->db->get_where('user_menu',$data)->row_array();
        }
        elseif ($name === "submenu"){
            $this->db->insert('user_sub_menu', $data);
            
            $newSubmenu = $this->db->get_where('user_sub_menu', ['title' => $data['title']])->row_array();
            $mstr_access = [
                'role_id' => 1,
                'submenu_id' => $newSubmenu['id'],
                'menu_id' => $newSubmenu['menu_id']
            ];
            $this->db->insert('user_access_menu', $mstr_access);
        }
        elseif ($name === "role"){
            $role = [ 'role' => $data ];
            $this->db->insert('user_role', $role);

            $idRole = $this->db->get_where('user_role', ['role' => $data])->row_array();
            $role_access = [
                'role_id' => $idRole['id'],
                'menu_id' => '1',
                'submenu_id' => '1'
            ];
            $this->db->insert('user_access_menu', $role_access);
        }

        return 1;
    }
}
