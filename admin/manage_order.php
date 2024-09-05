<?php include('partials/menu.php'); ?>
<div class="main content">
    <div class="wrapper">
        <h1>Manage order</h1>

        <br /><br /><br />
        <?php 
            if(isset($_SESSION['update']))
            {
                echo$_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>food</th>
                <th>price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            // get all the orders from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";// order by id desc is keep the new order in first
            // execute the query
            $res = mysqli_query($conn, $sql);
            // count the rows
            $count = mysqli_num_rows($res);
            $sn = 1; // creat a serial number and set its intailsvalue as 1
            if ($count > 0) {
                // order available 
                while ($row = mysqli_fetch_assoc($res)) {
                    // get all the orders details
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>
                            <?php
                                // ordered on delivery delivered cancelled
                                if($status=="ordered")
                                {
                                    echo"<lable>$status</lable>";
                                }
                                elseif($status=="on delivery")
                                {
                                    echo"<lable style='color:orange;'>$status</lable>";
                                }
                                elseif($status=="delivered")
                                {
                                    echo"<lable style='color:green;'>$status</lable>";
                                }
                                elseif($status=="cancelled")
                                {
                                    echo"<lable style='color:red;'>$status</lable>";
                                }


                            ?>
                        </td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">update order</a>
                            <!-- <a href="#"class="btn-danger">Delete Admin</a> -->
                        </td>
                    </tr>
            <?php

                }
            } else {
                // order not available
                echo "<tr><td clospan='12' class='error'>Order not available</td></tr>";
            }
            ?>
        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>