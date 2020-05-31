							<div class="information-title">
                            	<?php echo translate('bids_awarded');?></div>
                            <div class="bids_awarded">
                                <table class="table" style="background: #fff;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo translate('date');?></th>
                                            <th><?php echo translate('product_name');?></th>
                                            <th><?php echo translate('amount');?></th>
                                            
                                            <th><?php echo translate('bid_status');?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result4">
                                        <?php
                                        
                                       
        
                                            $n=1;
                                            $user_id=$row['user_id'];
                                           $sql = "select * from tbl_auction c1,product c2 where c1.product_id=c2.product_id ";
                                            $query = $this->db->query($sql);
                                            $data = $query->result_array();
                                            foreach($data as $value)
                                            {
                                                ?>
                                                <tr>
                                                    <th><?php echo $n++;?></th>
                                                    <th><?php echo $value['cdate'];?></th>
                                                    <th><?php echo $value['title'];?></th>
                                                    <th><?php echo $value['bid_amount'];?></th>
                                                    
                                                    <th><?php 
                                                            if($value['auction_status']=='1')
                                                            {
                                                                echo "Accept";
                                                            }
                                                            elseif($value['auction_status']=='0')
                                                            {
                                                                echo "Pending";
                                                            }
                                                            else
                                                            {
                                                                echo "Reject";
                                                            }
                                                        ?></th>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                           </div>


                            <input type="hidden" id="page_num4" value="0" />

                            <div class="pagination_box">

                            </div>

                            