<?php

class MyPager extends CLinkPager
{
	public $nextPageLabel = '<span class="icon-forward"></span>';
	public $prevPageLabel = '<span class="icon-backward"></span>';
	public $firstPageLabel = '<span class="icon-fast-backward"></span>';
	public $lastPageLabel = '<span class="icon-fast-forward"></span>';
	
	public function run()
	{
		$this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
		{
			echo '&nbsp;';
			return;
		}
		//echo $this->header;
		echo CHtml::tag('div',$this->htmlOptions,implode("\n",$buttons));
		//echo $this->footer;
	}
	
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
		return '<a href="' . $this->createPageUrl($page) . '" class="'.$class.'">' . $label . '</a>';
	}
}
