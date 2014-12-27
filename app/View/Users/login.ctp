<div style="padding: 10px;">	
	<div style="width: 260px; border: 1px solid #5A5A5A;">
		<div style="background: black; padding: 5px; opacity: 0.65; color: white; font-weight: bold;">Entrar</div>
			<div style="padding: 10px;">
				<?php
					echo $this->Form->create('User', array('action' => 'login'));
					echo $this->Form->input('User.email',array('label'=>'Email:'));
					echo $this->Form->input('User.password',array('label'=>'Clave:'));
					echo $this->Form->submit('Entrar', array('class' => 'g-button'));
					echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</div>
