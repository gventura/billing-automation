<?php
function __autoload($class_name)
{
	require_once('class_' . $class_name . '.php');
}

function indent($number)
{
	$return = "";

	while ($number > 0)
	{
		$return .= "\t";
		$number--;
	}

	return $return;
}

function increase_indent_level($input, $level)
{
	$tabs = '';

	while($level-- > 0) $tabs .= "\t";

	$array = explode("\n", $input);

	return $tabs . implode("\n" . $tabs, $array);
}
?>