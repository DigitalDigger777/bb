<table class="table table-bordered table-striped">
    <tr>
        <th>#</th>
        <th>ФИО</th>
        <th>Email</th>
        <th>моб. тел.</th>
        <th>тел.</th>
        <th>Способ доставки</th>
        <th>Адрес</th>
        <th>Доп. инфо.</th>
        <th>Дата</th>
    </tr>
    <?php foreach($orders as $order):?>
    <tr>
        <td><?php echo $order['id']; ?></td>
        <td><?php echo $order['full_name']; ?></td>
        <td><?php echo $order['email']; ?></td>
        <td><?php echo $order['mobile_phone']; ?></td>
        <td><?php echo $order['phone']; ?></td>
        <td><?php echo $order['delivery']; ?></td>
        <td><?php echo $order['address']; ?></td>
        <td><?php echo $order['info']; ?></td>
        <td><?php echo $order['date']; ?></td>
    </tr>
    <?php endforeach;?>
</table>