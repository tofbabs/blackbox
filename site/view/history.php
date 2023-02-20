<?php include_once 'header.php'; global $host;?>

       <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        <?php echo strtoupper($title)?> Approval History
                    </h3>
                </div>
                <div class="box-content nopadding">
                    <ul class="timeline">
                        <?php foreach ($set as $key => $entity) :?>
                        <li>
                            <div class="timeline-content">
                                <div class="left">
                                    <div class="icon orange">
                                        <i class="fa fa-bullhorn"></i>
                                    </div>
                                    <div class="date"><?php echo $entity->getTime() ?></div>
                                </div>
                                <div class="activity">
                                    <div class="user">
                                        <a href="<?php echo $host . "/user/profile/" . str_replace(' ', '+', $entity->getUser()) ?>"><?php echo $entity->getUser() ?></a> approved
                                        <span><a href="<?php echo $host .'/list/download-set/'. $entity->getId() ?>">
                                        <?php echo $entity->getListsize() ?> Blacklisted Numbers
                                        </a></span>
                                    </div>
                                    <p>
                                        <?php echo $entity->getComment() ?>
                                    </p>
                                </div>
                            </div>
                            <div class="line"></div>
                        </li>
                        <?php endforeach?>
                    </ul>
                </div>
            </div>
        </div>
       </div>

<?php include_once 'footer.php'; ?>