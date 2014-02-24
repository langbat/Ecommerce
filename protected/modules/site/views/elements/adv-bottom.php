<div class="row-fluid full_img">
    <?php 
        $listAdvs = Banners::showAdvPosition(Banners::POSITION_TOP);
        $i = 0;
        foreach( $listAdvs as $listAdv ){
    ?>
    <div class="<?php if( $i == 0 ){ echo 'span8';} else { echo 'span4'; } ?>"><a href="<?php echo $listAdv->link; ?>"> <img src="/uploads/banner/<?php echo $listAdv->filename; ?>" alt="<?php echo $listAdv->name; ?>"/> </a></div>
    <?php $i++; } ?>
</div>