<div class="span12">
    <div class="row-fluid">
        <div class="span12">
            <table class="table table-hover">
                <tr>
                    <th style="width: 70%">Название</th>
                    <th style="width: 10%">Количество</th>
                    <th style="width: 10%">Цена</th>
                    <th style="width: 10%"></th>
                </tr>
                <?php foreach($products as $product):?>
                <tr>
                    <td><?php echo $product->name; ?></td>
                    <td><input type="number" name="count" style="width: 30px" value="<?php echo isset($cart[$product->id]['count'])?$cart[$product->id]['count']:1; ?>" product_id="<?php echo $product->id; ?>"/></td>
                    <td><?php echo $product->price; ?></td>
                    <td><a href="#" class="btn btn-danger delete" product_id="<?php echo $product->id; ?>">Удалить</a></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <a href="index.php?r=cart/order" class="btn btn-primary">Заказать</a>
        </div>
    </div>
</div>