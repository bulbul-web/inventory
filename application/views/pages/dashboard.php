<div class="row mt-3">


<?php
  if($userInfo->user_role == 3){
?>

<!-------old order info from tbl_ivoice ----->
  <div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_invoice WHERE NOT (order_status <=> NULL) AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY voucher_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Total Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_invoice WHERE order_status = 1 AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY voucher_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Accept Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_invoice WHERE order_status = 0 AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY voucher_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Not Accept</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>
<!-------end old order info from tbl_ivoice ----->

<!-------order info from tbl_order ----->
<div class="col-12 col-lg-12 col-xl-12">
<h6 class="text-center">------Marketing------</h6>
</div>

<div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>salesman-order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE NOT (order_status <=> NULL) AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Total Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <!-- <a href="<?php echo base_url()?>salesman-order"> -->
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status = 1 AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Accept Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    <!-- </a> -->
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <!-- <a href="<?php echo base_url()?>salesman-order"> -->
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status = 0 AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Not Accept</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    <!-- </a> -->
  </div>
<!-------end order info from tbl_order ----->

<?php
  }else{
?>

<div class="col-12 col-lg-6 col-xl-3">
  <a href="<?php echo base_url()?>product-type">
    <div class="card bg-pattern-success">
      <div class="card-body">
        <div class="media">
        <div class="media-body text-left">
          <h4 class="text-white">
              <?php
              $category = $this->db->query("SELECT count(product_type_id) as totalCategory FROM tbl_product_type WHERE product_type_status = 1")->row();
              if (isset($category)):
                  echo $category->totalCategory;
              endif;
              ?>
          </h4>
          <span class="text-white">Product Type</span>
        </div>
        <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
          <i class="icon-pie-chart text-white"></i></div>
      </div>
      </div>
    </div>
  </a>
</div>

  <div class="col-12 col-lg-6 col-xl-3">
      <a href="<?php echo base_url()?>products">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $totalProducts = $this->db->query("SELECT count(product_id) as totalProduct FROM tbl_product_info WHERE  product_status=1 ")->row();
                  if (isset($totalProducts)):
                      echo $totalProducts->totalProduct;
                  endif;
                  ?>
              </h4>
              <span class="text-white">Total Product</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

<div class="col-12 col-lg-6 col-xl-3">
  <a href="<?php echo base_url()?>suppliers">
    <div class="card bg-pattern-danger">
      <div class="card-body">
        <div class="media">
        <div class="media-body text-left">
          <h4 class="text-white">
              <?php
              $suppliers = $this->db->query("SELECT count(supplier_id) as totalSupplier FROM tbl_supplier WHERE  supplier_status=1 ")->row();
              if (isset($suppliers)):
                  echo $suppliers->totalSupplier;
              endif;
              ?>
          </h4>
          <span class="text-white">Supplier Name</span>
        </div>
        <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
          <i class="icon-user text-white"></i></div>
      </div>
      </div>
    </div>
  </a>
</div>


<div class="col-12 col-lg-6 col-xl-3">
  <a href="<?php echo base_url()?>customers">
    <div class="card bg-pattern-warning">
      <div class="card-body">
        <div class="media">
        <div class="media-body text-left">
          <h4 class="text-white">
              <?php
              $tcustomer = $this->db->query("SELECT count(customer_id) as totalCustomer FROM tbl_customer WHERE customer_status = 1")->row();
              if (isset($tcustomer)):
                  echo $tcustomer->totalCustomer;
              endif;
              ?>
          </h4>
          <span class="text-white">Customer Name</span>
        </div>
        <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
          <i class="icon-user text-white"></i></div>
      </div>
      </div>
    </div>
  </a>
</div>

</div><!--End Row-->



<!-----Start Common sell and assign at-a-glance------->
<div class="row">


  <div class="col-12 col-lg-6 col-xl-4">
    <a href="<?php echo base_url()?>invoice">
      <div class="card bg-pattern-success">
        <div class="card-body">
          <div class="media">
          <div class="media-body text-left">
            <h4 class="text-white">
                <?php
                $totalInvoiceCommonCustomer = $this->db->query("SELECT c.customer_name, i.voucher_id, sum(i.quantity * i.sale_price) as grandTotal, i.paid_amount, i.discount, i.invoice_date, i.status, i.note FROM tbl_customer c, tbl_invoice i WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted') AND i.customer_id = '1' GROUP BY i.voucher_id ORDER BY i.id DESC")->result();
                $netTotalAmountCommonCustomer = 0;
                foreach ($totalInvoiceCommonCustomer as $totalAmountCommonCustomer) {
                  $netTotalAmountCommonCustomer += $totalAmountCommonCustomer->grandTotal;
                }
                echo $netTotalAmountCommonCustomer;
                ?>
            </h4>
            <span class="text-white">Total Sell Amount (Common)</span>
          </div>
          <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
            <i class="icon-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
    </a>
  </div>


  <div class="col-12 col-lg-6 col-xl-4">
    <a href="<?php echo base_url()?>sell-list-from-common-customer">
      <div class="card bg-pattern-success">
        <div class="card-body">
          <div class="media">
          <div class="media-body text-left">
            <h4 class="text-white">
                <?php
                $totalAssignAmount = $this->db->query("SELECT *, SUM(sell_amount) AS totalAssignAmount FROM tbl_cltn_frm_cmn_cstmr WHERE trans_status = 'assign' GROUP BY trans_status")->row();
                if(isset($totalAssignAmount)){
                  if(!empty($totalAssignAmount->totalAssignAmount)){
                    echo $totalAssignAmount->totalAssignAmount;
                  }
                }
                ?>
            </h4>
            <span class="text-white">Total Assign Amount</span>
          </div>
          <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
            <i class="icon-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
    </a>
  </div>

  <div class="col-12 col-lg-6 col-xl-4">
    <a href="<?php echo base_url()?>sell-list-from-common-customer">
      <div class="card bg-pattern-success">
        <div class="card-body">
          <div class="media">
          <div class="media-body text-left">
            <h4 class="text-white">
                <?php
                if(isset($totalAssignAmount)){
                  echo $netTotalAmountCommonCustomer - $totalAssignAmount->totalAssignAmount;
                }
                ?>
            </h4>
            <span class="text-white">Need to assign</span>
          </div>
          <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
            <i class="icon-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
    </a>
  </div>

  

    
</div><!--End Row-->
<!-----END Common sell and assign at-a-glance------->

<!-------old order info from tbl_invoice ----->
<div class="row">
    

<div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>invoice">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $orders = $this->db->query("SELECT * FROM tbl_invoice WHERE NOT (order_status <=> NULL) AND NOT (delete_status <=> 'deleted') GROUP BY voucher_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Total Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>invoice">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $orders = $this->db->query("SELECT * FROM tbl_invoice WHERE order_status = 1 AND NOT (delete_status <=> 'deleted') GROUP BY voucher_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Accept Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>invoice">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $orders = $this->db->query("SELECT * FROM tbl_invoice WHERE order_status = 0 AND NOT (delete_status <=> 'deleted') GROUP BY voucher_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Not Accept</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>
  <!-------end old order info from tbl_invoice ----->

                

  <!-------order info from tbl_order ----->
<div class="col-12 col-lg-12 col-xl-12">
<h6 class="text-center">------Marketing------</h6>
</div>

<div class="col-12 col-lg-4 col-xl-4">
    <a href="<?php echo base_url()?>salesman-order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE NOT (order_status <=> NULL) AND NOT (delete_status <=> 'deleted') GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Total Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <!-- <a href="<?php echo base_url()?>salesman-order"> -->
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status = 1 AND NOT (delete_status <=> 'deleted') GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Accept Order</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    <!-- </a> -->
  </div>

  <div class="col-12 col-lg-4 col-xl-4">
    <!-- <a href="<?php echo base_url()?>salesman-order"> -->
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status = 0 AND NOT (delete_status <=> 'deleted') GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Not Accept</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    <!-- </a> -->
  </div>
<!-------end order info from tbl_order ----->

</div> <!---End Row--->

<?php } ?>


<div class="row">

  <!-- <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-uppercase">Area chart</div>
      <div class="card-body">
            <canvas id="areaChart" height="110"></canvas>
        </div>
    </div>
  </div> -->


  <!-- <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-uppercase">Line chart</div>
      <div class="card-body">
            <canvas id="lineChart" height="110"></canvas>
        </div>
    </div>
  </div> -->

</div><!--End Row-->