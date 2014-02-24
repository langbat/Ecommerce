<?php

class MyADPager extends CLinkPager
{
	public $nextPageLabel = '>';
	public $prevPageLabel = '<';
	public $firstPageLabel = '<<';
	public $lastPageLabel = '>>';
	
	public function run()
	{
		$this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;
		//echo $this->header;
		echo CHtml::tag('p',$this->htmlOptions,implode("\n",$buttons));
		//echo $this->footer;
	}
	
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
		return '<a href="' . $this->createPageUrl($page) . '"><input type="submit" value="' . $label . '" class="btn-pagination '.$class.'"/></a>';
	}
}
