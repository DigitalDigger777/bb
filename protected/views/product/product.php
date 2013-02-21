<div class="row-fluid">
    <div class="span4 well">
        <!--<img src="http://placehold.it/350x350" alt="" />-->
        <?php if(isset($product)):?>
        <img class="photo" src="images/products/<?php echo $product->photo; ?>" alt="" />
        <?php else:?>
        <img class="photo" src="http://placehold.it/350x350" alt="" />
        <?php endif; ?>
        <form id="upload_photo" action="index.php?r=CompanyObject/uploadphoto" method="POST" enctype="multipart/form-data" target="result_upload" style="display:none">
            <input type="file" name="_photo" id="_photo" />
        </form>
        <iframe name="result_upload" id="result_upload" src="" frameborder="0" style="width: 0; height: 0"></iframe>
    </div>
    <div class="span8 well">
        <form action="index.php?r=product/save" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($product)?$product->id:''; ?>"/>
            <input type="hidden" name="photo" value="<?php echo isset($product)?$product->photo:''; ?>"/>
            <fieldset>
                <div class="controls-row">
                    <label class="control-label" for="name">Название товара</label>
                    <div class="controls">
                        <input class="span12" type="text" name="name" id="name" value="<?php echo isset($product)?$product->name:''; ?>" />
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="price">Цена либо линк</label>
                    <div class="controls">
                        <input class="span12" type="text" name="price" id="price" value="<?php echo isset($product)?!empty($product->ebay)?$product->ebay:$product->price:''; ?>"/>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="price">Стоимость доставки</label>
                    <div class="controls">
                        <input class="span12" type="text" name="delivery_price" id="delivery_price" value="<?php echo isset($product)?$product->delivery_price:''; ?>"/>
                    </div>
                </div>                
                <div class="controls-row">
                    <label class="control-label" for="">Наценка</label>
                    <div class="controls">
                        <input class="span12" type="text" name="margin" id="margin" value="<?php echo isset($product)?$product->margin:''; ?>"/>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="discount">Скидка от цены</label>
                    <div class="controls">
                        <input class="span12" type="text" name="discount" id="discount" value="<?php echo isset($product)?$product->discount:''; ?>"/>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="category_id">Категории</label>
                    <div class="controls">
                        <select class="span12" name="category_id[]" id="category_id" data-placeholder="Выберите категорию..." multiple>
                            <?php foreach($categories as $category):?>
                            <option value="<?php echo $category->id; ?>" <?php echo isset($product_categories[$category->id])?'selected':''; ?>><?php echo $category->parent_id != 0?' - '.$category->name:$category->name; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="brand_id">Бренд</label>
                    <div class="controls">
                        <select class="span12" name="brand_id" id="brand_id">
                            <option value="0">--Не указан--</option>
                            <?php foreach($brands as $brand):?>
                            <option value="<?php echo $brand->id; ?>" <?php echo isset($product)?($product->brand_id == $brand->id?'selected':''):''; ?>><?php echo $brand->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="controls-row well well-small">
                    <label class="radio inline span6">
                        <input type="radio" name="status_id" value="1"  <?php echo isset($product)?$product->status_id==1?'checked':'':'checked'; ?>/>
                        В наличии
                    </label>
                    <label class="radio inline span6">
                        <input type="radio" name="status_id" value="4"  <?php echo isset($product)?$product->status_id==4?'checked':'':''; ?> />
                        Под заказ
                    </label>
                </div>
                <div class="controls-row">
                    <label class="control-label" for="desc">Описание</label>
                    <div class="controls">
                        <textarea class="span12" name="desc" id="desc" cols="30" rows="10" style="resize: none">
                            <?php echo isset($product)?$product->desc:''; ?>
                        </textarea>
                    </div>
                </div>
                <div class="control-row">
                    <label for="" class="control-label">META Keywords</label>
                    <div class="controls">
                        <input class="span12" type="text" name="meta_keywords" id="meta_keywords" value="<?php echo isset($product)?$product->meta_keywords:''; ?>" />
                    </div>
                </div>
                <div class="control-row">
                    <label for="" class="control-label">META Descript</label>
                    <div class="controls"><input class="span12" type="text" name="meta_desc" id="meta_desc" value="<?php echo isset($product)?$product->meta_desc:''; ?>" /></div>
                </div>
            </fieldset>
            <input class="btn btn-primary" type="submit" value="Сохранить" />
        </form>
    </div>
</div>
<script type="text/javascript">
$('#category_id').chosen();
</script>
<script type="text/javascript">
    tinyMCE.init({
            mode : "textareas",
            theme : "simple"
    });
</script>