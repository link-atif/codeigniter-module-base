<div class="container">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-6">
            <h3>KSL Logistics Operation Team</h3>
            <form class="form-horizontal" action="<?php echo base_url('logistics_team/LogisticsTeamController/editLogisticsTeam/'.$editlogisticsteam->id);?>" method="post">
                
                <div class="form-group">
                    <label class="" >Driver:</label>
                    <select class="js-example-basic-single2 form-control" name="driver" multiple="">
                        <option value="1">Driver1</option>
                        <option value="2">Driver2</option>
                        <option value="3">Driver3</option>
                    </select>               
                </div>
                <div class="form-group">
                    <label class="" >Rider:</label>
                    <select class="js-example-basic-single2 form-control" name="rider" multiple="">
                        <option value="1">Rider1</option>
                        <option value="2">Rider2</option>
                        <option value="3">Rider3</option>
                    </select>               
                </div>
                <div class="form-group">
                    <label>Packer:</label>
                    <select class="js-example-basic-single2 form-control" name="packer" multiple="">
                        <option value="1">Packer1</option>
                        <option value="2">Packer2</option>
                        <option value="3">Packer3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Extra Labour in case:</label>
                    <select class="js-example-basic-single2 form-control" name="extra_labour" multiple="">
                        <option value="1">extra-labour1</option>
                        <option value="2">extra-labour2</option>
                        <option value="3">extra-labour3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pickup:</label>
                    <select class="js-example-basic-single2 form-control" name="picker" multiple="">
                        <option value="1">picker1</option>
                        <option value="2">picker2</option>
                        <option value="3">picker3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Record Type:</label>
                    <select class="js-example-basic-single2 form-control" name="record_type" multiple="">
                        <option value="AL">Servey</option>
                        <option value="AL">Quoatation</option>
                    </select>
                </div>
               
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-1">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
        $('.js-example-basic-single1').select2();
        $('.js-example-basic-single2').select2();
    })

</script>
