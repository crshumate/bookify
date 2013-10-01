Dear <?php echo $name; ?>,

Click on the link below to finish resetting your password:

<?
echo $this->Html->url(array('controller'=>'resets', 'action'=>'reset_password', $hash), true);
?>

Thank you.

tomsList
http://localhost/bookify