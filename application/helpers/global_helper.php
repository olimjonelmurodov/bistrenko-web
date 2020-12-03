<?php

if(!function_exists('getunreadcount'))
{
  function getunreadcount()
  {
        $CI =& get_instance();
        return $CI->db
        ->select('sum((is_read=0)::int) as c')
        ->from('orders')->get()->result()[0]->c;
  }
}
if(!function_exists('hasadminrights'))
{
  function hasadminrights()
  {
        $CI =& get_instance();
        return $CI->session->userdata('privilege')==0;
  }
}

