<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Account Activativation on News portal</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table bgcolor="#f6f6f6" style="width:100%">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF" >

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td style="padding:10px;">
            <p>Hi <?php echo $first_name;?>,</p>
            <p style="margin:10px 0">Your account has been succesfully activated.</p>
            <p style="font-size:12px">Check our news portal <a href="<?php echo base_url(index_page().'/news/home/'); ?>">News Portal</a></p>
          </td>
        </tr>
      </table>
      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>
</table>
<!-- /body -->

<!-- footer -->
<table style="clear: both !important; width: 100%;">
  <tr>
    <td></td>
    <td align="center">
     <p>Please visit our website at <a href="<?php echo base_url(index_page().'/news/home/'); ?>">News Portal</a>.</p>
    </td>
    <td></td>
  </tr>
</table>
<!-- /footer -->

</body>
</html>