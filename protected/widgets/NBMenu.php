<?php
Yii::import('zii.widgets.CMenu');

class NBMenu extends CMenu
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
			if($item['active']) $class[]='active';
			if($class!==array())
			{
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}
			
			$label = $item['label'];
			if(isset($item['count']))
			{
				$label .= ' ('.$item['count'].')';
				
				$class=array();
				if($count%4==1) $class[]='noleft';
				elseif($count%4==0) $class[]='noright';
				
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}
			
			if(isset($item['items']) && count($item['items']))
			{
				echo CHtml::openTag('li', $options);
				
				echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$label.'</a>';
				echo "\n<ul class='dropdown-menu'>\n";
				$this->renderMenuRecursive($item['items']);
				echo "</ul>\n";
			}
			else
			{
				echo CHtml::openTag('li', $options);
				
				if(isset($item['url'])) $menu=CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
				else $menu=CHtml::tag('a',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
				
				if(isset($this->itemTemplate) || isset($item['template']))
				{
					$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
					echo strtr($template,array('{menu}'=>$menu));
				}
				else echo $menu;
			}
			
			echo CHtml::closeTag('li')."\n";
		}
		if(isset($items[0]['count']) && $count%4!=0)
		{
			for($i=$count%4+1;$i<4;$i++)
			{
				echo '<li><span>&nbsp;</span></li>';
			}
			echo '<li class="noright"><span>&nbsp;</span></li>';
		}
	}
	
	protected function isItemActive($item,$route)
	{
		if(isset($item['url']) && is_array($item['url']) && !strcasecmp(trim('site/'.$item['url'][0],'/'),$route))
		{
			if(count($item['url'])>1)
			{
				foreach(array_splice($item['url'],1) as $name=>$value)
				{
					if(!isset($_GET[$name]) || $_GET[$name]!='site/'.$value)
						return false;
				}
			}
			return true;
		}
		return false;
	}
}