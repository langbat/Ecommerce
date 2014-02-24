<?php
Yii::import('zii.widgets.CMenu');

class NBADMenu extends CMenu
{
	protected function renderMenuRecursive($items)
	{
		$count=0;
		$n=count($items);
		foreach($items as $item)
		{
			$count++;
			$options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
			$class=array();
			if($item['active'] && $this->activeCssClass!='')
				$class[]=$this->activeCssClass;
			if($count===1 && $this->firstItemCssClass!='')
				$class[]=$this->firstItemCssClass;
			if($count===$n && $this->lastItemCssClass!='')
				$class[]=$this->lastItemCssClass;
			if($class!==array())
			{
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}
			echo CHtml::openTag('li', $options);
			
			if(isset($item['url']))
			{
				
				//@Minh:
				$itemlabel = '<span';
				if(isset($item['icon'])) $itemlabel .= ' class="' . $item['icon'] . '"';
				$itemlabel .= '></span>';
				$itemlabel .= '<span class="text">' . $item['label'] . '</span>';
				
				$label=$this->linkLabelWrapper===null ? $itemlabel : '<'.$this->linkLabelWrapper.'>'.$itemlabel.'</'.$this->linkLabelWrapper.'>';
				
				
				$menu=CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
			}
			else
				$menu=CHtml::tag('a',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
			
			if(isset($this->itemTemplate) || isset($item['template']))
			{
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				echo strtr($template,array('{menu}'=>$menu));
			}
			else
				echo $menu;
			
			if(isset($item['items']) && count($item['items']))
			{
				echo "\n".CHtml::openTag('ul',$this->submenuHtmlOptions)."\n";
				$this->renderMenuRecursive($item['items']);
				echo CHtml::closeTag('ul')."\n";
			}
			echo CHtml::closeTag('li')."\n";
		}
	}
	
	protected function isItemActive($item,$route)
	{
		if(isset($item['url']) && is_array($item['url']) && !strcasecmp(trim('admin/'.$item['url'][0],'/'),$route))
		{
			if(count($item['url'])>1)
			{
				foreach(array_splice($item['url'],1) as $name=>$value)
				{
					if(!isset($_GET[$name]) || $_GET[$name]!='admin/'.$value)
						return false;
				}
			}
			return true;
		}
		return false;
	}
}