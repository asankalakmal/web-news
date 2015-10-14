<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Account Activativation on News portal</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td style="padding:10px;">
            <p>Hi <?php echo $first_name;?>,</p>
            <p>An account has been created for you at the News portal. Please activate your account and set your password...</p>
            
            <!-- button -->
            <table class="btn-primary" cellpadding="0" cellspacing="0" border="0" style="clear: both !important; width: 100%; margin: 10px 0 20px 0">
              <tr>
                <td align="center">
                  <a style="background-color: #348eda; border: solid 1px #348eda; border-radius: 25px; border-width: 10px 20px; display: inline-block;color: #ffffff; cursor: pointer;font-weight: bold; line-height: 2; text-decoration: none;" href="<?php echo base_url(index_page().'/auth/activate/'. $id .'/'. $activation); ?>">Activate my account &raquo;</a>
                </td>
              </tr>
            </table>
            <p style="font-size:12px">If you can't get the button to work, paste this link into your browser: <?php echo base_url(index_page().'/auth/activate/'. $id .'/'. $activation); ?></p>
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