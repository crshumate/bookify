Dear <?php echo $name; ?>,

Thank you for creating your account with bookify.
Please verify your account by clicking the link provided below, or copy and paste it into you browser window:

<?
echo $this->Html->url(array('controller'=>'users', 'action'=>'confirm', $hash), true);
?>

Thank you.

tomsList
http://localhost/bookify