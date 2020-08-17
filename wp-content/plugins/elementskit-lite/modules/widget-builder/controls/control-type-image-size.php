<?php

namespace ElementsKit\Modules\Widget_Builder\Controls;

defined('ABSPATH') || exit;

class Control_Type_Image_Size extends CT_Base {

	public function start_writing_conf($file_handler, $conf) {

		$ret = "\t\t\t\t" . '\'exclude\' => [],' . PHP_EOL;
		$ret .= "\t\t\t\t" . '\'include\' => [],' . PHP_EOL;
		$ret .= "\t\t\t\t" . '\'default\' => \'large\',' . PHP_EOL;
		
		$selectorProperty = str_replace(',', ', {{WRAPPER}} ', esc_html($conf->selector));
		$ret .= "\t\t\t\t" . '\'selector\' => \'{{WRAPPER}} ' . $selectorProperty . '\',' . PHP_EOL;

		return $ret;
	}
}
