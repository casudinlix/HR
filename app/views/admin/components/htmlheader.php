<?php $company = $this->Xin_model->read_company_setting_info(1);?>
<?php $favicon = base_url().'uploads/logo/favicon/'.$company[0]->favicon;?>
<?php $theme = $this->Xin_model->read_theme_info(1);?>
<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">

<head>
  <title><?php echo $title;?></title>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo $favicon;?>">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

  <!-- Icon fonts -->
  <link rel="stylesheet" href="<?php echo tema();?>vendor/fonts/fontawesome.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/fonts/ionicons.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/fonts/linearicons.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/fonts/open-iconic.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/fonts/pe-icon-7-stroke.css">

  <!-- Core stylesheets -->
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/rtl/bootstrap-material.css" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/rtl/hrsale_h-material.css" class="theme-settings-hrsale-css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/rtl/theme-corporate-material.css" class="theme-settings-theme-css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/rtl/colors-material.css" class="theme-settings-colors-css">
  <link rel="stylesheet" href="<?php echo tema();?>/vendor/css/rtl/uikit.css">
  <link rel="stylesheet" href="<?php echo tema();?>css/demo.css">

  <script src="<?php echo tema();?>vendor/js/material-ripple.js"></script>
  <script src="<?php echo tema();?>vendor/js/layout-helpers.js"></script>

  <!-- Theme settings -->
  <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
  <script src="<?php echo tema();?>vendor/js/theme-settings.js"></script>
  <script>
    window.themeSettings = new ThemeSettings({
      cssPath: '<?php echo tema();?>vendor/css/rtl/',
      themesPath: '<?php echo tema();?>vendor/css/rtl/'
    });
  </script>

  <!-- Core scripts -->
  <script src="<?php echo tema();?>vendor/js/pace.js"></script>
  <script src="<?php echo tema();?>vendor/jquery/jquery-3.2.1.min.js"></script>

  <!-- Libs -->
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/datatables/datatables.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/jquery-ui/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/bootstrap-select/bootstrap-select.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/bootstrap-multiselect/bootstrap-multiselect.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/select2/select2.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/kendo/kendo.common.min.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/kendo/kendo.default.min.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/Trumbowyg/dist/ui/trumbowyg.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/clockpicker/dist/bootstrap-clockpicker.min.css">
  <?php if($this->router->fetch_class() =='employees' && $this->router->fetch_method() =='detail') { ?>
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/pages/account.css">
  <?php } ?>
  <?php if($this->router->fetch_class() =='employees' && $this->router->fetch_method() =='hr' || $this->router->fetch_class() =='dashboard') { ?>
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/pages/contacts.css">
  <?php } ?>
  <?php if($this->router->fetch_class() =='goal_tracking' || $this->router->fetch_method() =='task_details' || $this->router->fetch_class() =='project' || $this->router->fetch_method() =='project_details'){?>
  <link rel="stylesheet" href="<?php echo tema();?>vendor/ion.rangeSlider/css/ion.rangeSlider.css">
  <link rel="stylesheet" href="<?php echo tema();?>vendor/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css">
  <?php } ?>
  <?php if($this->router->fetch_class() =='settings'){?>
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css">
  <?php } ?>
  <?php if($this->router->fetch_class() =='chat'){?>
  <link rel="stylesheet" href="<?php echo tema();?>vendor/css/pages/chat.css">
  <?php } ?>
  <?php if($this->router->fetch_class() =='calendar' || $this->router->fetch_class() =='dashboard'){?>
  <link rel="stylesheet" href="<?php echo tema();?>vendor/libs/fullcalendar/fullcalendar.css">
  <?php } ?>
  
</head>