<div class="row mt-3">
<div class="col-12 col-lg-6 col-xl-2">
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
        <span class="text-white">Products</span>
      </div>
      <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
        <i class="icon-basket-loaded text-white"></i></div>
     </div>
    </div>
  </div>
  </a>
</div>
<div class="col-12 col-lg-6 col-xl-2">
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
        <span class="text-white">Supplier</span>
      </div>
       <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
        <i class="icon-wallet text-white"></i></div>
    </div>
    </div>
  </div>
</div>
<div class="col-12 col-lg-6 col-xl-2">
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
        <span class="text-white">Category</span>
      </div>
      <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
        <i class="icon-pie-chart text-white"></i></div>
    </div>
    </div>
  </div>
</div>
<div class="col-12 col-lg-6 col-xl-2">
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
        <span class="text-white">Customer</span>
      </div>
      <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
        <i class="icon-user text-white"></i></div>
    </div>
    </div>
  </div>
</div>

</div><!--End Row-->




<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-uppercase">Area chart</div>
      <div class="card-body">
            <canvas id="areaChart" height="110"></canvas>
        </div>
    </div>
  </div>
  <!-- <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-uppercase">Line chart</div>
      <div class="card-body">
            <canvas id="lineChart" height="110"></canvas>
        </div>
    </div>
  </div> -->
</div><!--End Row-->