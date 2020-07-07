<!--=============================================================================
|      Editors:  Martyn Fitzgerald - 16025948
|                Sharon Cheeran    - 17012330
|                Sharmin J Rony    - 16025948
|                Josh Boyce    	   - 16025948
|
|  Module Code:  UFCFV4-30-2
| Module Title:  Data, Schemas & Applications
|                
|   Instructor:  Prakash Chatterjee / Glyn Watkins
|     Due Date:  14/03/2019
|
|  Description:  ###############################################
|				  
|
*===========================================================================-->

<?php 
require_once('../include/header.html');
require_once('getPointOfInterest.php');
?>

<div class="container">
	<div class="row" style="padding-bottom:70px;">
        <div class="col-lg-7 col-md-12">
            <h1><?php echo $poiName ?></h1>
            <h5><?php echo $JsonData ?></h5  >
        </div>
        <div class="col-lg-5 col-md-12">
            <div>
                <div class="row">
                    <div class="col-xl-11 col-lg-12">
                        <h1>Description</h1>
                    </div>
                </div>
            </div>
            <p><?php echo $poiDescription ?></p>

            <hr>

            <div>
                <h3>Twitter Hash Tags</h3>
                <h4><?php echo $poiHashTagsOutput ?></h4>
            </div>

            <hr>

            <div>
                <h3>Wikipedia URL</h3>
                <h4><a href='<?php echo $poiWikipedia ?>' target='_blank'><?php echo $poiWikipedia ?></a></h4>
            </div>
            <hr>
        </div>
    </div>
</div>
<?php
require_once('../include/footer.html');
?>
