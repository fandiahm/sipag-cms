<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_setting extends CI_Model 
{
    
    var $table = 'setting'; 
    
    public function all() 
    {
        $result = $this->db->get('setting');
        return $result;
    }

    public function find($id) 
    {
        $row = $this->db->where('setting_id',$id)->limit(1)->get('setting');
        return $row;
    }

    public function site_name()
    {
        $this->db->select('site_name');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->site_name;
    }

    public function site_title()
    {
        $this->db->select('site_title');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->site_title;
    }

    public function site_logo()
    {
        $this->db->select('site_logo');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->site_logo;
    }

    public function meta_description()
    {
        $this->db->select('meta_description');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->meta_description;
    }

    public function meta_keyword()
    {
        $this->db->select('meta_keyword');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->meta_keyword;
    }

    public function get_theme()
    {
        $this->db->select('site_theme');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->site_theme;
    }

    public function save_theme($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows(); 
    }

    public function use_tinymce() 
    {
        $this->db->select('section_title_tinymce');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->section_title_tinymce;
    }

    public function use_bgcolor() 
    {
        $this->db->select('section_bgcolor');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->section_bgcolor;
    }

    public function use_bgimage() 
    {
        $this->db->select('section_bgimage');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->section_bgimage;
    }

    public function use_advanced_option() 
    {
        $this->db->select('section_advanced_option');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->section_advanced_option;
    }

    public function banner_display() 
    {
        $this->db->select('banner_display');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_display;
    }

    public function banner_display_header() 
    {
        $this->db->select('banner_display_header');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_display_header;
    }

    public function banner_display_caption() 
    {
        $this->db->select('banner_display_caption');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_display_caption;
    }

    public function banner_display_button() 
    {
        $this->db->select('banner_display_button');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_display_button;
    }

    public function banner_nav_button() 
    {
        $this->db->select('banner_nav_button');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_nav_button;
    }

    public function banner_autoplay() 
    {
        $this->db->select('banner_autoplay');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_autoplay;
    }

    public function banner_animation() 
    {
        $this->db->select('banner_animation');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->banner_animation;
    }

    public function display_navbar() 
    {
        $this->db->select('display_navbar');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->display_navbar;
    }

    public function display_logo() 
    {
        $this->db->select('display_logo');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->display_logo;
    }

    public function navbar_inverse() 
    {
        $this->db->select('navbar_inverse');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->navbar_inverse;
    }

    public function navbar_transparent() 
    {
        $this->db->select('navbar_transparent');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->navbar_transparent;
    }

    public function navbar_pull_right() 
    {
        $this->db->select('navbar_pull_right');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->navbar_pull_right;
    }

    public function display_contact() 
    {
        $this->db->select('display_contact');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->display_contact;
    }

    public function display_footer() 
    {
        $this->db->select('display_footer');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->display_footer;
    }

    public function scrolltime()
    {
        $this->db->select('scroll_time');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->scroll_time;
    }

    public function scrolloffset()
    {
        $this->db->select('scroll_offset');
        $this->db->from('setting');
        $this->db->where('setting_id', 1);
        return $this->db->get()->row()->scroll_offset;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('setting_id',$id);
        $query = $this->db->get();
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows(); 
    }
    
}