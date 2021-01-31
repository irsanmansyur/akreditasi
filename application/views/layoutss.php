<!DOCTYPE html>
<html lang="en">
  <?php  $this->load->view('_include/head') ?>

  <body class="overflow-hidden">
    <!-- Overlay Div -->
    <div id="overlay" class="transparent"></div>
    
    <a href="" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>
    <div id="theme-setting">
        <div class="title">
            <strong class="no-margin">Skin Color</strong>
        </div>
        <div class="theme-box">
            <a class="theme-color" style="background:#323447" id="default"></a>
            <a class="theme-color" style="background:#efefef" id="skin-1"></a>
            <a class="theme-color" style="background:#a93922" id="skin-2"></a>
            <a class="theme-color" style="background:#3e6b96" id="skin-3"></a>
            <a class="theme-color" style="background:#635247" id="skin-4"></a>
            <a class="theme-color" style="background:#3a3a3a" id="skin-5"></a>
            <a class="theme-color" style="background:#495B6C" id="skin-6"></a>
        </div>
        <div class="title">
            <strong class="no-margin">Sidebar Menu</strong>
        </div>
        <div class="theme-box">
            <label class="label-checkbox">
                <input type="checkbox" checked id="fixedSidebar">
                <span class="custom-checkbox"></span>
                Fixed Sidebar
            </label>
        </div>
    </div><!-- /theme-setting -->

    <div id="wrapper" class="preload">
        <?php $this->load->view('_include/header') ?>
        <?php $this->load->view('_include/sidebar') ?>
        

        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                     <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
                     <li class="active">Dashboard</li>   
                </ul>
            </div><!-- /breadcrumb-->
            <div class="main-header clearfix">
                <div class="page-title">
                    <h3 class="no-margin">Dashboard</h3>
                </div><!-- /page-title -->
            </div><!-- /main-header -->
            
            
            <div class="padding-md">
                
            </div><!-- /.padding-md -->
        </div><!-- /main-container -->
        <!-- Footer
        ================================================== -->
        
    <?php  $this->load->view('_include/footer') ?>    
    </div><!-- /wrapper -->

    <a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
    
    <!-- Logout confirmation -->
    <div class="custom-popup width-100" id="logoutConfirm">
        <div class="padding-md">
            <h4 class="m-top-none"> Do you want to logout?</h4>
        </div>

        <div class="text-center">
            <a class="btn btn-success m-right-sm" href="login.html">Logout</a>
            <a class="btn btn-danger logoutConfirm_close">Cancel</a>
        </div>
    </div>
    
    <?php  $this->load->view('_include/script') ?>
    
  </body>
</html>
