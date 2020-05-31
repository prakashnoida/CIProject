
<?php 
	if($this->crud_model->get_type_name_by_id('general_settings','62','value') == 'ok'){
		include 'category_menu.php';
	}
?>
<?php 
	if ($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok') {
		if($this->crud_model->get_type_name_by_id('ui_settings','23','value') == 'ok'){
			include 'brands.php';
		}
	}
?>

<?php
	if($this->crud_model->get_type_name_by_id('ui_settings','59','value') == 'ok'){
		include 'todays_deal.php';
	}
?>



