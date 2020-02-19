<section class="section-padding gray-bg">
    <div class="container">
        <div class="section-header text-center">
            <h2>Find the Best <span>CarForYou</span></h2>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour, or randomised words which don't look even slightly believable. If you
                are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden
                in the middle of text.</p>
        </div>
        <div class="row">

            <!-- Nav tabs -->
            <div class="recent-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New
                            Car</a></li>
                </ul>
            </div>
            <!-- Recently Listed New Cars -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="resentnewcar">

                    <?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            ?>

                            <div class="col-list-3">
                                <div class="recent-car-list">
                                    <div class="car-info-box"><a
                                                href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                                                    src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                                                    class="img-responsive" alt="image"></a>
                                        <ul>
                                            <li><i class="fa fa-car"
                                                   aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?>
                                            </li>
                                            <li><i class="fa fa-calendar"
                                                   aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?>
                                                Model
                                            </li>
                                            <li><i class="fa fa-user"
                                                   aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?>
                                                seats
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="car-title-m">
                                        <h6>
                                            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?>
                                                , <?php echo htmlentities($result->VehiclesTitle); ?></a></h6>
                                        <span class="price">$<?php echo htmlentities($result->PricePerDay); ?> /Day</span>
                                    </div>
                                    <div class="inventory_info_m">
                                        <p><?php echo substr($result->VehiclesOverview, 0, 70); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>

                </div>
            </div>
        </div>
</section>