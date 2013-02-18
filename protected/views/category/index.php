<ul class="nav nav-pills">
    <li><a href="#category" data-toggle="modal">Новая категория</a></li>
</ul>
<table id="categories" class="table table-bordered table-striped table-hover">
    <tr>
        <th>#</th>
        <th><?php echo Yii::t('main', 'Категория');?></th>
        <th><?php echo Yii::t('main', 'Публиковать');?></th>
        <th><?php echo Yii::t('main', 'Сортировка');?></th>
        <th><?php echo Yii::t('main', 'Продукты');?></th>
        <th><?php echo Yii::t('main', 'Действие');?></th>
    </tr>
    <?php foreach($categories as $category):?>
    <tr>
        <td><?php echo $category['id']; ?></td>
        <td><?php echo $category['parent_id'] != 0?'<i class="icon-minus"></i>'.$category['name']:$category['name']; ?></td>
        <td><?php echo $category['public']; ?></td>
        <td><?php echo $category['order']; ?></td>
        <td><a href="index.php?r=product&category_id=<?php echo $category['id']; ?>"><span class="label label-success">Продукты</span><span class="badge badge-warning"><?php echo $category['cnt']; ?></span></a></td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                  Действие
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                      <a href="#category" data-toggle="modal" task="edit" cat_id="<?php echo $category['id']; ?>">Редактировать</a>
                      <a href="index.php?r=category/public&id=<?php echo $category['id']; ?>">Снять с публикации</a>
                      <a href="index.php?r=category/delete&id=<?php echo $category['id']; ?>">Удалить</a>
                  </li>
                </ul>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="category" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5>Новая категория</h5>
    </div>
    <div class="modal-body">
        <form action="">
            <fieldset>
                <input type="hidden" name="id" id="id" value="0"/>
                <div class="controls-row">
                    <label class="control-label" for="name">Название</label>
                    <div class="controls">
                        <input class="span12" type="text" name="name" id="name" value=""/>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="parent_id">Родительская категория</label>
                    <div class="controls">
                        <select class="span12" name="parent_id" id="parent_id">
                            <option value="0" selected="selected">--Не указан--</option>
                            <?php foreach($paren_categories as $item):?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="meta_keywords">META Keywords</label>
                    <div class="controls">
                        <input class="span12" type="text" name="meta_keywords" id="meta_keywords" value=""/>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="meta_desc">META Descript</label>
                    <div class="controls">
                        <input class="span12" type="text" name="meta_desc" id="meta_desc" value=""/>
                    </div>
                </div>                
            </fieldset>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Закрыть</a>
        <a href="#" class="btn btn-primary" data-dismiss="modal" id="category_save">Сохранить</a>
    </div>
</div>