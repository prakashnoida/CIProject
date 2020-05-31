<!-- PAGE -->
<?php
$thumbs = $this->crud_model->file_view('product', $row['product_id'], '', '', 'thumb', 'src', 'multi', 'all');
$mains = $this->crud_model->file_view('product', $row['product_id'], '', '', 'no', 'src', 'multi', 'all');
?>
<section class="page-section light">
  <div class="container">
    <div class="row product-single" style="margin-top: 0px">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-2 others-img">
            <?php
            $i = 1;
            foreach ($thumbs as $id => $row1) {
            ?>
            <div class="related-product " id="main<?php echo $i; ?>">
              <img class="img-responsive img" data-src="<?php echo $mains[$id]; ?>" src="<?php echo $row1; ?>" alt="" />
            </div>
            <?php
              $i++;
            }
            ?>
          </div>
          <div class="col-md-10 col-sm-10 col-xs-10 zoom">
            <div class="badges">
              <?php if ($row['featured'] == 'ok') { ?>
              <div class="hot"><?php echo translate('featured'); ?></div>
              <?php } ?>
              <?php if ($row['deal'] == 'ok') { ?>
              <div class="new"><?php echo translate("today's_deal"); ?></div>
              <?php } ?>
            </div>
            <img class="img-responsive main-img zoom" id="set_image" src="" alt="" />
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12">

        <?php if($this->session->flashdata('flashSuccess'))
        {
          ?>
          <p class='flashMsg flashSuccess btn btn-danger'> <?php echo $this->session->flashdata('flashSuccess')?> </p>
          <?php
        }
        ?>
        <br><br>
        <h3 class="product-title"><?php echo $row['title']; ?></h3>
        <?php
        if ($this->db->get_where('product', array('product_id' => $row['product_id']))->row()->is_bundle == 'no') {
        ?>
        <div class="product-info">
          <p>
            <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>">
              <?php echo $this->crud_model->get_type_name_by_id('category', $row['category'], 'category_name'); ?>
            </a>
          </p>
          ||
          <p>
            <a
              href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>/<?php echo $row['sub_category']; ?>">
              <?php echo $this->crud_model->get_type_name_by_id('sub_category', $row['sub_category'], 'sub_category_name'); ?>
            </a>
          </p>
          ||
          <p>
            <a
              href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>/<?php echo $row['sub_category']; ?>-<?php echo $row['brand']; ?>">
              <?php echo $this->crud_model->get_type_name_by_id('brand', $row['brand'], 'name'); ?>
            </a>
          </p>
        </div>
        <?php
        }
        ?>
        <?php
        if ($this->db->get_where('product', array('product_id' => $row['product_id']))->row()->is_bundle == 'yes') {
        ?>
        <div style="padding: 5px">
          <?php echo translate('products_:'); ?> <br>
          <?php
            $products = json_decode($row['products'], true);
            foreach ($products as $product) { ?>
          <!-- echo $product['product_id'].'<br>'; -->
          <a style="text-decoration:underline; font-size: 12px; padding-left: 15px;"
            href="<?php echo $this->crud_model->product_link($product['product_id']); ?>">
            <?php echo $this->db->get_where('product', array('product_id' => $product['product_id']))->row()->title . '<br>'; ?>
          </a>
          <?php
            }
            ?>
        </div>
        <?php
        }
        ?>
        <?php if ($this->db->get_where('general_settings', array('general_settings_id' => '58'))->row()->value == 'ok' and $this->db->get_where('general_settings', array('general_settings_id' => '81'))->row()->value == 'ok') { ?>
        <div class="added_by">
          <?php echo translate('sold_by_:'); ?>
          <p>
            <?php echo $this->crud_model->product_by($row['product_id'], 'with_link'); ?>
          </p>
        </div>
        <?php } ?>
        <div class="product-rating clearfix">
          <?php $rating = $this->crud_model->rating($row['product_id']); ?>
          <div class="rateit" data-rateit-value="<?= $rating ?>" data-rateit-ispreset="true"
            data-rateit-readonly="true"></div>
          <div style="display:none;" class="rating ratings_show"
            data-original-title="<?php echo $rating = $this->crud_model->rating($row['product_id']); ?>"
            data-toggle="tooltip" data-placement="left">

            <?php
            $r = $rating;
            $i = 6;
            while ($i > 1) {
              $i--;
            ?>
            <span class="star <?php if ($i <= $rating) {
                                  echo 'active';
                                }
                                $r++; ?>"></span>
            <?php
            }
            ?>
          </div>

          <div class="rating inp_rev list-inline" style="display:none;" data-pid='<?php echo $row['product_id']; ?>'>
            <span class="star rate_it" id="rating_5" data-rate="5"></span>
            <span class="star rate_it" id="rating_4" data-rate="4"></span>
            <span class="star rate_it" id="rating_3" data-rate="3"></span>
            <span class="star rate_it" id="rating_2" data-rate="2"></span>
            <span class="star rate_it" id="rating_1" data-rate="1"></span>
          </div>
          <br>
          <a class="reviews ratings_show" href="#">
            <?php echo $row['rating_num']; ?>
            <?php echo translate('review(s)'); ?>
          </a>
          <?php
          if ($this->session->userdata('user_login') == 'yes') {
            $user_id = $this->session->userdata('user_id');
            $user_products = $this->db->select('product_details')->from('sale')->where('buyer', $user_id)->get()->result_array();

            foreach ($user_products as $user_prod) {
              foreach ($user_prod as $prods) {
                $prods = json_decode($prods, true);
                foreach ($prods as $prod) {
                  //echo $prod['id'];
                  if ($prod['id'] == $row['product_id']) {
                    //echo $prod['id'];
                    $is_review = 'yes';
                  }
                }
              }
            }
            $rating_user = json_decode($row['rating_user'], true);
            if (!in_array($user_id, $rating_user)) {
              if ($is_review == 'yes') {
          ?>
          <a style="display: none;" class="add-review rev_show ratings_show" href="#">
            | <?php echo translate('add_your_review'); ?>
          </a>
          <?php
              }
            }
          }
          ?>
        </div>

        <hr class="page-divider" />
        <div class="product-price">
          Starting Bid:
          <?php
                     $product_data = $this->db->get_where('product', array('product_id' => $row['product_id']));
                     $type =  $product_data->row()->product_type;
                     $amount =  $product_data->row()->auction_base_price;
                     if($type=='auction')
                     {
                        ?>
                        <ins><?php echo currency($amount); ?></ins> 
                        <?php 
                     }
                     else
                     {
                        ?>
                        <ins>
                          <?php echo currency($row['purchase_price']); ?>
                        </ins>
                        <?php
                     }
          ?>
          

        </div>
        <div class="product-price">
          
          Current Bid:
          <?php if ($row['discount'] > 0) { ?>
          <ins>
            <?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?>
            <unit><?php echo ' /' . $row['unit']; ?></unit>
          </ins>
          <del><?php echo currency($row['sale_price']); ?></del>
          <span class="label label-success">
            <?php
              echo translate('discount:_') . $row['discount'];
              if ($row['discount_type'] == 'percent') {
                echo '%';
              } else {
                echo currency();
              }
              ?>
          </span>
          <?php } else { ?>
          <ins>
            <?php 
             $product_data = $this->db->get_where('tbl_auction', array('heighest_auction' => 1, 'product_id' => $row['product_id']));
             $last_bid_amount =  $product_data->row()->bid_amount;
             if($last_bid_amount>0)
             {
                 
                  echo currency($last_bid_amount); 
             }
             else
             {
             echo currency($amount);
             }
            ?>
            <!-- <unit><?php //echo ' /'.$row['unit'];
                          ?></unit> -->
          </ins>
          <?php } ?>

          <br>
          <?php
            $user_id = $this->session->userdata('user_id');
            $product_user = $this->db->get_where('tbl_auction', array( 'product_id' => $row['product_id'], 'user_id' => $user_id));
            if ($product_user->num_rows() != 0)
            {
              ?>
              Your Bid :  <ins><?php echo currency($product_user->row()->bid_amount);?></ins>
              <?php
            }
          ?>

        </div>
        <div class="product-price">
          <?php if ($this->session->userdata('user_login') == 'yes') { ?>

          <?php
          $user_id = $this->session->userdata('user_id');
          $product = $this->db->get_where('product', array('product_type' => 'auction' , 'product_id' => $row['product_id']));
          if ($product->num_rows() != 0)
          {
            $product_data = $this->db->get_where('tbl_auction', array('user_id' => $user_id , 'product_id' => $row['product_id']));
            if ($product_data->num_rows() == 0)
            {
              $start=strtotime($row['auction_start_date']);
              $end=strtotime($row['auction_end_date']);
              $today=strtotime(date('Y-m-d'));
              if($today>=$start && $end>=$today)
              {
                ?>
                   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Click to enter
                   bid amount</button>
                <?php
                
              }
              else if($start>$today)
              {
                echo "Bidding Start On : ".date('d-m-Y',strtotime($row['auction_start_date']));
              }
              else
              {
                echo "Bidding Complited!!!";
              }
              
            }
            else
            {
              ?>
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Click to Edit
                   bid amount</button>
              <?php
            }
          }
          ?>  
          
           <!-- Modal -->
          <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" align="center">Edit Place Automatic Bid</h4>
                </div>
                <div class="modal-body">
                  <p align="center">Enter the Target Amount for your Automatic Bid</p>
                  <div class="row">
                    <div class="col-md-12">
                      <p align="center">You will be highest bidder till the target amount that you'll enter here</p>
                    </div>
                    <div class="col-md-12" style="margin-top:-24px;">
                      <?php
                        echo form_open(base_url() . 'home/update_bid/' . (string) $row['product_id'], array(
                          'method' => 'post',
                          'id' => 'update_bid',
                        ));

                         $product_data = $this->db->get_where('tbl_auction', array('user_id' => $user_id , 'product_id' => $row['product_id']));
                         $auction_id=$product_data->row()->auction_id;
                         $auction_type=$product_data->row()->auction_type;
                         $bid_amount=$product_data->row()->bid_amount;
                         $bid_interval=$product_data->row()->bid_interval;
                         $bid_max=$product_data->row()->bid_limit;
                        ?>
                        <input type="hidden" id="auction_id" name="auction_id" value="<?php echo $product_data->row()->auction_id;?>">
                        <input type="hidden" id="auction_type" name="auction_type" value="<?php echo $product_data->row()->auction_type;?>">

                          <div class="form-group btm_border">
                                <label class="col-sm-3 control-label" for="demo-hor-6"><?php echo translate('bid_type');?></label>
                                <div class="col-sm-9" style="margin-top: -4px;">
                                    <input type="radio" name="bid_type" onchange="sel_business_type1(this.value,<?php echo $auction_id;?>)"   id="chk_type1"
                                    <?php if($auction_type=='fixed'){ echo "checked=checked";}?>
                                     value="fixed"> Fixed Bid
                                    <input type="radio" name="bid_type" onchange="sel_business_type1(this.value,<?php echo $auction_id;?>)" <?php if($auction_type=='proxy'){ echo "checked=checked";}?> id="chk_type1" value="proxy"> Proxy Bid

                                </div>
                          </div>
                          <br>
                          <p id="business1">
                          </p>
                         

                      
                      <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                    </div>
                    
                  </div>
                </div>
                <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div> -->
              </div>

            </div>
          </div>

          <!------------------------------>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" align="center">Place Automatic Bid</h4>
                </div>
                <div class="modal-body">
                  <p align="center">Enter the Target Amount for your Automatic Bid</p>
                  <div class="row">
                    <div class="col-md-12">
                      <p align="center">You will be highest bidder till the target amount that you'll enter here</p>
                    </div>
                    <div class="col-md-12" style="margin-top:-24px;">
                      <?php
                        echo form_open(base_url() . 'home/add_bid/' . (string) $row['product_id'], array(
                          'method' => 'post',
                          'id' => 'add_bid'
                        ));
                        ?>

                          <div class="form-group btm_border">
                                <label class="col-sm-3 control-label" for="demo-hor-6"><?php echo translate('bid_type');?></label>
                                <div class="col-sm-9" style="margin-top: -4px;">
                                    <input type="radio" name="bid_type" onchange="sel_business_type(this.value)"  checked id="chk_type" value="fixed"> Fixed Bid
                                    <input type="radio" name="bid_type" onchange="sel_business_type(this.value)"  id="chk_type" value="proxy"> Proxy Bid
                                </div>
                          </div>
                          <br>
                          <p id="business">
                          </p>

                      
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    
                  </div>
                </div>
                <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div> -->
              </div>

            </div>
          </div>
          <?php } else 
          { 

            ?>
            Please Login...
            <?php 
          } 
          ?>
        </div>
        <?php
        // include 'order_option.php';
        ?>
      </div>
    </div>
  </div>
</section>

<!-- /PAGE -->

<script>
    $(document).ready(function(){
        var a=$("#chk_type").val();

        $.ajax({
            type:"GET",
            data:{a:a},
            url:"<?php echo base_url();?>vendor/sel_auction_type",
            success:function(response){
                $("#business").html(response);
            }
        });

        var a1=$("#auction_type").val();
        var b1=$("#auction_id").val();
        $.ajax({
            type:"GET",
            data:{a1:a1,b1:b1},
            url:"<?php echo base_url();?>vendor/sel_auction_type1",
            success:function(response){
                $("#business1").html(response);
                $(".edit_data").css('display','none');
            }
        });

    });
    function sel_business_type(a)
    {
        $.ajax({
            type:"GET",
            data:{a:a},
            url:"<?php echo base_url();?>vendor/sel_auction_type",
            success:function(response){
                $("#business").html(response);
                $(".edit_data").css('display','none');
            }
        });
    }

    function sel_business_type1(a1,b1)
    {
      
        $.ajax({
            type:"GET",
            data:{a1:a1,b1:b1},
            url:"<?php echo base_url();?>vendor/sel_auction_type1",
            success:function(response){
                $("#business1").html(response);
                $(".edit_data").css('display','none');
            }
        });
    }

$(".img").click(function() {
  var src = $(this).data('src');
  $("#set_image").attr("src", src);
  $(".related-product").removeClass("selected");
  $(this).closest(".related-product").addClass("selected");
});
$(document).ready(function() {
  $("#main1").addClass("selected");
  var src = $("#main1").find(".img").data('src');
  $("#set_image").attr("src", src);
});

$(function() {
  //setTimeout(function(){
  $('.zoom').zoome({
    hoverEf: 'transparent',
    showZoomState: true,
    magnifierSize: [200, 200]
  });
  //}, 3000);

});

function destroyZoome(obj) {
  if (obj.parent().hasClass('zm-wrap')) {
    obj.unwrap().next().remove();
  }
}
</script>
<script>
$('body').on('click', '.rev_show', function() {
  $('.ratings_show').hide('fast');
  $('.inp_rev').show('slow');
});
</script>
<style>
.rate_it {
  display: none;
}

.product-single .badges div {
  padding: 0 5px !important;
}

.product-price del {
  font-weight: 400;
  font-size: 24px;
}
</style>