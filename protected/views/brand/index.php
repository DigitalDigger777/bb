<ul class="nav nav-pills">
    <li><a href="#brand" data-toggle="modal">Новый бренд</a></li>
</ul>
<table class="table table-bordered table-striped">
    <tr>
        <th>#</th>
        <th><?php echo Yii::t('main', 'Логотип');?></th>
        <th><?php echo Yii::t('main', 'Название');?></th>
        <th><?php echo Yii::t('main', 'Описание');?></th>
        <!--<th><?php echo Yii::t('main', 'Язык');?></th>-->
        <th><?php echo Yii::t('main', 'Публикация');?></th>
        <th><?php echo Yii::t('main', 'Сортировка');?></th>
        <th><?php echo Yii::t('main', 'Продукты');?></th>
    </tr>
    <?php foreach($brands as $brand):?>
    <tr>
        <td><?php echo $brand['id']; ?></td>
        <td><img src="<?php echo Yii::app()->baseUrl; ?>/images/brands/<?php echo $brand['logo']; ?>" alt="" /></td>
        <td><?php echo $brand['name']; ?></td>
        <td><?php echo $brand['desc']; ?></td>
        <!--<td><?php echo $brand['lang']; ?></td>-->
        <td><?php echo $brand['public']; ?></td>
        <td><?php echo $brand['order']; ?></td>
        <td><a href="<?php echo $this->createUrl('product', array('brand_id'=>$brand['id']));?>"><span class="label label-success">Продукты</span><span class="badge badge-warning"><?php echo $brand['cnt']; ?></span></a></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="brand" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5>Новый бренд</h5>
    </div>
    <div class="modal-body">
        <form action="">
            <fieldset>
                <input type="hidden" name="parent_id" value="0"/>
                <div class="controls-row">
                    <label class="control-label" for="name">Название</label>
                    <div class="controls">
                        <input class="span12" type="text" name="name" id="name" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Закрыть</a>
        <a href="#" class="btn btn-primary" data-dismiss="modal" id="brand_save">Сохранить</a>
    </div>
</div>
<script type="text/javascript">
(function($){
    $('document').ready(function(){
        //сохранение бренда
        $('#brand_save').click(function(){
            var url = base_url+'brand/save';
            $.ajax({
                url:url,
                data:{
                    name:$('#name').val()
                },
                success:function(obj){
                    window.location = 'index';
                },
                error:function(obj){
                    console.log(obj);
                }
            });            
        });        
    });
    
})(jQuery)
</script>