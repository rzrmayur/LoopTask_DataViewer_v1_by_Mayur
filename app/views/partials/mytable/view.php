<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Mytable</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-title">
                                        <th class="title"> Title: </th>
                                        <td class="value"> <?php echo $data['title']; ?></td>
                                    </tr>
                                    <tr  class="td-about">
                                        <th class="title"> About: </th>
                                        <td class="value"> <?php echo $data['about']; ?></td>
                                    </tr>
                                    <tr  class="td-organizer">
                                        <th class="title"> Organizer: </th>
                                        <td class="value"> <?php echo $data['organizer']; ?></td>
                                    </tr>
                                    <tr  class="td-timestamp">
                                        <th class="title"> Timestamp: </th>
                                        <td class="value"> <?php echo $data['timestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-email">
                                        <th class="title"> Email: </th>
                                        <td class="value"> <?php echo $data['email']; ?></td>
                                    </tr>
                                    <tr  class="td-address">
                                        <th class="title"> Address: </th>
                                        <td class="value"> <?php echo $data['address']; ?></td>
                                    </tr>
                                    <tr  class="td-latitude">
                                        <th class="title"> Latitude: </th>
                                        <td class="value"> <?php echo $data['latitude']; ?></td>
                                    </tr>
                                    <tr  class="td-longitude">
                                        <th class="title"> Longitude: </th>
                                        <td class="value"> <?php echo $data['longitude']; ?></td>
                                    </tr>
                                    <tr  class="td-tags0">
                                        <th class="title"> Tags0: </th>
                                        <td class="value"> <?php echo $data['tags0']; ?></td>
                                    </tr>
                                    <tr  class="td-tags1">
                                        <th class="title"> Tags1: </th>
                                        <td class="value"> <?php echo $data['tags1']; ?></td>
                                    </tr>
                                    <tr  class="td-tags2">
                                        <th class="title"> Tags2: </th>
                                        <td class="value"> <?php echo $data['tags2']; ?></td>
                                    </tr>
                                    <tr  class="td-tags3">
                                        <th class="title"> Tags3: </th>
                                        <td class="value"> <?php echo $data['tags3']; ?></td>
                                    </tr>
                                    <tr  class="td-tags4">
                                        <th class="title"> Tags4: </th>
                                        <td class="value"> <?php echo $data['tags4']; ?></td>
                                    </tr>
                                    <tr  class="td-tags5">
                                        <th class="title"> Tags5: </th>
                                        <td class="value"> <?php echo $data['tags5']; ?></td>
                                    </tr>
                                    <tr  class="td-tags6">
                                        <th class="title"> Tags6: </th>
                                        <td class="value"> <?php echo $data['tags6']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                    <?php
                                    }
                                    else{
                                    ?>
                                    <!-- Empty Record Message -->
                                    <div class="text-muted p-3">
                                        <i class="fa fa-ban"></i> No Record Found
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
