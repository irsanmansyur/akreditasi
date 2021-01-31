<?php

class M_umum extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }


  function generatePesan($pesan, $type)
  {
    if ($type == "berhasil") {
      $str = '<div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        <!--<i class="ace-icon fa fa-check green"></i>-->
                        ' . $pesan . '
                    </div>';
    } elseif ($type == "gagal") {
      $str = '<div class="alert alert-block alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        <!--<i class="ace-icon fa fa-times red"></i>-->
                        ' . $pesan . '
                    </div>';
    } else {
      $str = '<div class="alert alert-block alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        
                        ' . $pesan . '
                    </div>';
    }

    $this->session->set_flashdata('msgbox', $str);

    return $str;
  }
}
