<div class="span12">
    <div class="container">
        <form action="index.php?r=order/save" method="POST">
            <fieldset>
                <legend>Персональная информация</legend>
                <label for="full_name">ФИО</label>
                <input type="text" name="full_name" id="full_name" />
                <label for="mobile_phone">Мобильный телефон</label>
                <input type="text" name="mobile_phone" id="cell-phone" />
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" />
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" />
            </fieldset>
            <fieldset>
                <legend>Инофрмация о доставке</legend>
                <label for="delivery1" class="radio inline">
                    <input type="radio" name="delivery_id" id="delivery1" value="3" checked/>
                    Курьером по киеву
                </label>
                
                <label for="delivery2" class="radio inline">
                    <input type="radio" name="delivery_id" id="delivery2" value="4"/>
                    Новая почта
                </label>
                <label for="address">Адрес</label>
                <input type="text" name="address" id="address" />
                <label for="info">Дополнительня информация</label>
                <input type="text" name="info" id="info" />
            </fieldset>
            <input type="submit" value="Подтвердить заказ" class="btn btn-primary"/>
        </form>
    </div>
</div>