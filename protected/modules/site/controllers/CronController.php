<?php
class CronController extends BaseController {
    
    //check if has end auction, and set end
    //update backcash, ...
    //it will run every minutes and 1st second
	public function actionIndex()	{
        //check
        $current = time()-1;
        $conditions = "start_time <= NOW() AND bid_quote = 0 AND(end_time IS NULL OR end_time = '0000-00-00 00:00:00')";
        $auctions =  Auctions::model()->findAll($conditions);
        if ($auctions){
            foreach ($auctions as $auction){
                $tmp = explode(':', $auction->countdown);
                $countdown = $tmp[0]*3600 + $tmp[1]*60;
        
                $end_time = strtotime($auction->start_time) + $countdown;
                $loop_times = ($end_time - $current)/$countdown;
                
                if (intval($loop_times) == $loop_times)
                    $auction->setEnd();
            }
        }
        
        // 1st place
        $conditions = "start_time <= NOW() AND bid_quote > 0 AND(end_time IS NULL OR end_time = '0000-00-00 00:00:00')";
        $auctions =  Auctions::model()->findAll($conditions);
        if ($auctions){
            foreach ($auctions as $auction){
                $tmp = explode(':', $auction->countdown);
                $countdown = $tmp[0]*3600 + $tmp[1]*60;
                $end_time = strtotime($auction->start_time) + $countdown;
                $loop_times = ($end_time - $current)/$countdown;
                if (intval($loop_times) == $loop_times){
                    $auction->set1stPlace($auction['id']);
                }
            }
        }
	}
}
