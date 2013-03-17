<table class="table table-bordered table-striped">
    <tr>
        <th>#</th>
        <th>ФИО</th>
        <th>Email</th>
        <th>моб. тел.</th>
        <th>Способ доставки</th>
        <th>Адрес</th>
        <th>Доп. инфо.</th>
        <th>Дата</th>
        <th></th>
    </tr>
    <?php foreach($orders as $order):?>
    <tr>
        <td><?php echo $order['id']; ?></td>
        <td><?php echo $order['full_name']; ?></td>
        <td><?php echo $order['email']; ?></td>
        <td><?php echo $order['mobile_phone']; ?></td>
        <td><?php echo $order['delivery']; ?></td>
        <td><?php echo $order['address']; ?></td>
        <td><?php echo $order['info']; ?></td>
        <td><?php echo  $order['date']; ?></td>
        <th><a href="<?php echo $this->createUrl('order/products', array('order_id'=>$order['id']));?>" class="btn btn-primary btn-small">Товары</a></th>
    </tr>
    <?php endforeach;?>
</table>