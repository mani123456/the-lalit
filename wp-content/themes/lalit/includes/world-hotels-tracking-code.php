<?php
    if($GLOBALS['location'])
    {
        if($GLOBALS['location'][0]->slug == 'bangalore' || $GLOBALS['location'][0]->slug == 'mumbai' || $GLOBALS['location'][0]->slug == 'kolkata' || $GLOBALS['location'][0]->slug == 'delhi')
        {
?>
          	<!-- Lalit India Analytics Pixel: -->
			<script type="text/javascript" src="https://tag.yieldoptimizer.com/ps/ps?t=s&p=3767&lltap=Lalit%20Analytics%20Pixel"></script>
<?php
        }
    }
    if(is_front_page())
    {
?>
			<!-- Lalit India Analytics Pixel: -->
			<script type="text/javascript" src="https://tag.yieldoptimizer.com/ps/ps?t=s&p=3767&lltap=Lalit%20Analytics%20Pixel"></script>
<?php
    }
?>