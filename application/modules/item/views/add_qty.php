 
 	<div class="row clearfix">
 <form method="post" action="<?= base_url() ?>item/add_more_qty/<?= $id ?>" class="form-horizontal">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD MORE QUANTITY' ?></h2>
        
      </div>
      <div class="body">
<div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control stock_hand" name="qty" value="<?= $quantity ?>" required="" aria-required="true"  onkeypress="return isNumberKey(event)" >
                <label class="form-label">Quantity In Hand</label>
              </div>
            </div>
          </div>
 
 		<div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control adjust" name="newqty" required="" onkeyup="updateQuantity()"   aria-required="true" onkeypress="return isNumberKey(event)" >
                <label class="form-label">Adjust Quantity(Eg. +10,-10 )</label>
              </div>
            </div>
          </div>
            <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <input type="text" class="form-control newqty"    aria-required="true"   onkeypress="return isNumberKey(event)" >
                <label class="form-label">New Quantity</label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control purchase_amount" value="<?= $purchase_price ?>" name="previous_purchase_amount" required="" aria-required="true" onkeyup="totalAmount()" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Previous Purchase Amount</label>
              </div>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control purchase_amount" name="purchase_amount" required="" aria-required="true"  onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Purchase Amount</label>
              </div>
            </div>
          </div>
           <div class="form-group form-float">
           	<button type="submit" class="btn btn-default">Submit</button>
      </div>
  </div>
</div>
          </form>
</div>
<script type="text/javascript">
  function updateQuantity()
  {
    var adjust=0;
    var stock= $('.stock_hand').val();
 adjust= $('.adjust').val();
    
    if(adjust=='' || adjust==null)
    {
      $('.newqty').val('');
      $('.placeholder').removeClass('focused');
      // $('.newqty').addClass('focused');
    }
    else
    {
    // var new= parseInt(stock) + parseInt(adjust);
    $('.newqty').val(parseInt(stock)+parseInt(adjust));
    $('.placeholder').addClass('focused');
  }
    // console.log(parseInt(stock)+parseInt(adjust));

  }


</script>