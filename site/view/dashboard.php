<?php include_once 'header.php'; global $host;?>

       <div class="row">
        <div class="col-sm-6">
            <div class="box box-color lightred box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bar-chart-o"></i>
                        Daily Update Summary
                    </h3>
                    <div class="actions">
                        <a href="#" class="btn btn-mini content-refresh">
                            <i class="fa fa-refresh"></i>
                        </a>
                        <a href="#" class="btn btn-mini content-remove">
                            <i class="fa fa-times"></i>
                        </a>
                        <a href="#" class="btn btn-mini content-slideUp">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="statistic-big">
                        <div class="top">
                            <div class="left">
                                <select name="category" class='chosen-select' data-nosearch="true" style="width:150px;">
                                    <option value="1">Today</option>
                                    <!-- <option value="2">Yesterday</option>
                                    <option value="3">Last week</option>
                                    <option value="4">Last month</option> -->
                                </select>
                            </div>
                            <!-- <div class="right">
                                50%
                                <span>
                                    <i class="fa fa-arrow-circle-right"></i>
                                </span>
                            </div> -->
                        </div>
                        <div class="bottom">
                            <div class="flot medium" id="flot-hdd"></div>
                        </div>
                        <div class="bottom">
                            <ul class="stats-overview">
                                <!-- <li>
                                    <span class="name">
                                        Avg. Provider Usage
                                    </span>
                                    <span class="value">
                                        50%
                                    </span>
                                </li>
                                <li>
                                    <span class="name">
                                        Avg. Daily Deactivation 
                                    </span>
                                    <span class="value">
                                        3600
                                    </span>
                                </li> -->
                                <!-- <li>
                                    <span class="name">
                                        Avg. Daily Blacklist 
                                    </span>
                                    <span class="value">
                                        4500
                                    </span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-color box-bordered green">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bullhorn"></i>Feeds - Live Activity</h3>
                    <div class="actions">
                        <a href="#" class="btn btn-mini custom-checkbox checkbox-active"><!-- Automatic refresh
                            <i class="fa fa-square-o"></i> -->
                        </a>
                    </div>
                </div>
                <div class="box-content nopadding scrollable" data-height="400" data-visible="true">
                    <table class="table table-nohead" id="randomFeed">
                        <tbody>
                            
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>

       <!-- <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Blacklist Last Approved
                    </h3>
                </div>
                <div class="box-content nopadding">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-content">
                                <div class="left">
                                    <div class="icon orange">
                                        <i class="fa fa-bullhorn"></i>
                                    </div>
                                    <div class="date"><?php echo $set->getTime() ?></div>
                                </div>
                                <div class="activity">
                                    <div class="user">
                                        <a href="#"><?php echo $set->getUser() ?></a>
                                        <span>approved <?php echo $set->getListsize() ?> Blacklisted Numbers</span>
                                    </div>
                                    <p>
                                        <?php echo $set->getComment() ?>
                                    </p>
                                </div>
                            </div>
                            <div class="line"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       </div> -->
                
                                        
<?php include_once 'footer.php'; ?>                        