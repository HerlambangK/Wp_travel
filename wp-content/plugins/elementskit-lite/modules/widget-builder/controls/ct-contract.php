<?php

namespace ElementsKit\Modules\Widget_Builder\Controls;

defined('ABSPATH') || exit;

interface CT_Contract {

	public function start_writing_conf($file_handler, $conf);

}