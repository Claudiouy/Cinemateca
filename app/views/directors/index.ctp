<?php 
echo $this->Form->create('Director'). $this->AutoComplete->input('Director.name'). 
        $this->Form->input('Director.surname'). $this->Form->end(__('Buscar director')) ?>