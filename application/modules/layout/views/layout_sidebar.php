<ul id="main-menu" class="main-menu">
    <li class="active opened active has-sub">
        <a href="<?=base_url();?>dashboard">
            <i class="entypo-gauge"></i>
            <span class="title">Dashboard</span>
        </a>

    </li>

<?php  
if($this->acl_model->has_permission('users','index',$role_ids_array) === TRUE){ ?>

    <li class="has-sub <?php if(isset($users_menu)){ echo $users_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Users</span>
        </a>
        <ul>
        <?php  if($this->acl_model->has_permission('users','addUser',$role_ids_array) === TRUE){ ?>
            <li>      
                <a href="<?=base_url();?>addUser">
                    <span class="title">Add Users</span>
                </a>
            </li>
        <?php } ?>
        <?php  if($this->acl_model->has_permission('users','viewUser',$role_ids_array) === TRUE){ ?>
            <li>      
                <a href="<?=base_url();?>viewUser">
                    <span class="title">View Users</span>
                </a>
            </li>
        <?php } ?>

        </ul>      
    </li>  
<?php } ?>

<?php  if($this->acl_model->has_permission('categories','index',$role_ids_array) === TRUE){ ?>

    <li class="has-sub <?php if(isset($category_menu)){ echo $category_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Categories</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>categories/">
                    <span class="title">Categories</span>
                </a>
            </li>
        </ul>      
    </li> 
<?php } ?>
<?php  if($this->acl_model->has_permission('Branches','index',$role_ids_array) === TRUE){ ?>

    <li class="has-sub <?php if(isset($branch_menu)){ echo $branch_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Branches</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>branches/">
                    <span class="title">Branches</span>
                </a>
            </li>
        <?php  if($this->acl_model->has_permission('Branches','subBranches',$role_ids_array) === TRUE){ ?>

            <li>      
                <a href="<?=base_url('subBranches');?>">
                    <span class="title">Sub Branches</span>
                </a>
            </li>
        <?php } ?>

        </ul>      
    </li>
<?php } ?>
<?php  if($this->acl_model->has_permission('cities','index',$role_ids_array) === TRUE){ ?>

    <li class="has-sub <?php if(isset($city_menu)){ echo $city_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Cities</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>cities/">
                    <span class="title">Cities</span>
                </a>
            </li>
        </ul>      
    </li>
<?php } ?>

<?php  if($this->acl_model->has_permission('orders','index',$role_ids_array) === TRUE){ ?>
    <li class="has-sub">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Orders</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>addOrder">
                    <span class="title">Generate invoice</span>
                </a>
            </li>
            <li>      
                <a href="<?=base_url();?>viewOrders">
                    <span class="title">view invoices</span>
                </a>
            </li>
        </ul>      
    </li>
<?php } ?>
<?php  if($this->acl_model->has_permission('countries','index',$role_ids_array) === TRUE){ ?>

    <li class="has-sub <?php if(isset($countries_menu)){ echo $countries_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Countries</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>countries/">
                    <span class="title">Countries</span>
                </a>
            </li>
        </ul>      
    </li> 
<?php } ?>
<?php  if($this->acl_model->has_permission('containers','index',$role_ids_array) === TRUE){ ?>
    <li class="has-sub <?php if(isset($containers_menu)){ echo $containers_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Containers</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>containers/">
                    <span class="title">Containers</span>
                </a>
            </li>
        </ul>      
    </li> 
<?php } ?>
<?php  if($this->acl_model->has_permission('devices','index',$role_ids_array) === TRUE){ ?>
    <li class="has-sub <?php if(isset($devices_menu)){ echo $devices_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Devices</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>devices/">
                    <span class="title">Devices</span>
                </a>
            </li>
        </ul>      
    </li>    
<?php } ?>
<?php  if($this->acl_model->has_permission('warehouse','index',$role_ids_array) === TRUE){ ?>

    <li class="has-sub <?php if(isset($warehouse_menu)){ echo $warehouse_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Warehouse</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>warehouse/">
                    <span class="title">Warehouse</span>
                </a>
            </li>
        </ul>      
    </li> 
<?php } ?>

    <li class="has-sub <?php if(isset($permission_menu)){ echo $permission_menu;}?>">
        <a href="#">
            <i class="entypo-layout"></i>
            <span class="title">Manage Permissions</span>
        </a>
        <ul>
            <li>      
                <a href="<?=base_url();?>permissions/">
                    <span class="title">Permissions</span>
                </a>
            </li>
        </ul>      
    </li>

</ul>     
</div>

</div>