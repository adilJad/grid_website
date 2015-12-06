<?php 
/**
* 
*/
class FormGenerator
{
	public $controller;
	public $errors = array();

	function __construct($controller) {
		$this->controller = $controller;
	}

	public function input($name, $label, $options = array())
	{
		$value = false;
		$error = false;
		$classError = '';

		if (isset($this->errors[$name])) {
			$error = $this->errors[$name];
			$classError = ' has-error';
		}

		if (isset($this->controller->request->data->$name)) {
			
			$value = $this->controller->request->data->$name;
		} else {
			$value = '';
		}

		if ($label == "hidden") {
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		}

		$html = '<div class="form-group'.$classError.'">
		<label class="control-label col-sm-2" for="input'.$name.'">'.$label.'</label>';


		$attr = ' ';
		foreach ($options as $k => $v) {
			if ($k != 'type' && $k != 'vals' && $k != 'selected_vals') {
				$attr .= "$k=\"$v\" ";
			}
			
		}
		if (isset($options['type'])) {
			if ($options['type'] == 'textarea') {
				$html .= '<div class="col-sm-10"><textarea id="input'.$name.'" placeholder="Enter '.$label.'" name="'.$name.'" '.$attr.'>'.$value.'</textarea></div>';
				
			} elseif ($options['type'] == 'checkbox') {

				$checked = ($value == 1)? "checked":"";
				$html .= '<div class="col-sm-1"><input type="hidden" name="'.$name.'" value="0"/>
				<input type="checkbox" class="form-control" name="'.$name.'" value="1" '.$checked.' /></div>';
			
			} elseif ($options['type'] == 'file') {
				
				$html .= '<div class="col-sm-10"><input class="input-file" type="file" id="input'.$name.'" placeholder="Enter '.$label.'" name="'.$name.'"'.$attr.'></div>';
			
			} elseif ($options['type'] == 'password') {
				
				$html .= '<div class="col-sm-10"><input type="'.$options['type'].'" id="input'.$name.'" placeholder="Enter '.$label.'" value="'.$value.'" name="'.$name.'"'.$attr.'></div>';

			} elseif ($options['type'] == 'dropdown') {

				$html .= '<div class="dropdown col-sm-10">
				<select class="form-control" id="input'.$name.'" name="'.$name.'" '.$attr.'>';
				foreach ($options['vals'] as $k => $v) {
					$selected = '';
					if ($v == $value) {
						$selected = 'selected="selected"';
					}
					$html .= '<option value="'.$v.'" '.$selected.'>'.$v.'</option>';
				}
				$html .= '</select></div>';

			} elseif ($options['type'] == 'multi_select') {

				$html .= '<div class="dropdown col-sm-10">
				<select class="form-control" multiple="multiple" id="input'.$name.'" name="'.$name.'[]" '.$attr.'>';
				foreach ($options['vals'] as $k => $v) {
					$selected = '';
					if (in_array($k, array_keys($options['selected_vals'])) ) {
						$selected = 'selected';
					}
					$html .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
				}
				$html .= '</select></div>';


			} elseif ($options['type'] == 'email') {
				
				$html .= '<div class="col-sm-10"><input id="input'.$name.'" type="email" value="'.$value.'" placeholder="Enter '.$label.'"pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="john.doe@example.com" name="'.$name.'" '.$attr.'></div>';

			} elseif ($options['type'] == 'tel') {
				
				$html .= '<div class="col-sm-10"><input id="input'.$name.'" value="'.$value.'" type="tel" placeholder="Enter '.$label.'"pattern="^\+212\-\d{3}\-\d{6}" title="+212-XXX-XXXXXX" name="'.$name.'" '.$attr.'></div>';
			} elseif ($options['type'] == 'date') {

				if ($value == '0000-00-00') {
					$value = '';
				}
				$html .= '<div class="col-sm-10"><input type="date" class="form-control datepicker" placeholder="Enter '.$label.'" value="'.$value.'" name="'.$name.'" '.$attr.' /></div>';

			} elseif ($options['type'] == 'website') {
				
				$html .= '<div class="col-sm-10"><input id="input'.$name.'" type="url" value="'.$value.'" placeholder="Enter '.$label.'" title="www.example.com" name="'.$name.'" '.$attr.'></div>';

			} elseif ($options['type'] == 'number') {
				
				$html .= '<div class="col-sm-10"><input id="input'.$name.'" type="number" value="'.$value.'" placeholder="Enter '.$label.'" title="www.example.com" name="'.$name.'" '.$attr.'></div>';

			}

		} else {

			$html .= '<div class="col-sm-10"><input type="text" id="input'.$name.'" placeholder="Enter '.$label.'" value="'.$value.'" name="'.$name.'" '.$attr.'></div>';
		}
		if ($error) {
			$html .= '<span class="help-block col-sm-10 col-sm-offset-2">'.$error.'</span>';
		} else {
			$html .= '<span class="help-block col-sm-12"></span>';
		}
		$html .= '</div>';

		return $html;
	}
}

?>