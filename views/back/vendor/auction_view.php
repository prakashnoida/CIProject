<!--CONTENT CONTAINER-->


<h4 class="modal-title text-center padd-all"><?php echo translate('details_of_auction');?></h4>
	<hr style="margin: 10px 0 !important;">
    <div class="row">
    <div class="col-md-12">
        <div class="text-center pad-all">
           
            <div class="col-md-12">   
                <table class="table table-striped" style="border-radius:3px;">
                    <tr>
                        <td class="custom_td"><?php echo translate('sr. no');?></td>
                        <td class="custom_td"><?php echo translate('customer_name');?></td>
                        <td class="custom_td"><?php echo translate('customer_email');?></td>
                         <td class="custom_td"><?php echo translate('auction_price');?></td>
                        <td class="custom_td"><?php echo translate('action');?></td>
                    </tr>
        <?php 
        $n=1;
        foreach($product_data as $row)
        { 
           ?>
           <tr>
                <td class="custom_td"><?php echo $n++;?></td>
               
                <td class="custom_td"><?php echo $row->surname;?></td>
                <td class="custom_td"><?php echo $row->email;?></td>
                <td class="custom_td">$ <?php echo $row->bid_amount;?></td>
                <td>
                    <?php
                        $auction_status = $row->auction_status;
                        if($auction_status=="" || $auction_status==0  )
                        {
                            ?>
                            <button class="btn btn-success btn-xs btn-labeled fa fa-wrench" onclick=sel_accept(this.value) value="<?php echo $row->auction_id;?>" data-toggle="tooltip" 
                                 data-original-title="Edit" data-container="body">
                                   <?php echo translate('accept');?>
                            </button>
                            <?php
                        }
                        elseif($auction_status=="1")
                        {
                            ?>
                            <button class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                                 data-original-title="Edit" data-container="body">
                                   <?php echo translate('accepted');?>
                            </button>
                            <?php
                        }
                        else
                        {
                            
                        }
                    ?>
                   
                </td>
            </tr>
           <?php
        }
        ?>

                </table>
            </div>
            <hr>
        </div>
    </div>
</div>				

<script>
    function sel_accept(a)
    {
        var auction_id=a;
        $.ajax({
            type:"GET",
            data:{auction_id:auction_id},
            url:"<?php echo base_url();?>vendor/auction_update",
            success:function(){
                alert("Your Bid Is Accepted.");
            }
        });
    }
</script>
            
<style>
.custom_td{
border-left: 1px solid #ddd;
border-right: 1px solid #ddd;
border-bottom: 1px solid #ddd;
}
</style>

<script>
	$(document).ready(function(e) {
		proceed('to_list');
	});
</script>