<?php

namespace ElementsKit\Modules\Widget_Builder\Controls;

defined('ABSPATH') || exit;

class CT_Factory {

	public function make($type, $domain, $group = 'single') {

		if($group == 'single') {

			switch($type) {

				case 'TextControl':
					return new Control_Type_Input($domain);

				case 'NumberControl':
					return new Control_Type_Number($domain);

				case 'UrlControl':
					return new Control_Type_URL($domain);

				case 'TextareaControl':
					return new Control_Type_Text_Area($domain);

				case 'SelectControl':
					return new Control_Type_Select($domain);

				case 'CodeControl':
					return new Control_Type_Code($domain);

				case 'SwitcherControl':
					return new Control_Type_Switch($domain);

				case 'ChooseControl':
					return new Control_Type_Choose($domain);

				case 'ColorControl':
					return new Control_Type_Color($domain);

				case 'EntranceAnimationControl':
					return new Control_Type_Animation($domain);

				case 'HoverAnimationControl':
					return new Control_Type_Animation($domain);

				case 'DateTimeControl':
					return new Control_Type_Date_Time($domain);

				case 'FontControl':
					return new Control_Type_Date_Time($domain);

				case 'GalleryControl':
					return new Control_Type_Gallery($domain);

				case 'SliderControl':
					return new Control_Type_Slider($domain);

				case 'IconsControl':
					return new Control_Type_Icons($domain);

				case 'MediaControl':
					return new Control_Type_Media($domain);

				case 'WysiwygControl':
					return new Control_Type_Wys($domain);

				default:
					return new Control_Type_Input($domain);
			}

		} elseif($group == 'group') {

			switch($type) {

				case 'BorderControl':
					return new Control_Type_Border($domain);

				case 'TextShadowControl':
					return new Control_Type_Text_Shadow($domain);

				case 'BoxShadowControl':
					return new Control_Type_Box_Shadow($domain);

				case 'ImageSizeControl':
					return new Control_Type_Image_Size($domain);

				default:
					return new Control_Type_Border($domain);
			}

		} elseif($group == 'responsive') {

		}

		return new Control_Type_Input($domain);
	}
}
