<?php 


$aptid = $_POST['apt_id'];


?>


<p style="font-size:16px;font-weight:500px;"> Accept appointment of <?= $aptid  ?>?</p>

<input type="hidden" id="confimedapt" class="form-control"
            name="confimedapt"  value="<?= $aptid ?>" hidden>
<?php


?>