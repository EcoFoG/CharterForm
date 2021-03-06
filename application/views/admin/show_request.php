<div class="container mx-auto my-3">
    <div class="row justify-content-center">
        <div class="col-8 justify-content-center">
            <?php
                $fattr = array('id' => 'showrequest');
                echo form_open(base_url()."admin/accept_request/$id",$fattr); ?>
            <?php
                foreach ($form_info as $name => $value) {
                    $type = (isset($value['type']) && !empty($value['type'])) ? $value['type'] : null;
                    $label = (isset($value['label']) && !empty($value['label'])) ? $value['label'] : null;
                    $content = (isset($value[0]) && !empty($value[0])) ? $value[0] : null;
                    
                    switch ($type) {
                        case 'textarea':
                            echo "<div class='form-group'>";
                            echo "<label for='$name'>$label</label>";
                            echo "<textarea disabled class='form-control' name='$name' id='$name'>".$content."</textarea>";
                            echo "</div>";
                            break;
                        case 'text':
                            echo "<div class='form-group'>";
                            echo "<label for='$name'>$label</label>";
                            echo "<input disabled class='form-control' value='".$content."' name='$name' type='$type' id='$name'>";
                            echo "</div>";
                            break;
                    }
                }
            ?>
            <div class='form-group'>
            <label for='specific_conditions'>Specific Conditions</label>
            <textarea class='form-control' name='specific_conditions' id='specific_conditions'></textarea>
            </div>
        <?php
            if (!isset($requestinfo->accepted)) {
                echo form_submit(array('name'=>'accept','value'=>'Accept request',"class"=>"btn btn-success"));
                echo "<a class=\"btn btn-danger\" href= \"".base_url()."admin/decline_request/$id\" data-confirm=\"Are you sure you want to decline this request ?\">Decline request  <i class=\"fas fa-times\"></i></a> ";
            }
            
        ?>
            <a class="btn btn-secondary" href=<?php echo "\"".base_url()."admin/list_requests\"";?>>Back</a>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>