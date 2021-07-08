<div class="row mt-3">


<?php
  if($userInfo->user_role == 3){
?>

<!-------old order info from tbl_ivoice ----->
  <!---<div class="col-12 col-lg-4 col-xl-4">
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
  </div> --->
<!-------end old order info from tbl_ivoice ----->

<!-------order info from tbl_order ----->
<div class="col-12 col-lg-12 col-xl-12">
<h6 class="text-center">------Marketing------</h6>
</div>

<div class="col-12 col-lg-3 col-xl-3">
    <a href="<?php echo base_url()?>salesman-order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE NOT (order_status <=> 2) AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY order_id")->result();
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

  <div class="col-12 col-lg-3 col-xl-3">
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

  <div class="col-12 col-lg-3 col-xl-3">
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

  <div class="col-12 col-lg-3 col-xl-3">
    <a href="<?php echo base_url()?>reject-salesman-order-list">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status = 2 AND NOT (delete_status <=> 'deleted') AND order_by = '$userId' GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Rejected</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>
<!-------end order info from tbl_order ----->

<?php
  }elseif($userInfo->user_role == 1){
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


<div class="col-12 col-lg-6 col-xl-3">
  <a href="<?php echo base_url()?>all-products-stock-report">
    <div class="card bg-pattern-warning">
      <div class="card-body">
        <div class="media">
        <div class="media-body text-left">
          <h4 class="text-white">
              STOCK
          </h4>
          <span class="text-white">Stock Report</span>
        </div>
        <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
          <i class="icon-basket-loaded text-white"></i></div>
      </div>
      </div>
    </div>
  </a>
</div>

<div class="col-12 col-lg-6 col-xl-3">
    <a href="<?php echo base_url()?>supplier-due-list">
      <div class="card bg-pattern-danger">
        <div class="card-body">
          <div class="media">
          <div class="media-body text-left">
            <h4 class="text-white">
                <?php
                $totalSupplierDue = $this->db->query("SELECT SUM(c.due) AS totalSupplierDue FROM ( SELECT a.supplier_id, a.bill_no, ROUND(a.totalBuyingPrice, 2) as totalBuyingPrice, b.totalPayment, ROUND((a.totalBuyingPrice - b.totalPayment), 2) as due FROM ( SELECT bill_no, SUM(quantity_in * buying_price) AS totalBuyingPrice, supplier_id FROM tbl_stock_in GROUP BY bill_no ) a LEFT OUTER JOIN (SELECT bill_no, sum(payment) as totalPayment FROM tbl_stock_in_history GROUP BY bill_no) b ON(a.bill_no = b.bill_no) ) c JOIN tbl_supplier s ON(c.supplier_id = s.supplier_id) WHERE c.due > 0")->row();
                if (isset($totalSupplierDue)):
                    echo $totalSupplierDue->totalSupplierDue;
                endif;
                ?>
            </h4>
            <span class="text-white">Supplier Due</span>
          </div>
          <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
            <i class="icon-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
  </a>
</div>

<div class="col-12 col-lg-6 col-xl-3">
    <a href="<?php echo base_url()?>customer-wise-report-payment">
      <div class="card bg-pattern-primary">
        <div class="card-body">
          <div class="media">
          <div class="media-body text-left">
            <h4 class="text-white">
                <?php
                $finalDue = $this->db->query("SELECT SUM(((d.grandTotal - d.discount) - d.paid_amount)) AS finalDue FROM (SELECT a.customer_name, a.grandTotal, sum(b.discount) as discount, SUM(b.paid_amount) AS paid_amount FROM (SELECT i.customer_id, c.customer_name, sum(i.quantity * i.sale_price) as grandTotal FROM tbl_invoice i, tbl_customer c WHERE c.customer_id = i.customer_id AND NOT (i.delete_status <=> 'deleted') GROUP BY c.customer_name) a LEFT JOIN (SELECT i.paid_amount, i.voucher_id, i.customer_id, c.customer_name, i.discount FROM tbl_invoice i, tbl_customer c WHERE i.customer_id = c.customer_id GROUP BY i.voucher_id) b ON a.customer_id = b.customer_id GROUP BY a.customer_id) d")->row();
                if (isset($finalDue)):
                    echo $finalDue->finalDue;
                endif;
                ?>
            </h4>
            <span class="text-white">Customer Due</span>
          </div>
          <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
            <i class="icon-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
  </a>
</div>

<div class="col-12 col-lg-6 col-xl-3">
    <a href="<?php echo base_url()?>datewise-profit">
      <div class="card bg-pattern-success">
        <div class="card-body">
          <div class="media">
          <div class="media-body text-left">
            <h4 class="text-white">
                <?php
                $profit = $this->db->query("SELECT ROUND(NVL(SUM(prft.profit), 0), 2) AS profit FROM (SELECT p.product_name, ps.pack_size, i.invoice_date, i.product_id, sum(i.quantity * sale_price) as totalSalePrice, SUM(i.quantity) as totalSellQuantity, p.buy_price, (p.buy_price * SUM(i.quantity)) AS totalBuyPrice, ((sum(i.quantity * sale_price)) - (p.buy_price * SUM(i.quantity))) AS profit FROM tbl_invoice i JOIN tbl_product_info p ON(i.product_id = p.product_id) JOIN tbl_pack_size ps on(p.pack_size = ps.id) WHERE DATE(i.invoice_date) = CURDATE() GROUP BY i.product_id) prft")->row();
                if (isset($profit)):
                    echo $profit->profit;
                endif;
                ?>
            </h4>
            <span class="text-white">Today's Profit</span>
          </div>
          <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
            <i class="icon-pie-chart text-white"></i></div>
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

<div class="row">
    <!-------order info from tbl_order ----->
<div class="col-12 col-lg-12 col-xl-12">
<h6 class="text-center">------Marketing------</h6>
</div>

<div class="col-12 col-lg-3 col-xl-3">
    <a href="<?php echo base_url()?>salesman-order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status != 2 AND NOT (delete_status <=> 'deleted') GROUP BY order_id")->result();
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

  <div class="col-12 col-lg-3 col-xl-3">
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

  <div class="col-12 col-lg-3 col-xl-3">
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

  <div class="col-12 col-lg-3 col-xl-3">
    <a href="<?php echo base_url()?>reject-salesman-order-list">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                  $userId = $this->session->userdata('user_id');
                  $orders = $this->db->query("SELECT * FROM tbl_order WHERE order_status = 2 AND NOT (delete_status <=> 'deleted') GROUP BY order_id")->result();
                  if (isset($orders)):
                      echo count($orders);
                  endif;
                  ?>
              </h4>
              <span class="text-white">Rejected</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>
<!-------end order info from tbl_order ----->
</div>

<?php }elseif($userInfo->user_role == 4 || $userInfo->user_role == 2){ ?>
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





<div class="row">
    <!-------order info from tbl_order ----->
<div class="col-12 col-lg-12 col-xl-12">
<h6 class="text-center">------Marketing------</h6>
</div>

<div class="col-12 col-lg-3 col-xl-3">
    <a href="<?php echo base_url()?>salesman-order">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                    $user_id = $this->session->userdata('user_id');
                    if($userInfo->user_role == 2):
                      $orders = $this->db->query("SELECT o.*, u.user_name, u.user_role, u.m_rm_s_id, s.name salesmane_name, s.regional_manager_id, s.manager_id, uu.user_name, uu.user_id as regional_manager_user_id FROM tbl_order o JOIN tbl_user u ON o.order_by = u.user_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.regional_manager_id WHERE NOT (o.order_status <=> 2) AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 2 AND uu.user_id = $user_id GROUP BY o.order_id")->result();
                    elseif($userInfo->user_role == 4):
                      $orders = $this->db->query("SELECT o.*, sum(o.quantity * o.sale_price) as grandTotal, c.customer_name, u.user_name, u.user_role, u.m_rm_s_id, s.id, s.name, s.manager_id, s.regional_manager_id, uu.user_id, uu.user_role FROM tbl_order o JOIN tbl_user u ON u.user_id = o.order_by JOIN tbl_customer c ON o.customer_id = c.customer_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.manager_id WHERE NOT (o.order_status <=> 2) AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 4 AND uu.user_id = $user_id GROUP BY o.order_id ORDER BY convert(o.order_id, decimal) DESC")->result();
                    endif;
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

  <div class="col-12 col-lg-3 col-xl-3">
    <!-- <a href="<?php echo base_url()?>salesman-order"> -->
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                    $user_id = $this->session->userdata('user_id');
                    if($userInfo->user_role == 2):
                      $orders = $this->db->query("SELECT o.*, u.user_name, u.user_role, u.m_rm_s_id, s.name salesmane_name, s.regional_manager_id, s.manager_id, uu.user_name, uu.user_id as regional_manager_user_id FROM tbl_order o JOIN tbl_user u ON o.order_by = u.user_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.regional_manager_id WHERE o.order_status = 1 AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 2 AND uu.user_id = $user_id GROUP BY o.order_id")->result();
                    elseif($userInfo->user_role == 4):
                      $orders = $this->db->query("SELECT o.*, sum(o.quantity * o.sale_price) as grandTotal, c.customer_name, u.user_name, u.user_role, u.m_rm_s_id, s.id, s.name, s.manager_id, s.regional_manager_id, uu.user_id, uu.user_role FROM tbl_order o JOIN tbl_user u ON u.user_id = o.order_by JOIN tbl_customer c ON o.customer_id = c.customer_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.manager_id WHERE o.order_status = 1 AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 4 AND uu.user_id = $user_id GROUP BY o.order_id ORDER BY convert(o.order_id, decimal) DESC")->result();
                    endif;
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

  <div class="col-12 col-lg-3 col-xl-3">
    <!-- <a href="<?php echo base_url()?>salesman-order"> -->
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                    $user_id = $this->session->userdata('user_id');
                    if($userInfo->user_role == 2):
                      $orders = $this->db->query("SELECT o.*, u.user_name, u.user_role, u.m_rm_s_id, s.name salesmane_name, s.regional_manager_id, s.manager_id, uu.user_name, uu.user_id as regional_manager_user_id FROM tbl_order o JOIN tbl_user u ON o.order_by = u.user_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.regional_manager_id WHERE o.order_status = 0 AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 2 AND uu.user_id = $user_id GROUP BY o.order_id")->result();
                    elseif($userInfo->user_role == 4):
                      $orders = $this->db->query("SELECT o.*, sum(o.quantity * o.sale_price) as grandTotal, c.customer_name, u.user_name, u.user_role, u.m_rm_s_id, s.id, s.name, s.manager_id, s.regional_manager_id, uu.user_id, uu.user_role FROM tbl_order o JOIN tbl_user u ON u.user_id = o.order_by JOIN tbl_customer c ON o.customer_id = c.customer_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.manager_id WHERE o.order_status = 0 AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 4 AND uu.user_id = $user_id GROUP BY o.order_id ORDER BY convert(o.order_id, decimal) DESC")->result();
                    endif;
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

  <div class="col-12 col-lg-3 col-xl-3">
    <a href="<?php echo base_url()?>reject-salesman-order-list">
        <div class="card bg-pattern-primary">
          <div class="card-body">
            <div class="media">
            <div class="media-body text-left">
              <h4 class="text-white">
                  <?php
                    $user_id = $this->session->userdata('user_id');
                    if($userInfo->user_role == 2):
                      $orders = $this->db->query("SELECT o.*, u.user_name, u.user_role, u.m_rm_s_id, s.name salesmane_name, s.regional_manager_id, s.manager_id, uu.user_name, uu.user_id as regional_manager_user_id FROM tbl_order o JOIN tbl_user u ON o.order_by = u.user_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.regional_manager_id WHERE o.order_status = 2 AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 2 AND uu.user_id = $user_id GROUP BY o.order_id")->result();
                    elseif($userInfo->user_role == 4):
                      $orders = $this->db->query("SELECT o.*, sum(o.quantity * o.sale_price) as grandTotal, c.customer_name, u.user_name, u.user_role, u.m_rm_s_id, s.id, s.name, s.manager_id, s.regional_manager_id, uu.user_id, uu.user_role FROM tbl_order o JOIN tbl_user u ON u.user_id = o.order_by JOIN tbl_customer c ON o.customer_id = c.customer_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.manager_id WHERE o.order_status = 2 AND NOT(o.delete_status <=> 'deleted') AND uu.user_role = 4 AND uu.user_id = $user_id GROUP BY o.order_id ORDER BY convert(o.order_id, decimal) DESC")->result();
                    endif;
                    if (isset($orders)):
                        echo count($orders);
                    endif;
                  ?>
              </h4>
              <span class="text-white">Rejected</span>
            </div>
            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
              <i class="icon-basket-loaded text-white"></i></div>
          </div>
          </div>
        </div>
    </a>
  </div>
<!-------end order info from tbl_order ----->

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