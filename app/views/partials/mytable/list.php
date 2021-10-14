<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('mytable'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('mytable'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('mytable'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="mytable-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-title"> Title</th>
                                                <th  class="td-about"> About</th>
                                                <th  class="td-organizer"> Organizer</th>
                                                <th  <?php echo (get_value('orderby')=='timestamp' ? 'class="sortedby td-timestamp"' : null); ?>>
                                                    <?php Html :: get_field_order_link('timestamp', "Timestamp"); ?>
                                                </th>
                                                <th  class="td-email"> Email</th>
                                                <th  class="td-address"> Address</th>
                                                <th  class="td-latitude"> Latitude</th>
                                                <th  class="td-longitude"> Longitude</th>
                                                <th  class="td-tags0"> Tags0</th>
                                                <th  class="td-tags1"> Tags1</th>
                                                <th  class="td-tags2"> Tags2</th>
                                                <th  class="td-tags3"> Tags3</th>
                                                <th  class="td-tags4"> Tags4</th>
                                                <th  class="td-tags5"> Tags5</th>
                                                <th  class="td-tags6"> Tags6</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class="td-sno"><?php echo $counter; ?></th>
                                                <td class="td-id"> <?php echo $data['id']; ?></td>
                                                <td class="td-title"> <?php echo $data['title']; ?></td>
                                                <td class="td-about"><a href="<?php print_link("mytable/view/$data[id]") ?>"><?php echo $data['about']; ?></a></td>
                                                <td class="td-organizer"> <?php echo $data['organizer']; ?></td>
                                                <td class="td-timestamp"> <?php echo $data['timestamp']; ?></td>
                                                <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
                                                <td class="td-address"> <?php echo $data['address']; ?></td>
                                                <td class="td-latitude"> <?php echo $data['latitude']; ?></td>
                                                <td class="td-longitude"> <?php echo $data['longitude']; ?></td>
                                                <td class="td-tags0"> <?php echo $data['tags0']; ?></td>
                                                <td class="td-tags1"> <?php echo $data['tags1']; ?></td>
                                                <td class="td-tags2"> <?php echo $data['tags2']; ?></td>
                                                <td class="td-tags3"> <?php echo $data['tags3']; ?></td>
                                                <td class="td-tags4"> <?php echo $data['tags4']; ?></td>
                                                <td class="td-tags5"> <?php echo $data['tags5']; ?></td>
                                                <td class="td-tags6"> <?php echo $data['tags6']; ?></td>
                                                <th class="td-btn">
                                                    <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("mytable/view/$rec_id"); ?>">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </th>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <?php 
                                    if(empty($records)){
                                    ?>
                                    <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                        <i class="fa fa-ban"></i> No record found
                                    </h4>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if( $show_footer && !empty($records)){
                                ?>
                                <div class=" border-top mt-2">
                                    <div class="row justify-content-center">    
                                        <div class="col-md-auto justify-content-center">    
                                            <div class="p-3 d-flex justify-content-between">    
                                                <div class="dropup export-btn-holder mx-1">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-save"></i> Export
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php $export_print_link = $this->set_current_page_link(array('format' => 'json')); ?>
                                                        <a class="dropdown-item export-link-btn" data-format="json" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                            <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> JSON
                                                            </a>
                                                            <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                </a>
                                                                <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">   
                                                        <?php
                                                        if($show_pagination == true){
                                                        $pager = new Pagination($total_records, $record_count);
                                                        $pager->route = $this->route;
                                                        $pager->show_page_count = true;
                                                        $pager->show_record_count = true;
                                                        $pager->show_page_limit =true;
                                                        $pager->limit_count = $this->limit_count;
                                                        $pager->show_page_number_list = true;
                                                        $pager->pager_link_range=5;
                                                        $pager->render();
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
