
<?php 
echo $this->Form->create('Image',array('type' => 'file'));
echo $this->Form->input('file_upload',array('type'=>'file'));
echo $this->Form->end('Enviar'); 
?>
