<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
<div class="brand-logo">
 <a href="<?php echo base_url();?>">
  <?php $shopInfo = $this->db->query("SELECT * FROM tbl_user WHERE user_id = 1")->row();?>
  <img src="<?php echo base_url().$shopInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 20px;">
  <h5 class="logo-text">POS</h5>
</a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
 <li class="sidebar-header">MAIN NAVIGATION</li>

<?php if($userInfo->user_role == 3){ ?>

  <!-- <li>
    <a href="<?php echo base_url('order');?>" class="waves-effect">
      <i class="fa fa-file"></i> <span>Order</span> 
    </a>

  </li> -->

  <li>
    <a href="<?php echo base_url('salesman-order-form');?>" class="waves-effect">
      <i class="fa fa-file"></i> <span>Order</span> 
    </a>

  </li>

  <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-line-chart" aria-hidden="true"></i>
      <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        <!-- <li>
            <a href="<?php echo base_url('month-report');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Date wise Invoice</span> 
            </a>
        </li> -->
        
        <li>
            <a href="<?php echo base_url('all-report-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-area-chart"></i> <span>All Reports</span> 
            </a>
        </li>
        
    </ul>
  </li>

  <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-building-o" aria-hidden="true"></i>
      <span>Visit Info</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        
        
        <li>
            <a href="<?php echo base_url('visit-add');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-building"></i> <span>Visit</span> 
            </a>
        </li>

        
    </ul>
  </li>

<?php }else{ ?>
  


 <li>
   <a href="<?php echo base_url();?>" class="waves-effect">
     <i class="icon-home"></i> <span>Dashboard</span> 
   </a>

 </li>
 
 <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="icon-briefcase"></i>
      <span>Setup File</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        <li>
            <a href="<?php echo base_url('company-setup');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Company-setup</span> 
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('suppliers-form');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Suppliers</span> 
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('products-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Product</span> 
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('customer-form');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Customer</span> 
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('warehouse-form');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Outlet</span> 
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('marketing-setup-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Marketing</span> 
            </a>
        </li>
    </ul>
  </li>

  <li>
      <a href="<?php echo base_url('stock-in-form');?>" class="waves-effect">
        <i aria-hidden="true" class="fa fa-shopping-cart"></i> <span>Stock In</span> 
      </a>
  </li>


  <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span>Expense </span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        <li>
            <a href="<?php echo base_url('transaction-head-add');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Expense Head</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('costs-list');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Expense List</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('expense-report-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-line-chart" aria-hidden="true"></i> <span>Expense Reports</span> 
            </a>
        </li>
        
    </ul>
  </li>


  <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-cogs" aria-hidden="true"></i>
      <span>Account Setup </span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">

        <li>
            <a href="<?php echo base_url('fiscal-year');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-cog" aria-hidden="true"></i> <span>Fiscal Year</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('account-sub-head');?>" class="waves-effect">
              <i class="fa fa-cog" aria-hidden="true"></i> <span>Sub Head</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('account-sub-sub-head');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-cog"></i> <span>Sub Sub Head</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('acnt-tansaction-head-list');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-cog" aria-hidden="true"></i> <span>Transaction Head</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('opening-balance');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-cog" aria-hidden="true"></i> <span>Opening Balance</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('transaction-list');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-cog" aria-hidden="true"></i> <span>Transaction</span> 
            </a>
        </li>
        
        
        <li>
            <a href="<?php echo base_url('journal-transaction-list');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-cog" aria-hidden="true"></i> <span>Journal Transaction</span> 
            </a>
        </li>


        <li>
            <a href="<?php echo base_url('account-reports-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-line-chart" aria-hidden="true"></i> <span>Accounts Report</span> 
            </a>
        </li>
        
    </ul>
  </li>


  <li>
   <a href="<?php echo base_url('invoice-form');?>" class="waves-effect">
     <i class="fa fa-file"></i> <span>Invoice</span> 
   </a>

 </li>


 <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span>Assign & Collection</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        
        
        <li>
            <a href="<?php echo base_url('sell-list-from-common-customer');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-money"></i> <span>Assign Amount</span> 
            </a>
        </li>
        
        <li>
            <a href="<?php echo base_url('amount-recieved-list-from-common-customer');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-money"></i> <span>Recived Amount</span> 
            </a>
        </li>

        <li>
            <a href="<?php echo base_url('assign-collection-report-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-line-chart" aria-hidden="true"></i> <span>Report</span> 
            </a>
        </li>
        
    </ul>
  </li>


 <li>
   <a href="<?php echo base_url('loan');?>" class="waves-effect">
     <i class="zmdi zmdi-money-box"></i> <span>Loan</span> 
   </a>

 </li>
 <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-line-chart" aria-hidden="true"></i>
      <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        <!-- <li>
            <a href="<?php echo base_url('month-report');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-circle-o"></i> <span>Date wise Invoice</span> 
            </a>
        </li> -->
        
        <li>
            <a href="<?php echo base_url('all-report-section');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-area-chart"></i> <span>All Reports</span> 
            </a>
        </li>
        
    </ul>
  </li>
 
 <li>
    <a href="javaScript:void();" class="waves-effect">
      <i class="fa fa-user" aria-hidden="true"></i>
      <span>User</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="sidebar-submenu">
        
        
        <li>
            <a href="<?php echo base_url('all-users');?>" class="waves-effect">
              <i aria-hidden="true" class="fa fa-user-o"></i> <span>All users</span> 
            </a>
        </li>
        
    </ul>
  </li>

  <li>
   <a href="<?php echo base_url('qrcode');?>" class="waves-effect">
     <i class="fa fa-file"></i> <span>QR Code</span> 
   </a>

 </li>

 <?php } ?>
  
 
</ul>

</div>
